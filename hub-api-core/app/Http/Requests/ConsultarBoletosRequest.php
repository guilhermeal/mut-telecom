<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ConsultarBoletosRequest extends FormRequest
{
    /**
     * Rota pública (sem login) — qualquer um pode consultar boletos pelo
     * próprio CPF/CNPJ. A autorização de fato é: "você sabe o CPF do
     * titular". authorize() aqui é sempre true; a rota inteira é pública.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Aceita só dígitos (o front já limpa pontuação antes de enviar,
            // mas validamos de novo aqui — nunca confiar só no client-side).
            'cpf_cnpj' => ['required', 'regex:/^[0-9]{11}$|^[0-9]{14}$/'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'cpf_cnpj.required' => 'Informe o CPF ou CNPJ.',
            'cpf_cnpj.regex' => 'Digite um CPF (11 dígitos) ou CNPJ (14 dígitos) válido.',
        ];
    }

    /**
     * Retorna o CPF/CNPJ já limpo (só dígitos), pronto para repassar ao
     * HubSoftClient.
     */
    public function cpfCnpj(): string
    {
        return preg_replace('/\D/', '', (string) $this->input('cpf_cnpj'));
    }
}
