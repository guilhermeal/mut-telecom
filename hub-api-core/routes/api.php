<?php

use App\Http\Controllers\BoletoController;
use Illuminate\Support\Facades\Route;

// Rotas de API "puras": sem sessão, sem CSRF clássico (o CSRF do Laravel
// pressupõe formulário Blade da própria aplicação — aqui quem chama é o
// site PHP puro, uma origem diferente). A proteção dessas rotas vem de:
// rate limiting (throttle) + validação de Origin/Referer.

Route::post('/boletos/consultar', [BoletoController::class, 'consultar'])
    ->middleware(['origem_permitida', 'throttle:5,10']); // 5 tentativas a cada 10 minutos, por IP
