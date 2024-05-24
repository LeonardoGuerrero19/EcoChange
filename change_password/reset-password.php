<?php

require "../conection.php";

$token = $_GET["token"]; #Pedimos el token generado.

$token_hash = hash("sha256", $token); #obtenemos el hash de la base de datos para el token.

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null){
    die("token no encontrado");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token ha caducado");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/reset_pass.css">
    <title>Cambio-contraseña</title>
</head>
<body>
    <div class="container-wrapper">
        <!-- <div class="image-container">
          <img src="/image/pass3.svg" class="pass-image">
        </div> -->
    <div class="container">
    <h1>Reset Password</h1>
    <img src="../resources/images/pass.svg" class="pass-icon">
    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        
        <label for="password">Nueva contraseña:</label>
        <input type="password" id="user_password" name="user_password">

        <label for="password_confirm">Repita su contraseña:</label>
        <input type="password" id="password_confirm" name="password_confirm">

        <button>Confirmar y enviar</button>
    </form>
</div>
<div class="image-container">
    <img src="../resources/images/pass3.svg" class="pass-image">
  </div>
</div>
</body>
</html>