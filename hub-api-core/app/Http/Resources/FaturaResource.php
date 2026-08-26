<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Filtro de saída para faturas no fluxo AUTENTICADO (Área do Cliente, com
 * login CPF+senha validado de verdade contra a HubSoft). Nesse ambiente
 * confiável expomos vencimento, valor, status e um id opaco da fatura.
 *
 * NUNCA expomos o campo "link" (URL direta do PDF na HubSoft) nem o bloco
 * "cliente"/"empresa"/"detalhamento" do payload cru — este último carrega
 * nome completo, CPF e endereço repetidos várias vezes. O PDF é servido só
 * via proxy (GET /cliente/faturas/{id}/pdf, ver AreaClienteController),
 * nunca com o link real da HubSoft chegando ao navegador.
 *
 * Clientes com pagamento PRESENCIAL (id_forma_cobranca === 4, "Banco
 * Interno" — configuração administrativa da MUT para quem paga na
 * tesouraria) nunca recebem boleto/PIX/id_fatura (que habilitaria o botão
 * de baixar PDF no frontend) — o controller injeta a flag
 * "_pagamento_presencial" no array antes de chegar aqui. vencimento/valor/
 * status continuam visíveis: o cliente ainda precisa saber quanto e quando
 * pagar, só não pode fazer isso digitalmente.
 *
 * Para o fluxo SEM login (2ª via por CPF), use BoletoPublicoResource, que é
 * deliberadamente mais restrito — não expõe id de fatura nem PDF.
 */
class FaturaResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $presencial = (bool) ($this->resource['_pagamento_presencial'] ?? false);

        return [
            'id_fatura' => $presencial ? null : ($this->resource['id_fatura'] ?? null),
            'vencimento' => $this->resource['data_vencimento'] ?? null,
            'valor' => $this->resource['valor'] ?? null,
            'pago' => (bool) ($this->resource['quitado'] ?? false),
            'status' => $this->resource['status'] ?? null,
            'pagamento_presencial' => $presencial,
            'linha_digitavel' => $presencial ? null : ($this->resource['linha_digitavel'] ?? null),
            'codigo_barras' => $presencial ? null : ($this->resource['codigo_barras'] ?? null),
            'pix_copia_cola' => $presencial ? null : ($this->resource['pix_copia_cola'] ?? null),
        ];
    }
}
