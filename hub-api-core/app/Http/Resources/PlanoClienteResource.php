<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Filtro de saída para o card "Plano atual" da Área do Cliente (fluxo
 * AUTENTICADO). A resposta bruta de GET /integracao/cliente é MUITO rica —
 * inclui RG, data de nascimento, telefones e, em cada serviço, a SENHA DE
 * CONEXÃO em texto puro (campo "senha" dentro de servicos[]). Nada disso
 * pode chegar ao frontend. Aqui expomos só o essencial para a UI do plano.
 */
class PlanoClienteResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nome_plano' => $this->resource['nome'] ?? null,
            'valor' => $this->resource['valor'] ?? null,
            'status' => $this->resource['status'] ?? null,
            'status_prefixo' => $this->resource['status_prefixo'] ?? null,
        ];
    }
}
