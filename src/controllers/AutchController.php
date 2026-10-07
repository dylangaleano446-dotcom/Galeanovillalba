<?php
namespace App\Controllers;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class AuthController {
    private $renderer;
public function __construct(PhpRenderer $renderer) {
        $this->renderer = $renderer;
    }
    public function registerView(Request $request, Response $response): Response {
        return $this->renderer->render($response, 'auth/register.php');
    }
    public function register(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (!empty($email) && !empty($password)) {
            $pdo = getPDO();
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?)");
            $stmt->execute([$email, $hash]);

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

        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION['user_id'] = $user['id'];

            return $response->withHeader('Location', '/productos')->withStatus(302);
        }

        return $response->withHeader('Location', '/auth/login')->withStatus(302);
    }
}
