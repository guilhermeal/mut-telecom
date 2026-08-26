<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Protege as rotas da Área do Cliente. Diferente do middleware "auth"
 * padrão do Laravel (que espera um model Eloquent de usuário em banco),
 * aqui não existe tabela de usuários — a "identidade" do cliente logado é
 * só o CPF/CNPJ guardado na sessão pelo AreaClienteController::login(),
 * depois que a HubSoft confirmou a senha.
 *
 * Se não houver 'cliente_cpf_cnpj' na sessão, a requisição é rejeitada
 * antes de chegar em qualquer controller — nenhuma rota autenticada aceita
 * CPF vindo do corpo do request, só o que está gravado aqui na sessão.
 */
class EnsureClienteAutenticado
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('cliente_cpf_cnpj')) {
            return response()->json([
                'ok' => false,
                'message' => 'Sessão expirada. Faça login novamente.',
            ], 401);
        }

        return $next($request);
    }
}
