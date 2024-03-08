<?php
    session_start();
    require "conection.php";

    if(isset($_POST['sign-up'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $verificarEmail = "SELECT user_email FROM user WHERE user_email = '$email'";
        $result = mysqli_query($con, $verificarEmail);

        if(mysqli_num_rows($result) >= 1) {
            echo "<script> window.alert('¡El email ya está en uso!'); window.location='register.php'</script>";
        } else {
            $insert = "INSERT INTO user (user_name, user_email, user_password, user_rol) VALUES ('$name', '$email', '$password', 'usuario_registrado')";
            if (mysqli_query($con, $insert)) {
                echo "<script> window.alert('¡Registro Exitoso!'); window.location='register.php'</script>";
            } else {
                echo "<script> window.alert('Error al registrar al usuario: " . mysqli_error($con). "');</script>";
            }
        }
    }
?>
