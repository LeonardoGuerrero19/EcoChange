<?php
    session_start();
    require "conection.php";

    if (isset($_POST['log-in'])) {
        $email = $_POST["email"];
        $user_password = $_POST["password"]; 

        // Recuperar la contraseña hasheada desde la base de datos
        $stmt= $con->prepare("SELECT user_password, user_rol, user_name FROM user WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password_from_database = $row['user_password']; // Pedir la contraseña de la base de datos para comprarla

            // Verificar si la contraseña proporcionada coincide con la contraseña hasheada almacenada
            if (password_verify($user_password, $hashed_password_from_database)) {
                // Si coinciden entonces se asignan el rol y el usuario:
                $user_rol = $row['user_rol'];
                $user_name = $row['user_name'];

                // Iniciar sesión y redirigir según el tipo de usuario
                $_SESSION["user_rol"] = $user_rol;
                $_SESSION["user_name"] = $user_name;

                if ($user_rol == 'usuario_registrado') {
                    header("Location: panel.php");
                    exit();
                }
            } else {
                // Contraseña incorrecta
                echo "<script> window.alert('¡Correo o contraseña incorrectos!'); window.location='register.php'</script>";
            }
        } else {
            // Usuario no encontrado
            echo "<script> window.alert('¡Correo o contraseña incorrectos!'); window.location='register.php'</script>";
        }
    }
?>
