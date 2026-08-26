<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginClienteRequest extends FormRequest
{
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
            'cpf_cnpj' => ['required', 'regex:/^[0-9]{11}$|^[0-9]{14}$/'],
            'senha' => ['required', 'string', 'min:1'],
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
            'senha.required' => 'Informe a senha.',
        ];
    }

    public function cpfCnpj(): string
    {
        return preg_replace('/\D/', '', (string) $this->input('cpf_cnpj'));
    }
}
