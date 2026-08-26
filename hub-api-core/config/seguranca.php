<?php

// Config de segurança geral da aplicação (não específico da HubSoft).
// origens_permitidas: lista de domínios (separados por vírgula) autorizados
// a chamar nossas rotas de API pública. Usado pelo middleware
// VerificarOrigemPermitida.

return [
    'origens_permitidas' => env('ORIGENS_PERMITIDAS', ''),
];
