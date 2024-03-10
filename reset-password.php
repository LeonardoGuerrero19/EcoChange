<?php

$token = $_GET["token"]; #Pedimos el token generado.

$token_hash = hash("sha256", $token); #obtenemos el hash de la base de datos para el token.

$mysqli = require __DIR__ . "/conection.php";

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

echo "token es valido y no ha caducado";

#Video de explicacion: https://youtu.be/R9bfts9ZFjs?t=1027