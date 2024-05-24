<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/all.css">
    <link rel="stylesheet" href="../resources/css/cambio_contra.css">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <div class="container-wrapper">
        <!-- <div class="image-container">
          <img src="/image/email2.svg" alt="simulacion email">
        </div> -->
        <div class="container">
          <h2>Cambio de Contraseña</h2>
          <div style="justify-content:center;display: grid;">
            <img src="../resources/images/email.svg" class="email-icon">
          </div>
          <h1>Ingrese el correo de su cuenta para reestablecer su contraseña</h1>
          <form action="../change_password/send_password_reset.php" method="post">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="user_email" name="user_email" required>
            <input type="submit" value="Enviar Solicitud">
          </form>
        </div>
      </div>   
</body>
</html>