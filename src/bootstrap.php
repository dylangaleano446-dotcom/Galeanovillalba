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

// Crear la aplicacion de Slim
$app = AppFactory::create();

// Crear el motor de plantillas
$renderer = new PhpRenderer(
  __DIR__ . '/views',
  ["title" => "PDI | Slim Template 2026"]
);


$app->get("/", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "index.php");
});

$app->addErrorMiddleware($debug, true, true);


$app->get('/productos', function ($request, $response) use ($renderer) {
   $productos = [
      ['id' => 1, 'name' => 'Bolsa de Cemento 50kg', 'price' => 9800, 'descripcion' => 'Cemento Portland de alta resistencia'],
      ['id' => 2, 'name' => 'Hierro del 8mm (Barra 12m)', 'price' => 14200, 'descripcion' => 'Acero aletado para estructuras de hormigón'],
      ['id' => 3, 'name' => 'Ladrillo Hueco 12x18x33', 'price' => 650, 'descripcion' => 'Ladrillo cerámico para tabiquería y muros'],
      ['id' => 4, 'name' => 'Arena Fina (Metro Cúbico)', 'price' => 22000, 'descripcion' => 'Arena lavada ideal para revoques y mezclas'],
      ['id' => 5, 'name' => 'Cal Hidráulica 25kg', 'price' => 5400, 'descripcion' => 'Cal para albañilería y mampostería']
  ];

  
  $queryParams = $request->getQueryParams();
  $limit = $queryParams['limit'] ?? null;

 
  if ($limit !== null && is_numeric($limit)) {
      $productos = array_slice($productos, 0, (int)$limit);
  }

 
  return $renderer->render($response, 'productos/index.php', [
      'productos' => $productos
  ]);
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
$app->post('/productos', function ($request, $response) use ($renderer) {
  
  $data = $request->getParsedBody();

  $nombre = $data['nombre'] ?? '';
  $precio = $data['precio'] ?? '';
  $descripcion = $data['descripcion'] ?? '';

  return $renderer->render($response, 'productos/show_created.php', [
      'nombre' => $nombre,
      'precio' => $precio,
      'descripcion' => $descripcion
  ]);
});
return $app;
