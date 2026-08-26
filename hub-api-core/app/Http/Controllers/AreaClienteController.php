<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginClienteRequest;
use App\Http\Resources\FaturaResource;
use App\Http\Resources\PlanoClienteResource;
use App\Services\HubSoft\HubSoftClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class AreaClienteController extends Controller
{
    public function __construct(protected HubSoftClient $hubSoft)
    {
    }

    /**
     * Valida e normaliza o parâmetro "ano" vindo da query string. Faixa
     * permitida: [ano_atual - 1, ano_atual + 1] — mesma regra decidida para
     * o seletor de ano da Área do Cliente. Fora da faixa ou ausente, cai no
     * ano atual (comportamento padrão da tela).
     */
    protected function anoValidado(Request $request): int
    {
        $anoAtual = (int) now()->year;
        $ano = (int) $request->query('ano', $anoAtual);

        if ($ano < $anoAtual - 1 || $ano > $anoAtual + 1) {
            return $anoAtual;
        }

        return $ano;
    }

    /**
     * Extrai só o primeiro nome de um nome completo (ex.: "GUILHERME ALLAN
     * XAVIER DE ALMEIDA" -> "Guilherme"), em Title Case (só a primeira
     * letra maiúscula) — usado na saudação da tela ("Olá, Guilherme 👋").
     * A HubSoft retorna o nome sempre em MAIÚSCULAS.
     */
    protected function primeiroNome(?string $nomeCompleto): ?string
    {
        if (!$nomeCompleto || trim($nomeCompleto) === '') {
            return null;
        }

        $primeiraPalavra = explode(' ', trim($nomeCompleto))[0];

        // mb_* para lidar corretamente com acentos (ex.: "ÉLIONE" -> "Élione").
        return mb_strtoupper(mb_substr($primeiraPalavra, 0, 1), 'UTF-8')
            . mb_strtolower(mb_substr($primeiraPalavra, 1), 'UTF-8');
    }

    /**
     * POST /hub-api/cliente/login — valida CPF+senha reais contra a
     * HubSoft. A senha do cliente NUNCA é armazenada em lugar nenhum
     * (nem sessão, nem log, nem cache) — só trafega nesta chamada.
     */
    public function login(LoginClienteRequest $request): JsonResponse
    {
        $cpfCnpj = $request->cpfCnpj();

        try {
            $cliente = $this->hubSoft->autenticarCliente($cpfCnpj, $request->input('senha'));
        } catch (RuntimeException $e) {
            Log::error('cliente.login_falhou', ['erro' => $e->getMessage()]);

            return response()->json([
                'ok' => false,
                'message' => 'Não foi possível autenticar agora. Tente novamente em instantes.',
            ], 502);
        }

        if ($cliente === null) {
            // Mensagem genérica de propósito: nunca revelar se o CPF existe
            // e a senha está errada, ou se o CPF nem é cliente — evita dar
            // pista a quem estiver tentando adivinhar credenciais.
            return response()->json([
                'ok' => false,
                'message' => 'CPF/CNPJ ou senha inválidos.',
            ], 401);
        }

        // Guardamos na sessão SÓ o identificador — nunca a senha, nunca o
        // array cru retornado pela HubSoft (que tem data de nascimento,
        // telefones etc).
        $request->session()->regenerate(); // novo ID de sessão a cada login (evita session fixation)
        $request->session()->put('cliente_cpf_cnpj', $cpfCnpj);

        return response()->json([
            'ok' => true,
            'message' => 'Login realizado com sucesso.',
            // Só o primeiro nome, para a saudação da tela ("Olá, Fulano").
            // Nunca o array $cliente inteiro (tem data de nascimento e
            // telefones do titular).
            'primeiro_nome' => $this->primeiroNome($cliente['nome_razaosocial'] ?? null),
        ]);
    }

    /**
     * POST /hub-api/cliente/logout — encerra a sessão do cliente.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->session()->forget('cliente_cpf_cnpj');
        $request->session()->regenerate();

        return response()->json(['ok' => true, 'message' => 'Sessão encerrada.']);
    }

    /**
     * GET /hub-api/cliente/faturas?ano=AAAA — protegida pelo middleware
     * EnsureClienteAutenticado. Usa SEMPRE o CPF gravado na sessão pelo
     * login — nunca aceita um CPF vindo do request, mesmo que alguém tente
     * enviar um diferente (evita um cliente autenticado ver fatura de outro
     * só trocando um parâmetro). "ano" é opcional (seletor de ano da tela),
     * default = ano atual, faixa permitida [atual-1, atual+1].
     *
     * Faz DUAS consultas à HubSoft: a lista de faturas do ano (endpoint já
     * usado desde a Fase 4) e o mapa de forma de cobrança (novo, ver
     * HubSoftClient::consultarFormasCobrancaPorCpfCnpj) — cruzadas para
     * decidir quem tem pagamento presencial (ver marcarPagamentoPresencial).
     */
    public function faturas(Request $request): JsonResponse
    {
        $cpfCnpj = $request->session()->get('cliente_cpf_cnpj');
        $ano = $this->anoValidado($request);

        try {
            $faturas = $this->hubSoft->consultarFaturasPorCpfCnpj($cpfCnpj, ano: $ano);

            $inicio = Carbon::createFromDate($ano, 1, 1)->startOfDay();
            $fim = Carbon::createFromDate($ano, 12, 31)->endOfDay();
            $mapaFormaCobranca = $this->hubSoft->consultarFormasCobrancaPorCpfCnpj($cpfCnpj, $inicio, $fim);

            $faturas = $this->hubSoft->marcarPagamentoPresencial($faturas, $mapaFormaCobranca);
        } catch (RuntimeException $e) {
            Log::error('cliente.faturas_falhou', ['erro' => $e->getMessage()]);

            return response()->json([
                'ok' => false,
                'message' => 'Não foi possível carregar suas faturas agora.',
            ], 502);
        }

        return response()->json([
            'ok' => true,
            'ano' => $ano,
            'faturas' => FaturaResource::collection($faturas),
        ]);
    }

    /**
     * GET /hub-api/cliente/plano — protegida. Mesmo raciocínio de
     * "sempre usar o CPF da sessão" da rota de faturas acima.
     */
    public function plano(Request $request): JsonResponse
    {
        $cpfCnpj = $request->session()->get('cliente_cpf_cnpj');

        try {
            $servicos = $this->hubSoft->consultarServicosDoCliente($cpfCnpj);
        } catch (RuntimeException $e) {
            Log::error('cliente.plano_falhou', ['erro' => $e->getMessage()]);

            return response()->json([
                'ok' => false,
                'message' => 'Não foi possível carregar seu plano agora.',
            ], 502);
        }

        return response()->json([
            'ok' => true,
            'planos' => PlanoClienteResource::collection($servicos),
        ]);
    }

    /**
     * GET /hub-api/cliente/faturas/{idFatura}/pdf?ano=AAAA — protegida. Faz
     * o Laravel atuar como PROXY do PDF: baixa o arquivo da HubSoft aqui no
     * backend e devolve os bytes ao navegador. Assim o domínio/link reais da
     * HubSoft nunca aparecem em nenhuma resposta JSON nem no navegador do
     * cliente. "ano" precisa bater com o ano em que a fatura foi listada
     * (o frontend deve sempre mandar o mesmo ano selecionado na tela).
     *
     * Antes de baixar qualquer coisa: (1) confirma que a fatura pedida
     * pertence de fato ao CPF da sessão (buscarFaturaDoCliente) — sem essa
     * checagem, um cliente logado poderia ver o PDF de outro cliente só
     * trocando o id_fatura na URL; (2) confirma que a fatura NÃO está paga
     * — por ora o PDF só existe para fatura em aberto (nenhum link de
     * comprovante de pagamento é exposto nesta fase); (3) confirma que a
     * forma de cobrança NÃO é presencial — clientes com pagamento
     * presencial (Banco Interno) nunca têm PDF de boleto/PIX real, mesmo
     * que tentem acessar a rota direto por id.
     */
    public function pdfFatura(Request $request, int $idFatura): Response|JsonResponse
    {
        $cpfCnpj = $request->session()->get('cliente_cpf_cnpj');
        $ano = $this->anoValidado($request);

        try {
            $fatura = $this->hubSoft->buscarFaturaDoCliente($cpfCnpj, $idFatura, ano: $ano);

            if ($fatura === null) {
                // Mesma resposta de "não achei" tanto para id inexistente
                // quanto para id de outro cliente — não revela qual dos
                // dois casos é (evita confirmar a existência de um id).
                return response()->json([
                    'ok' => false,
                    'message' => 'Fatura não encontrada.',
                ], 404);
            }

            if ((bool) ($fatura['quitado'] ?? false)) {
                return response()->json([
                    'ok' => false,
                    'message' => 'Esta fatura já está paga — o PDF não está disponível nesta consulta.',
                ], 403);
            }

            $inicio = Carbon::createFromDate($ano, 1, 1)->startOfDay();
            $fim = Carbon::createFromDate($ano, 12, 31)->endOfDay();
            $mapaFormaCobranca = $this->hubSoft->consultarFormasCobrancaPorCpfCnpj($cpfCnpj, $inicio, $fim);

            if ($this->hubSoft->ehPagamentoPresencial($idFatura, $mapaFormaCobranca)) {
                // Falha segura: sem forma de cobrança confirmada OU
                // confirmada como presencial, nunca serve o PDF.
                return response()->json([
                    'ok' => false,
                    'message' => 'Esta fatura não possui boleto digital — dirija-se ao escritório da MUT para realizar o pagamento.',
                ], 403);
            }

            $pdf = $this->hubSoft->baixarPdfFatura($fatura['link']);
        } catch (RuntimeException $e) {
            Log::error('cliente.pdf_falhou', ['erro' => $e->getMessage()]);

            return response()->json([
                'ok' => false,
                'message' => 'Não foi possível baixar o PDF agora. Tente novamente em instantes.',
            ], 502);
        }

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="fatura-' . $idFatura . '.pdf"',
        ]);
    }
}
