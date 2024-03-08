<?php

$email = $_POST["user_email"]; //Verificar email

$token = bin2hex(random_bytes(16)); //Se general el token aleatorio. Con ayuda de randombytes se genera un token aleatorio.

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() +60 * 30);

$mysqli = require __DIR__ . "/database.php";

$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE user_email = ?";
$stmt = $mysqli->prepare($sql);