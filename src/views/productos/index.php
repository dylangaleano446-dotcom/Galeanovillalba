<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materiales de Construcción - Productos</title>
</head>
<body>
    <h1>Listado de Materiales</h1>

    <ul>
        <?php foreach ($productos as $producto): ?>
            <li>
                <strong>ID:</strong> <?= $producto['id'] ?> | 
                <strong>Producto:</strong> <?= htmlspecialchars($producto['name']) ?> | 
                <strong>Precio:</strong> $<?= $producto['price'] ?> | 
                <strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <br>
    <a href="/create/productos">Crear nuevo producto</a>
</body>
</html>
