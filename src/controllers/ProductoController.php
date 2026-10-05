<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Exception;

class ProductoController {
    private $renderer;

    public function __construct(PhpRenderer $renderer) {
        $this->renderer = $renderer;
    }
    public function index(Request $request, Response $response): Response {
        $pdo = getPDO();
        $stmt = $pdo->query("SELECT * FROM productos ORDER BY id DESC");
        $productos = $stmt->fetchAll();

        return $this->renderer->render($response, 'productos/index.php', [
            'productos' => $productos
        ]);
    }

    public function create(Request $request, Response $response): Response {
        return $this->renderer->render($response, 'productos/create.php');
    }

    public function updateView(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
        $pdo = getPDO();

        $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        $producto = $stmt->fetch();

        if (!$producto) {
            return $this->renderer->render($response->withStatus(404), 'productos/not_found.php');
        }

        return $this->renderer->render($response, 'productos/update.php', [
            'producto' => $producto
        ]);
    }

    public function show(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
        $pdo = getPDO();

        $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        $producto = $stmt->fetch();

        if (!$producto) {
            return $this->renderer->render($response->withStatus(404), 'productos/not_found.php');
        }

        return $this->renderer->render($response, 'productos/show.php', [
            'producto' => $producto
        ]);
    }

    public function store(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $pdo = getPDO();

        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO productos (name, price, descripcion) VALUES (?, ?, ?)");
            $stmt->execute([
                $data['name'],
                $data['price'],
                $data['descripcion'] ?? null
            ]);

            $pdo->commit();
            return $response->withHeader('Location', '/productos')->withStatus(302);
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
    public function update(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $pdo = getPDO();

        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("UPDATE productos SET name = ?, price = ?, descripcion = ? WHERE id = ?");
            $stmt->execute([
                $data['name'],
                $data['price'],
                $data['descripcion'] ?? null,
                $id
            ]);

            $pdo->commit();
            return $response->withHeader('Location', '/productos/' . $id)->withStatus(302);
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
    public function destroy(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
        $pdo = getPDO();

        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
            $stmt->execute([$id]);

            $pdo->commit();
            return $response->withHeader('Location', '/productos')->withStatus(302);
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
}
