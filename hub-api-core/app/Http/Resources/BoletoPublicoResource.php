<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Filtro de saída para o fluxo SEM LOGIN (2ª via de boleto por CPF/CNPJ,
 * tela pública). Deliberadamente mais restrito que FaturaResource:
 *
 * - NUNCA expõe link de PDF (o PDF contém nome completo, endereço e outros
 *   dados pessoais do titular — vazaria exatamente o que estamos protegendo
 *   ao esconder isso na tela). PDF só existe no ambiente autenticado.
 * - NUNCA expõe nome ou CPF em texto puro — só os códigos de pagamento em
 *   si (que sozinhos não identificam a pessoa a quem os vê).
 * - Clientes com pagamento PRESENCIAL (id_forma_cobranca === 4, "Banco
 *   Interno" — configuração administrativa da MUT para quem paga na
 *   tesouraria, sem boleto/PIX bancário de verdade) nunca recebem
 *   linha_digitavel/codigo_barras/pix_copia_cola — o controller injeta a
 *   flag "_pagamento_presencial" no array antes de chegar aqui.
 */
class BoletoPublicoResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $presencial = (bool) ($this->resource['_pagamento_presencial'] ?? false);

        return [
            'vencimento' => $this->resource['data_vencimento'] ?? null,
            'valor' => $this->resource['valor'] ?? null,
            'pagamento_presencial' => $presencial,
            'linha_digitavel' => $presencial ? null : ($this->resource['linha_digitavel'] ?? null),
            'codigo_barras' => $presencial ? null : ($this->resource['codigo_barras'] ?? null),
            'pix_copia_cola' => $presencial ? null : ($this->resource['pix_copia_cola'] ?? null),
        ];
    }
}
