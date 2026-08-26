<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultarBoletosRequest;
use App\Http\Resources\BoletoPublicoResource;
use App\Services\HubSoft\HubSoftClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class BoletoController extends Controller
{
    public function __construct(protected HubSoftClient $hubSoft)
    {
    }

    /**
     * POST /hub-api/boletos/consultar — fluxo público (sem login).
     * Retorna só as faturas em ABERTO do CPF/CNPJ informado, sem nenhum
     * dado pessoal (nome/CPF/endereço) e sem link de PDF — ver o
     * comentário em BoletoPublicoResource para o porquê.
     */
    public function consultar(ConsultarBoletosRequest $request): JsonResponse
    {
        $cpfCnpj = $request->cpfCnpj();

        try {
            // O endpoint de faturas retorna array vazio tanto para "cliente
            // em dia" quanto para "CPF não é cliente nenhum" — por isso
            // confirmamos primeiro se o CPF é de fato um cliente cadastrado,
            // antes de poder afirmar "você está em dia".
            if (!$this->hubSoft->clienteExiste($cpfCnpj)) {
                return $this->respostaGenerica();
            }

            $faturas = $this->hubSoft->consultarFaturasEmAbertoPorCpfCnpj($cpfCnpj);

            // Mesmo range fixo usado em consultarFaturasEmAbertoPorCpfCnpj():
            // início do ano corrente até o fim do mês seguinte ao atual.
            $inicio = now()->startOfYear();
            $fim = now()->addMonthNoOverflow()->endOfMonth();
            $mapaFormaCobranca = $this->hubSoft->consultarFormasCobrancaPorCpfCnpj($cpfCnpj, $inicio, $fim);

            $faturas = $this->hubSoft->marcarPagamentoPresencial($faturas, $mapaFormaCobranca);
        } catch (RuntimeException $e) {
            Log::error('boleto.consulta_falhou', ['erro' => $e->getMessage()]);

            return response()->json([
                'ok' => false,
                'message' => 'Não foi possível consultar seus boletos agora. Tente novamente em instantes.',
            ], 502);
        }

        if (empty($faturas)) {
            return response()->json([
                'ok' => true,
                'em_dia' => true,
                'message' => 'Nenhuma fatura em aberto — você está em dia!',
                'boletos' => [],
            ]);
        }

        return response()->json([
            'ok' => true,
            'em_dia' => false,
            'boletos' => BoletoPublicoResource::collection($faturas),
        ]);
    }

    /**
     * Resposta usada quando o CPF/CNPJ não é de nenhum cliente conhecido.
     * Propositalmente IDÊNTICA, em formato, à resposta de "sem fatura em
     * aberto" — nunca confirmamos ou negamos se um CPF é cliente da MUT,
     * pois isso permitiria descobrir CPFs de clientes reais por tentativa.
     */
    protected function respostaGenerica(): JsonResponse
    {
        return response()->json([
            'ok' => true,
            'em_dia' => true,
            'message' => 'Nenhuma fatura em aberto encontrada para os dados informados.',
            'boletos' => [],
        ]);
    }
}
