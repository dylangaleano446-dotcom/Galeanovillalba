<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use App\Services\ProductoService;

class ProductoController {
    private PhpRenderer $renderer;
    private ProductoService $service;

    public function __construct(PhpRenderer $renderer) {
        $this->renderer = $renderer;
        $this->service = new ProductoService();
    }

    public function index(Request $request, Response $response): Response {
        $productos = $this->service->listarProductos();
        return $this->renderer->render($response, 'productos/index.php', ['productos' => $productos]);
    }

    public function create(Request $request, Response $response): Response {
        return $this->renderer->render($response, 'productos/create.php');
    }

    public function store(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $this->service->crearProducto($data);
        return $response->withHeader('Location', '/productos')->withStatus(302);
    }

    public function show(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        $producto = $this->service->obtenerProducto($id);

        if (!$producto) {
            return $this->renderer->render($response, 'productos/not_found.php')->withStatus(404);
        }

        return $this->renderer->render($response, 'productos/show.php', ['producto' => $producto]);
    }

    public function updateView(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        $producto = $this->service->obtenerProducto($id);

        if (!$producto) {
            return $this->renderer->render($response, 'productos/not_found.php')->withStatus(404);
        }

        return $this->renderer->render($response, 'productos/update.php', ['producto' => $producto]);
    }

    public function update(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        $data = $request->getParsedBody();
        $this->service->actualizarProducto($id, $data);

        return $response->withHeader('Location', '/productos')->withStatus(302);
    }

    public function destroy(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        $this->service->eliminarProducto($id);

        return $response->withHeader('Location', '/productos')->withStatus(302);
    }
}
