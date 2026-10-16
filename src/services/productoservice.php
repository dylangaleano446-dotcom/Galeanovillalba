<?php

namespace App\Services;

use App\Persistence\ProductoPersistence;

class ProductoService {
    private ProductoPersistence $persistence;

    public function __construct() {
        $this->persistence = new ProductoPersistence();
    }

    public function listarProductos(): array {
        return $this->persistence->getAll();
    }

    public function obtenerProducto(int $id): ?array {
        return $this->persistence->getById($id);
    }

    public function crearProducto(array $data): bool {
        $name = trim($data['name'] ?? '');
        $price = (float) ($data['price'] ?? 0);
        $descripcion = !empty($data['descripcion']) ? trim($data['descripcion']) : null;

        if (empty($name) || $price <= 0) {
            return false;
        }

        return $this->persistence->create($name, $price, $descripcion);
    }

    public function actualizarProducto(int $id, array $data): bool {
        $name = trim($data['name'] ?? '');
        $price = (float) ($data['price'] ?? 0);
        $descripcion = !empty($data['descripcion']) ? trim($data['descripcion']) : null;

        if ($id <= 0 || empty($name) || $price <= 0) {
            return false;
        }

        return $this->persistence->update($id, $name, $price, $descripcion);
    }

    public function eliminarProducto(int $id): bool {
        if ($id <= 0) {
            return false;
        }

        return $this->persistence->delete($id);
    }
}
