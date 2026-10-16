
<?php

namespace App\Services;

use App\Persistence\UserPersistence;

class AuthService {
    private UserPersistence $persistence;

    public function __construct() {
        $this->persistence = new UserPersistence();
    }

    public function registrarUsuario(string $email, string $password): bool {
        if (empty($email) || empty($password)) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $this->persistence->create($email, $hash);
    }

    public function autenticarUsuario(string $email, string $password): ?array {
        if (empty($email) || empty($password)) {
            return null;
        }

        $user = $this->persistence->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }
}
