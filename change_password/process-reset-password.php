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

$user_password = $_POST["user_password"];
$password_confirm = $_POST["password_confirm"];

if (strlen($user_password) < 8){
    die("La contraseña debe tener al menos 8 caracteres");
}

if( ! preg_match("/[a-z]/i", $user_password)){
    die("La contraseña debe tener al menos una letra");
}

if( ! preg_match("/[0-9]/", $user_password)){
    die("La contraseña debe tener al menos un número");
}

if ($user_password !== $password_confirm) {
    die("Las contraseñas no coinciden");
}

if (password_verify($user_password, $user['user_password'])) { // Utilizamos password_veridy para obtener la contraseña hasheada y compararla.
    die("La nueva contraseña debe ser diferente de la anterior");
}

$user_password_hashed = password_hash($user_password, PASSWORD_DEFAULT);

$sql = "UPDATE user
        SET user_password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE user_id = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("ss", $user_password_hashed, $user["user_id"]);

$stmt->execute();

echo "Contraseña actualizada. Intenta loguear de nuevo";
?>