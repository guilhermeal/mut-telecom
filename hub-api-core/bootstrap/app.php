<?php

use App\Http\Middleware\EnsureClienteAutenticado;
use App\Http\Middleware\VerificarOrigemPermitida;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'origem_permitida' => VerificarOrigemPermitida::class,
            'cliente_autenticado' => EnsureClienteAutenticado::class,
        ]);

        // As rotas /cliente/* usam sessão (para o login funcionar), mas são
        // chamadas via fetch pelo site PHP puro, não por um <form> Blade
        // desta aplicação — por isso o CSRF token clássico não se aplica.
        // A proteção contra CSRF nesse caso vem do cookie de sessão com
        // SameSite=Strict (ver .env: SESSION_SAME_SITE) + do middleware
        // origem_permitida, aplicados nessas rotas.
        $middleware->validateCsrfTokens(except: [
            'cliente/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
