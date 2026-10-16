
<?php

namespace App\Persistence;

use PDO;

class ProductoPersistence {
    private function getPDO(): PDO {
        return getPDO();
    }

    public function getAll(): array {
        $stmt = $this->getPDO()->query("SELECT * FROM productos");
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array {
        $stmt = $this->getPDO()->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        $producto = $stmt->fetch();
        return $producto ?: null;
    }

    public function create(string $name, float $price, ?string $descripcion): bool {
        $pdo = $this->getPDO();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("INSERT INTO productos (name, price, descripcion) VALUES (?, ?, ?)");
            $stmt->execute([$name, $price, $descripcion]);
            $pdo->commit();
            return true;
        } catch (\Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public function update(int $id, string $name, float $price, ?string $descripcion): bool {
        $pdo = $this->getPDO();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE productos SET name = ?, price = ?, descripcion = ? WHERE id = ?");
            $stmt->execute([$name, $price, $descripcion, $id]);
            $pdo->commit();
            return true;
        } catch (\Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public function delete(int $id): bool {
        $pdo = $this->getPDO();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
            $stmt->execute([$id]);
            $pdo->commit();
            return true;
        } catch (\Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
}
