<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
</head>
<body>
    <h1>Listado Completo de Productos</h1>

    <a href="/productos/create">Crear nuevo producto</a>
    <br><br>

    <ul>
    <?php foreach ($productos as $producto): ?>
        <li>
            <strong>ID:</strong> <?= $producto['id'] ?> |
            <strong>Nombre:</strong> <?= htmlspecialchars($producto['name']) ?> |
            <strong>Precio:</strong> $<?= $producto['price'] ?> |
            <strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion'] ?? '') ?> |
            <a href="/productos/<?= $producto['id'] ?>">Ver detalle</a> |
            <a href="/productos/update/<?= $producto['id'] ?>">Editar</a> |
            <form action="/productos/<?= $producto['id'] ?>" method="POST" style="display:inline;">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" onclick="return confirm('¿Eliminar registro?')">Eliminar</button>
            </form>
        </li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
