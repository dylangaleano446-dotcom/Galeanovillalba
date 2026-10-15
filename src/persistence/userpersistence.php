<?php

namespace App\Persistence;

use PDO;

class UserPersistence {
    private function getPDO(): PDO {
        return getPDO();
    }

    public function create(string $email, string $hashedPassword): bool {
        $stmt = $this->getPDO()->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, $hashedPassword]);
    }

    public function findByEmail(string $email): ?array {
        $stmt = $this->getPDO()->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }
}
