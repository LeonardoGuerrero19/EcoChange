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
    <title>Login</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up" id="loginForm">
            <form action="signup.php" method="post">
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
            <form action="login.php" method="post">
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
                <a href="cambio_contra.php">¿Olvidaste tu contraseña?</a>
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

    <script src="resources/js/script.js"></script>
</body>
</html>
