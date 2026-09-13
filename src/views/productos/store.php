<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
</head>
<body>
    <h1>Crear Nuevo Producto</h1>

  
    <form action="/productos" method="POST">
        <div>
            <label for="nombre">Nombre del producto:</label><br>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <br>
        <div>
            <label for="precio">Precio:</label><br>
            <input type="number" step="0.01" id="precio" name="precio" required>
        </div>
        <br>
        <div>
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
        </div>
        <br>
        <button type="submit">Guardar Producto</button>
    </form>
</body>
</html>
