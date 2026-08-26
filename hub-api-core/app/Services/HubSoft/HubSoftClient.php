<?php

namespace App\Services\HubSoft;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

/**
 * Único ponto de contato com a API da HubSoft. Nenhuma outra parte da
 * aplicação deve chamar Http::... diretamente para a HubSoft — tudo passa
 * por aqui, para manter a lógica de token/erro num só lugar.
 */
class HubSoftClient
{
    /**
     * id_forma_cobranca da HubSoft que identifica "Banco Interno" — forma
     * de cobrança administrativa criada pela MUT para clientes que pagam
     * presencialmente no escritório (carnê sem valor bancário, sem boleto/
     * PIX real). Fatura marcada com esse id nunca deve expor boleto, PIX ou
     * link de PDF ao frontend — só o valor/vencimento, com aviso para pagar
     * presencialmente. Ver consultarFormasCobrancaPorCpfCnpj().
     */
    public const ID_FORMA_COBRANCA_PRESENCIAL = 4;

    /**
     * Obtém um token de aplicação (client_credentials) válido, reaproveitando
     * do cache enquanto não expira. Isso evita autenticar na HubSoft a cada
     * requisição — o token dura ~30 dias segundo a doc da HubSoft.
     */
    protected function tokenDeAplicacao(): string
    {
        return Cache::remember('hubsoft.token_app', now()->addDays(25), function () {
            $resposta = Http::asJson()
                ->timeout(10)
                ->post(config('hubsoft.base_url') . '/oauth/token', [
                    'client_id' => config('hubsoft.client_id'),
                    'client_secret' => config('hubsoft.client_secret'),
                    'username' => config('hubsoft.username'),
                    'password' => config('hubsoft.password'),
                    'grant_type' => 'password',
                ]);

            if ($resposta->failed()) {
                Log::error('hubsoft.oauth_falhou', [
                    'status' => $resposta->status(),
                ]);
                throw new RuntimeException('Falha ao autenticar na HubSoft.');
            }

            $token = $resposta->json('access_token');

            if (!$token) {
                Log::error('hubsoft.oauth_sem_token', ['body' => $resposta->body()]);
                throw new RuntimeException('HubSoft não retornou access_token.');
            }

            return $token;
        });
    }

    /**
     * Monta um cliente HTTP já autenticado com o token de aplicação,
     * pronto para chamar qualquer endpoint da HubSoft.
     */
    protected function http()
    {
        return Http::withToken($this->tokenDeAplicacao())
            ->timeout(10)
            ->baseUrl(config('hubsoft.base_url') . '/api/v1');
    }

    /**
     * Busca o registro cru do cliente por CPF/CNPJ em GET /integracao/cliente.
     *
     * ATENÇÃO: a resposta bruta da HubSoft aqui é MUITO rica em dados
     * pessoais — RG, data de nascimento, telefones e, dentro de cada item
     * de servicos[], a SENHA DE CONEXÃO em texto puro. Este método é
     * protected de propósito: nada fora desta classe deve manusear esse
     * array cru. Sempre passar o resultado por um Resource restrito
     * (ex.: PlanoClienteResource) antes de qualquer resposta ao frontend.
     *
     * @return array<string, mixed>|null null se não houver cliente com esse CPF/CNPJ.
     */
    protected function buscarDadosCliente(string $cpfCnpj): ?array
    {
        $resposta = $this->http()->get('/integracao/cliente', [
            'busca' => 'cpf_cnpj',
            'termo_busca' => $cpfCnpj,
            'limit' => 1,
        ]);

        if ($resposta->failed()) {
            Log::error('hubsoft.consulta_cliente_falhou', ['status' => $resposta->status()]);
            throw new RuntimeException('Falha ao consultar cliente na HubSoft.');
        }

        $clientes = $resposta->json('clientes', []);

        return $clientes[0] ?? null;
    }

    /**
     * Confirma se existe um cliente com esse CPF/CNPJ na base da HubSoft.
     * Necessário porque o endpoint de faturas retorna array vazio tanto
     * para "cliente sem fatura em aberto" quanto para "CPF não é cliente
     * nenhum" — sem essa checagem extra, qualquer CPF aleatório pareceria
     * "estar em dia", o que é enganoso e não deveríamos afirmar.
     */
    public function clienteExiste(string $cpfCnpj): bool
    {
        return $this->buscarDadosCliente($cpfCnpj) !== null;
    }

    /**
     * Retorna só o(s) plano(s)/serviço(s) contratados do cliente (array
     * cru de servicos[], como vem da HubSoft — ainda contém a senha de
     * conexão em texto puro, então o CALLER deve sempre filtrar isso via
     * PlanoClienteResource antes de responder ao frontend).
     *
     * @return array<int, array<string, mixed>>
     */
    public function consultarServicosDoCliente(string $cpfCnpj): array
    {
        $cliente = $this->buscarDadosCliente($cpfCnpj);

        return $cliente['servicos'] ?? [];
    }

    /**
     * Consulta SOMENTE as faturas em aberto de um CPF/CNPJ, usando o token
     * de aplicação — usado no fluxo público "2ª via de boleto" (sem login).
     * Deliberadamente não traz faturas pagas nem histórico: quem só digitou
     * um CPF não tem por que ver dados além do que precisa pagar agora.
     *
     * Range de datas fixo (não configurável pelo chamador): do início do ano
     * corrente até o fim do mês seguinte ao atual — cobre qualquer fatura
     * já em aberto sem expor histórico de anos anteriores nesta tela pública.
     *
     * @return array<int, array<string, mixed>> array cru de faturas, como a HubSoft devolve.
     */
    public function consultarFaturasEmAbertoPorCpfCnpj(string $cpfCnpj): array
    {
        $inicio = now()->startOfYear();
        $fim = now()->addMonthNoOverflow()->endOfMonth();

        $resposta = $this->http()->get('/integracao/cliente/financeiro', [
            'busca' => 'cpf_cnpj',
            'termo_busca' => $cpfCnpj,
            'apenas_pendente' => 'sim',
            'order_by' => 'data_vencimento',
            'order_type' => 'asc',
        ]);

        if ($resposta->failed()) {
            Log::error('hubsoft.consulta_faturas_falhou', ['status' => $resposta->status()]);
            throw new RuntimeException('Falha ao consultar faturas na HubSoft.');
        }

        $faturas = $resposta->json('faturas', []);

        // O endpoint /integracao/cliente/financeiro não aceita filtro de
        // data — filtramos aqui pelo mesmo range fixo, para nunca exibir
        // faturas fora da janela pretendida nesta tela pública.
        return array_values(array_filter(
            $faturas,
            fn (array $fatura) => $this->dataVencimentoNoIntervalo($fatura, $inicio, $fim)
        ));
    }

    /**
     * Consulta as faturas (pagas ou não) de um cliente dentro de um ano
     * civil específico — usado no fluxo AUTENTICADO (Área do Cliente, após
     * login com CPF+senha real). O ano é escolhido pelo cliente num seletor
     * na tela (padrão: ano atual).
     *
     * @return array<int, array<string, mixed>> array cru de faturas, como a HubSoft devolve.
     */
    public function consultarFaturasPorCpfCnpj(string $cpfCnpj, int $ano): array
    {
        $inicio = now()->setDate($ano, 1, 1)->startOfDay();
        $fim = now()->setDate($ano, 12, 31)->endOfDay();

        $resposta = $this->http()->get('/integracao/cliente/financeiro', [
            'busca' => 'cpf_cnpj',
            'termo_busca' => $cpfCnpj,
            'apenas_pendente' => 'nao',
            'itens_por_pagina' => 100,
            'order_by' => 'data_vencimento',
            'order_type' => 'desc',
        ]);

        if ($resposta->failed()) {
            Log::error('hubsoft.consulta_faturas_falhou', ['status' => $resposta->status()]);
            throw new RuntimeException('Falha ao consultar faturas na HubSoft.');
        }

        $faturas = $resposta->json('faturas', []);

        // Mesmo caso acima: este endpoint não filtra por data, então
        // filtramos aqui pelo ano escolhido.
        return array_values(array_filter(
            $faturas,
            fn (array $fatura) => $this->dataVencimentoNoIntervalo($fatura, $inicio, $fim)
        ));
    }

    /**
     * Confere se o campo data_vencimento (formato "dd/mm/aaaa" retornado por
     * /integracao/cliente/financeiro) cai dentro do intervalo informado.
     */
    protected function dataVencimentoNoIntervalo(array $fatura, Carbon $inicio, Carbon $fim): bool
    {
        $bruta = $fatura['data_vencimento'] ?? null;

        if (!$bruta) {
            return false;
        }

        try {
            $data = Carbon::createFromFormat('d/m/Y', $bruta)->startOfDay();
        } catch (Throwable) {
            return false;
        }

        return $data->betweenIncluded($inicio, $fim);
    }

    /**
     * Consulta a FORMA DE COBRANÇA real de cada fatura de um cliente, num
     * intervalo de datas — via /integracao/financeiro/fatura, o único
     * endpoint da HubSoft que retorna esse dado corretamente (o campo
     * "tipo_cobranca" do endpoint /integracao/cliente/financeiro é sempre
     * "boleto_bancario", mesmo para clientes com pagamento presencial —
     * campo não confiável, não usar para esta decisão).
     *
     * Retorna um mapa [id_fatura => id_forma_cobranca], para o caller
     * cruzar com a lista principal de faturas.
     *
     * @return array<int, int> id_fatura => id_forma_cobranca
     */
    public function consultarFormasCobrancaPorCpfCnpj(string $cpfCnpj, Carbon $inicio, Carbon $fim): array
    {
        $resposta = $this->http()->get('/integracao/financeiro/fatura', [
            'tipo_data' => 'data_vencimento',
            'data_inicio' => $inicio->toDateString(),
            'data_fim' => $fim->toDateString(),
            'pagina' => 0,
            'itens_por_pagina' => 100,
            'busca' => 'cpf_cnpj',
            'termo_busca' => $cpfCnpj,
        ]);

        if ($resposta->failed()) {
            Log::error('hubsoft.consulta_forma_cobranca_falhou', ['status' => $resposta->status()]);
            throw new RuntimeException('Falha ao consultar forma de cobrança na HubSoft.');
        }

        $faturas = $resposta->json('faturas', []);
        $mapa = [];

        foreach ($faturas as $fatura) {
            $id = (int) ($fatura['id_fatura'] ?? 0);
            $idFormaCobranca = (int) ($fatura['forma_cobranca']['id_forma_cobranca'] ?? 0);

            if ($id > 0) {
                $mapa[$id] = $idFormaCobranca;
            }
        }

        return $mapa;
    }

    /**
     * Confere se um id_fatura, segundo o mapa retornado por
     * consultarFormasCobrancaPorCpfCnpj(), é de pagamento presencial.
     * Fatura sem entrada no mapa é tratada como presencial por padrão
     * (falha segura: melhor esconder boleto/PDF demais do que mostrar um
     * boleto de quem paga na tesouraria).
     *
     * @param array<int, int> $mapaFormaCobranca
     */
    public function ehPagamentoPresencial(int $idFatura, array $mapaFormaCobranca): bool
    {
        $idFormaCobranca = $mapaFormaCobranca[$idFatura] ?? null;

        return $idFormaCobranca === null || $idFormaCobranca === self::ID_FORMA_COBRANCA_PRESENCIAL;
    }

    /**
     * Cruza uma lista de faturas com o mapa [id_fatura => id_forma_cobranca]
     * e injeta a flag "_pagamento_presencial" em cada uma — consumida pelos
     * Resources (FaturaResource/BoletoPublicoResource) para esconder boleto/
     * PIX/PDF de quem paga presencialmente.
     *
     * @param array<int, array<string, mixed>> $faturas
     * @param array<int, int> $mapaFormaCobranca
     * @return array<int, array<string, mixed>>
     */
    public function marcarPagamentoPresencial(array $faturas, array $mapaFormaCobranca): array
    {
        return array_map(function (array $fatura) use ($mapaFormaCobranca) {
            $id = (int) ($fatura['id_fatura'] ?? 0);
            $fatura['_pagamento_presencial'] = $this->ehPagamentoPresencial($id, $mapaFormaCobranca);

            return $fatura;
        }, $faturas);
    }

    /**
     * Busca, dentre as faturas do CPF/CNPJ informado num ano, a que tem o
     * id_fatura pedido — usado para confirmar POSSE antes de servir um PDF:
     * o controller nunca deve buscar/baixar um PDF sem antes garantir que a
     * fatura pertence de fato ao CPF da sessão do cliente logado (senão um
     * cliente logado poderia baixar o PDF de outro só trocando o id na URL).
     *
     * @return array<string, mixed>|null null se a fatura não existe ou não é deste cliente.
     */
    public function buscarFaturaDoCliente(string $cpfCnpj, int $idFatura, int $ano): ?array
    {
        $faturas = $this->consultarFaturasPorCpfCnpj($cpfCnpj, ano: $ano);

        foreach ($faturas as $fatura) {
            if ((int) ($fatura['id_fatura'] ?? 0) === $idFatura) {
                return $fatura;
            }
        }

        return null;
    }

    /**
     * Baixa os bytes do PDF de uma fatura, direto da HubSoft, para o Laravel
     * repassar ao navegador (proxy). Isso evita que o domínio/URL reais da
     * HubSoft cheguem ao frontend — o cliente só vê uma rota nossa
     * (/hub-api/cliente/faturas/{id}/pdf), nunca o link da HubSoft.
     *
     * IMPORTANTE: quem chama este método é responsável por já ter confirmado
     * (via buscarFaturaDoCliente) que a fatura pertence ao cliente
     * autenticado na sessão — este método não faz nenhuma checagem de posse,
     * só busca o PDF a partir do link cru já obtido.
     */
    public function baixarPdfFatura(string $linkPdf): string
    {
        $resposta = Http::withToken($this->tokenDeAplicacao())
            ->timeout(15)
            ->get($linkPdf);

        if ($resposta->failed()) {
            Log::error('hubsoft.download_pdf_falhou', ['status' => $resposta->status()]);
            throw new RuntimeException('Falha ao baixar o PDF da fatura na HubSoft.');
        }

        return $resposta->body();
    }

    /**
     * Autentica um cliente (CPF/CNPJ + senha da Central do Assinante) contra
     * a HubSoft. A senha nunca é armazenada em lugar nenhum — só trafega
     * nesta chamada, para validação.
     *
     * @return array<string, mixed>|null dados do cliente autenticado, ou null se credenciais inválidas.
     */
    public function autenticarCliente(string $cpfCnpj, string $senha): ?array
    {
        $resposta = $this->http()->post('/integracao/cliente/autenticacao', [
            'usuario' => $cpfCnpj,
            'senha' => $senha,
        ]);

        if ($resposta->status() === 401 || $resposta->status() === 422) {
            // Credenciais inválidas — não é um erro de sistema, é um "não".
            return null;
        }

        if ($resposta->failed()) {
            Log::error('hubsoft.autenticacao_falhou', ['status' => $resposta->status()]);
            throw new RuntimeException('Falha ao autenticar cliente na HubSoft.');
        }

        return $resposta->json('cliente');
    }
}
