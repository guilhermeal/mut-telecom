<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Protege rotas de API públicas (sem CSRF clássico, pois são chamadas por um
 * site PHP externo, não por views Blade desta aplicação) verificando se a
 * requisição realmente veio do domínio do site MUT — não de qualquer outra
 * origem tentando consumir nossa API diretamente.
 *
 * Não é uma proteção infalível sozinha (headers podem ser forjados fora do
 * navegador, por isso o rate limiting continua sendo a defesa principal
 * contra abuso em massa) — mas bloqueia o caso comum de um site diferente
 * embutindo um <script> que chama nossa API a partir do navegador de outra
 * pessoa, já que o navegador preenche Origin/Referer automaticamente e não
 * permite que JavaScript de terceiros falsifique esse header.
 */
class VerificarOrigemPermitida
{
    public function handle(Request $request, Closure $next): Response
    {
        $origensPermitidas = array_filter(explode(',', (string) config('seguranca.origens_permitidas')));

        $origem = $request->header('Origin') ?? $request->header('Referer');

        $permitido = false;
        foreach ($origensPermitidas as $origemPermitida) {
            if ($origem && str_starts_with($origem, trim($origemPermitida))) {
                $permitido = true;
                break;
            }
        }

        if (!$permitido) {
            Log::warning('seguranca.origem_nao_permitida', [
                'origem_recebida' => $origem,
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'ok' => false,
                'message' => 'Acesso não permitido.',
            ], 403);
        }

        return $next($request);
    }
}
