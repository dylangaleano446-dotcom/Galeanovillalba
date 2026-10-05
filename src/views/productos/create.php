<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
</head>
<body>
    <h1>Crear Nuevo Producto</h1>

    <form action="/productos" method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="price" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion"></textarea><br><br>

        <button type="submit">Guardar Registro</button>
    </form>
    <br>
    <a href="/productos">Volver al listado</a>
</body>
</html>
