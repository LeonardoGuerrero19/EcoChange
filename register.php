<?php
    session_start();
    require "conection.php";

    if(isset($_SESSION['user_name'])) {
        header("Location: panel.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- styles -->
    <link rel="stylesheet" href="resources/css/register.css">
    <link rel="stylesheet" href="resources/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up" id="loginForm">
            <form id="signup" method="post">
                <h1>Crea una cuenta</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin"></i></a>
                </div>
                <span>O usa tu contraseña para registrarte</span>
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit" name="sign-up">Regístrate</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form id="loginForm" method="post">
                <h1>Inicia sesión</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin"></i></a>
                </div>
                <span>O usa tu contraseña y correo</span>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <a href="change_password/cambio_contra.php">¿Olvidaste tu contraseña?</a>
                <button name="log-in">Iniciar sesión</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¡Bienvenido!</h1>
                    <p>Inicia sesión para acceder a todo el contenido del foro ya mismo</p>
                    <button class="hidden" id="login">Inicia sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Regístrate ya mismo!</h1>
                    <p>Regístrate ahora con tu email para acceder a todas las funcionalidades de nuestro foro</p>
                    <button class="hidden" id="register">Regístrate</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    #--------PROCESO DEL LOGIN--------#
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
            // Mostrar alerta SweetAlert2 para contraseña incorrecta
            echo '<script language="javascript">
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "¡Correo o contraseña incorrectos!",
                        confirmButtonColor: "#28a745",
                        confirmButtonText: "OK",
                    }).then(function() {
                        window.location.href = "register.php";
                    });
                });
            </script>';
        }
    } else {
        // Mostrar alerta SweetAlert2 para usuario no encontrado
        echo '<script language="javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "¡Correo o contraseña incorrectos!",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "OK",
                }).then(function() {
                    window.location.href = "register.php";
                });
            });
        </script>';
    }
}

#-----------------PROCESO DEL REGISTRO---------------------#
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
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '¡El correo electrónico ya está en uso!'
                }).then(function() {
                    window.location='register.php';
                });
            </script>";
    } else {
        // Vamos a verificar que la contra tenga minimo 8 caracteres y un numero.
        if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/", $password)) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '¡Introduzca una contraseña de al menos 8 caracteres y que contenga al menos un número por su seguridad!'
                    }).then(function() {
                        window.location='register.php';
                    });
                </script>";
        } else{
            // Insertar el usuario solo si el correo electrónico no está en uso y se acepta la contraseña.
        $password_hashed = password_hash($password, PASSWORD_DEFAULT); // Haseo de la contraseña
        $stmt = $con->prepare("INSERT INTO user (user_name, user_email, user_password, user_rol) VALUES (?, ?, ?, 'usuario_registrado')");
        $stmt->bind_param("sss", $name, $email, $password_hashed);

        if ($stmt->execute()) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        text: '¡Tu registro ha sido exitoso!'
                    }).then(function() {
                        window.location='register.php';
                    });
                </script>";
        } else {
            echo "<script> window.alert('Error al registrar al usuario');</script>";
        }
    }
    }
        }
        

?>
<div class="hide" id="container">
    <!-- Tu código HTML existente -->

    <!-- Espacio reservado para la alerta -->
    <div id="alert-placeholder"></div>
</div>

    <script src="resources/js/script.js"></script>
</body>
</html>