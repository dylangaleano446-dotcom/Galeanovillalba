<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use App\Services\AuthService;

class AuthController {
    private PhpRenderer $renderer;
    private AuthService $service;

    public function __construct(PhpRenderer $renderer) {
        $this->renderer = $renderer;
        $this->service = new AuthService();
    }

    public function registerView(Request $request, Response $response): Response {
        return $this->renderer->render($response, 'auth/register.php');
    }

    public function register(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $exito = $this->service->registrarUsuario($email, $password);

        if ($exito) {
            return $response->withHeader('Location', '/auth/login')->withStatus(302);
        }

        return $response->withHeader('Location', '/auth/register')->withStatus(302);
    }

    public function loginView(Request $request, Response $response): Response {
        return $this->renderer->render($response, 'auth/login.php');
    }

    public function login(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $user = $this->service->autenticarUsuario($email, $password);

        if ($user) {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION['user_id'] = $user['id'];

            return $response->withHeader('Location', '/productos')->withStatus(302);
        }

        return $response->withHeader('Location', '/auth/login')->withStatus(302);
    }
}
