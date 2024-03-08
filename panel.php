<?php
    session_start();
    require "conection.php";
    require "functions/side-bar.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- css -->
    <link rel="stylesheet" href="resources/css/panel.css">
    <link rel="stylesheet" href="resources/css/all.css">
    <!-- js -->
    <script src="resources/js/bootstrap.bundle.min.js"></script>
    <title>Panel General</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <img src="resources/images/logo.png" class="navbar-brand" alt="">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
            </form>
            <?php
            if(!isset($_SESSION['user_name'])) {
                echo '
                <button class="loginBtn">
                    <a href="register.php">Inicia Sesión</a>
                </button>';
            } else {
                echo '
                <button class="loginBtn">
                    <a href="">Notificaciones</a>
                </button>';
            }
            ?>
        </div>
    </nav>

    <div class="wrapper">

        <?php echo Sidebar(); ?>

        <div class="main-content">
            <div class="content">
                hola
            </div>
        </div>
    </div>

    <script src="resources/js/script.js"></script>
    
</body>
</html>