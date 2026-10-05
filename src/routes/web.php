<?php

use App\Controllers\ProductoController;

$app->get('/productos', [ProductoController::class, 'index']);
$app->get('/productos/create', [ProductoController::class, 'create']);
$app->get('/productos/update/{id}', [ProductoController::class, 'updateView']);
$app->get('/productos/{id}', [ProductoController::class, 'show']);

$app->post('/productos', [ProductoController::class, 'store']);
$app->put('/productos/{id}', [ProductoController::class, 'update']);
$app->delete('/productos/{id}', [ProductoController::class, 'destroy']);
