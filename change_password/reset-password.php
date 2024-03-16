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
    <link rel="stylesheet" href="../resources/css/all.css">
    <title>Cambio-contraseña</title>
</head>
<body>
    <h1>Reset Password</h1>

    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        
        <label for="password">Su nueva contraseña:</label>
        <input type="password" id="user_password" name="user_password">

        <label for="password_confirm">Repita su contraseña</label>
        <input type="password" id="password_confirm" name="password_confirm">

        <button>Confirmar y enviar</button>
    </form>
    
</body>
</html>