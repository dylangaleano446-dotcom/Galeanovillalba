<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Producto Creado</title>
</head>
<body>
    <h1>¡Producto Creado Exitosamente!</h1>
    
    <div style="border: 1px solid #ccc; padding: 15px; width: 300px;">
        <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
        <p><strong>Precio:</strong> $<?= htmlspecialchars($precio) ?></p>
        <p><strong>Descripción:</strong> <?= htmlspecialchars($descripcion) ?></p>
    </div>

    <br>
    <a href="/productos">Volver al listado</a>
</body>
</html>
