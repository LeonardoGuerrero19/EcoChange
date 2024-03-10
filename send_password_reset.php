<?php

$email = $_POST["user_email"]; //Verificar email

$token = bin2hex(random_bytes(16)); //Se general el token aleatorio. Con ayuda de randombytes se genera un token aleatorio.

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() +60 * 30);

$mysqli = require __DIR__ . "/conection.php";

$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE user_email = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($con->affected_rows){ #Si se detectan lineas afectadas entonces:
    $mail = require __DIR__ . "/mailer.php"; #Se toma la configuracion del archivo mail.

    $mail->setFrom("foroecochange@outlook.com"); #configurar desde donde enviamos el correo
    $mail->addAddress($email); #Pasamos la direccion a donde mandaremos el correo.
    $mail->Subject = "Requerimiento de cambio de contraseña"; #<---Cuerpo del correo que se envia.
    $mail->Body = <<<END

    Click <a href="http://localhost/EcoChange/reset-password.php?token=$token">Aquí</a>
    para restablecer tú contraseña.

    END;#<---Cuerpo del correo que se envia.

    try {
        $mail->send();
    } catch( Exception $e){
        echo "No se pudo enviar el mensaje. Mailer error: {$mail->ErrorInfo}";
    }
}
echo "Mensaje enviado, Porfavor revise su bandeja de correos.";