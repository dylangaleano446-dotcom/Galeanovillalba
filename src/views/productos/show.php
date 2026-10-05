<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Producto</title>
</head>
<body>
    <h1>Detalle del Producto #<?= $producto['id'] ?></h1>

    <p><strong>ID:</strong> <?= $producto['id'] ?></p>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($producto['name']) ?></p>
    <p><strong>Precio:</strong> $<?= $producto['price'] ?></p>
    <p><strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion'] ?? 'Sin descripción') ?></p>

    <br>
    <a href="/productos/update/<?= $producto['id'] ?>">Editar</a> |
    <a href="/productos">Volver al listado</a>
</body>
</html>
