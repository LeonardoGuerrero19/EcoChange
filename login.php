<?php
    session_start();
    require "conection.php";

    if (isset($_POST['log-in'])) {
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $cap = "SELECT * FROM user WHERE user_email = '$email' AND user_password = '$password'";
        $result = mysqli_query($con, $cap);

        if (mysqli_num_rows($result) > 0) {
            // Obtener el tipo de usuario de la consulta
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['user_id'];
            $user_rol = $row['user_rol'];
            $user_name = $row['user_name'];

            // Iniciar sesión y redirigir según el tipo de usuario
            $_SESSION["user_id"] = $user_id;
            $_SESSION["user_rol"] = $user_rol;
            $_SESSION["user_name"] = $user_name;


            if ($user_rol == 'usuario_registrado') {
                header("Location: panel.php");
                exit();
            }
        }else {
            echo "<script> window.alert('¡Correo o contraseña incorrectos!');</script>";
        }
    }
?>