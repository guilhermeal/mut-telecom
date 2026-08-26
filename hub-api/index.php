<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// "Ponte" para hospedagem sem vhost: este index.php vive em /hub-api/ (pasta
// pública), mas o projeto Laravel de verdade está em /hub-api-core/, uma
// pasta irmã fora do alcance direto do navegador. Por isso os caminhos abaixo
// apontam para "../hub-api-core/..." em vez do "../..." padrão do Laravel
// (que assume que este arquivo está dentro de hub-api-core/public/).

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../hub-api-core/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../hub-api-core/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../hub-api-core/bootstrap/app.php';

$app->handleRequest(Request::capture());
