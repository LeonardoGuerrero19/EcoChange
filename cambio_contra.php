<!-- change_password.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/all.css">
    <link rel="stylesheet" href="resources/css/cambio_contra.css">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <h2>Cambiar Contraseña</h2>
    <div class="container">
        <form  method="post" action="send_password_reset.php">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Enviar Solicitud">
        </form>
    </div>
    
</body>
</html>
