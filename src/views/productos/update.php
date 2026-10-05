<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto #<?= $producto['id'] ?></h1>

    <form action="/productos/<?= $producto['id'] ?>" method="POST">
        <input type="hidden" name="_method" value="PUT">

        <label>Nombre:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($producto['name']) ?>" required><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="price" value="<?= $producto['price'] ?>" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion"><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea><br><br>

        <button type="submit">Actualizar Registro</button>
    </form>
    <br>
    <a href="/productos">Volver al listado</a>
</body>
</html>
