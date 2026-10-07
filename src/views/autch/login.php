<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>iniciar sesion</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form action="/auth/login" method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Ingresar</button>
    </form>
    <br>
    <a href="/auth/register">si no tenes cuenta? Registrate</a>
</body>
</html>
