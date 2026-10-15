<?php

use Slim\App;
use App\Controllers\ProductoController;

/** @var App $app */

$app->get('/productos', [ProductoController::class, 'index'])->add('authMiddleware');
$app->get('/productos/create', [ProductoController::class, 'create'])->add('authMiddleware');
$app->get('/productos/update/{id}', [ProductoController::class, 'updateView'])->add('authMiddleware');
$app->get('/productos/{id}', [ProductoController::class, 'show'])->add('authMiddleware');

$app->post('/productos', [ProductoController::class, 'store'])->add('authMiddleware');
$app->put('/productos/{id}', [ProductoController::class, 'update'])->add('authMiddleware');
$app->delete('/productos/{id}', [ProductoController::class, 'destroy'])->add('authMiddleware');
