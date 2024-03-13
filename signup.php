<?php
session_start();
require "conection.php";

if(isset($_POST['sign-up'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Verificar si el correo electrónico ya está en uso
    $stmt = $con->prepare("SELECT user_email FROM user WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows >= 1) {
        echo "<script> window.alert('¡El email ya está en uso!'); window.location='register.php'</script>";
    } else {
        // Insertar el usuario solo si el correo electrónico no está en uso
        $stmt = $con->prepare("INSERT INTO user (user_name, user_email, user_password, user_rol) VALUES (?, ?, ?, 'usuario_registrado')");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            echo "<script> window.alert('¡Registro Exitoso!'); window.location='register.php'</script>";
        } else {
            echo "<script> window.alert('Error al registrar al usuario');</script>";
        }
    }
}
?>
