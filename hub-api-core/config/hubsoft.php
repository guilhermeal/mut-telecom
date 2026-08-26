<?php

// Config dedicado à integração com a API da HubSoft.
// Nunca lemos env() fora de arquivos dentro de config/ — essa é a única
// "ponte" entre o .env (segredos de runtime) e o resto da aplicação.
// As chaves abaixo vêm das variáveis HUBSOFT_* definidas no .env.

return [
    'base_url' => env('HUBSOFT_BASE_URL'),
    'client_id' => env('HUBSOFT_CLIENT_ID'),
    'client_secret' => env('HUBSOFT_CLIENT_SECRET'),
    'username' => env('HUBSOFT_USERNAME'),
    'password' => env('HUBSOFT_PASSWORD'),
];
