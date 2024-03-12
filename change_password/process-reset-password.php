<?php

require "../conection.php";

$token = $_POST["token"]; #Pedimos el token generado.

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

if (strlen($_POST["user_password"]) < 8){
    die("La contraseña debe tener almenos 8 caracteres");
}

if( ! preg_match("/[a-z]/i", $_POST["user_password"])){
    die("La contraseña debe tener almenos una letra");
}

if( ! preg_match("/[0-9]/", $_POST["user_password"])){
    die("La contraseña debe tener almenos un numero");
}

if ($_POST["user_password"] !== $_POST["password_confirm"]) {
    die("Las contraseñas no coinciden");
}

$user_password = md5($_POST["user_password"]);

$sql = "UPDATE user
        SET user_password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE user_id = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("ss", $user_password, $user["user_id"]);

$stmt->execute();

echo"Contraseña actualizada. Intenta loguear denuevo";