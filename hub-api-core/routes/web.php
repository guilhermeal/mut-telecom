<?php

use App\Http\Controllers\AreaClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ping', function () {
    return response()->json(['ok' => true, 'app' => 'hub-api-core']);
});

// Área do Cliente: rotas com sessão (precisam do grupo "web" para
// cookies/sessão funcionarem), mas sem CSRF clássico — a proteção contra
// CSRF aqui vem do cookie SESSION_SAME_SITE=strict (o navegador não envia
// esse cookie em requisições originadas de outro site) + nosso middleware
// de Origin permitida, igual usado no fluxo de boletos.
Route::prefix('cliente')->middleware(['origem_permitida', 'throttle:10,10'])->group(function () {
    Route::post('/login', [AreaClienteController::class, 'login']);
    Route::post('/logout', [AreaClienteController::class, 'logout']);

    Route::middleware('cliente_autenticado')->group(function () {
        Route::get('/faturas', [AreaClienteController::class, 'faturas']);
        Route::get('/plano', [AreaClienteController::class, 'plano']);
        // Proxy do PDF — ver AreaClienteController::pdfFatura(). O id vem
        // como {idFatura:[0-9]+} para nunca aceitar algo que não seja número.
        Route::get('/faturas/{idFatura}/pdf', [AreaClienteController::class, 'pdfFatura'])
            ->whereNumber('idFatura');
    });
});
