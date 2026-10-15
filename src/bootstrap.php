
<?php

use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();

$env = $_ENV["APP_ENV"] ?? "prod";
$allowedEnvs = ["dev", "prod"];

if (!in_array($env, $allowedEnvs, true)) {
    throw new RuntimeException("APP_ENV inválido: $env");
}

$debug = $env === "dev";
$app = AppFactory::create();
$renderer = new PhpRenderer(__DIR__ . '/views');


require_once __DIR__ . '/middlewares/auth.middleware.php';
require_once __DIR__ . '/middlewares/log.middleware.php';
$app->add('logMiddleware');

// --- TP N°13: MODULARIZACIÓN DE RUTAS ---
require __DIR__ . '/routes/auth.routes.php';
require __DIR__ . '/routes/productos.routes.php';

return $app;
