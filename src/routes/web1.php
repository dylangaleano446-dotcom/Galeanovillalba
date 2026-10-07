<?php

use App\Controllers\ProductoController;
use App\Controllers\AuthController;

require_once __DIR__ . '/../middlewares/auth.middleware.php';
require_once __DIR__ . '/../middlewares/log.middleware.php';

$app->add('logMiddleware');

$app->get('/auth/register', [AuthController::class, 'registerView']);
$app->post('/auth/register', [AuthController::class, 'register']);
$app->get('/auth/login', [AuthController::class, 'loginView']);
$app->post('/auth/login', [AuthController::class, 'login']);

$app->get('/productos', [ProductoController::class, 'index'])->add('authMiddleware');
$app->get('/productos/create', [ProductoController::class, 'create'])->add('authMiddleware');
$app->get('/productos/update/{id}', [ProductoController::class, 'updateView'])->add('authMiddleware');
$app->get('/productos/{id}', [ProductoController::class, 'show'])->add('authMiddleware');

$app->post('/productos', [ProductoController::class, 'store'])->add('authMiddleware');
$app->put('/productos/{id}', [ProductoController::class, 'update'])->add('authMiddleware');
$app->delete('/productos/{id}', [ProductoController::class, 'destroy'])->add('authMiddleware');
