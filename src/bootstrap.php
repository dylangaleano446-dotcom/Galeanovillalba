<?php

use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Cargar variables de entorno desde el .env
Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();

$env = $_ENV["APP_ENV"] ?? "prod";
$allowedEnvs = ["dev", "prod"];

if (!in_array($env, $allowedEnvs, true)) {
  throw new RuntimeException("APP_ENV inválido: $env");
}

$debug = $env === "dev";

// Crear la aplicacion de Slim
$app = AppFactory::create();

// Crear el motor de plantillas
$renderer = new PhpRenderer(
  __DIR__ . '/views',
  ["title" => "PDI | Slim Template 2026"]
);

// Ruta/Vista principal
$app->get("/", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "index.php");
});

$app->addErrorMiddleware($debug, true, true);


// 1. Ruta para el listado de productos
$app->get('/productos', function ($request, $response) use ($renderer) {
  return $renderer->render($response, 'productos/index.php');
});

// 2. Ruta para el detalle con parámetro {id}
$app->get('/productos/{id}', function ($request, $response, $args) use ($renderer) {
  return $renderer->render($response, 'productos/show.php', [
      'id' => $args['id']
  ]);
});

// 3. Ruta para la creación de productos
$app->get('/create/productos', function ($request, $response) use ($renderer) {
  return $renderer->render($response, 'productos/store.php');
});
// Ruta POST para recibir los datos del formulario de productos
$app->post('/productos', function ($request, $response) use ($renderer) {
    // Obtener los datos enviados en el body del request (formulario)
    $data = $request->getParsedBody();

    // Extraer los campos enviados
    $nombre = $data['nombre'] ?? '';
    $precio = $data['precio'] ?? '';
    $descripcion = $data['descripcion'] ?? '';

    // Renderizar la vista pasando los datos del producto
    return $renderer->render($response, 'productos/show_created.php', [
        'nombre' => $nombre,
        'precio' => $precio,
        'descripcion' => $descripcion
    ]);
});
return $app;
