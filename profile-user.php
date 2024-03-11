<?php
    session_start();
    require "conection.php";
    require "functions/side-bar.php";
    require "functions/header.php";

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
    <title>Perfil de usuario</title>
</head>
<body>
<nav class="navbar bg-body-tertiary">
        <?php echo Head(); ?>
    </nav>

    <div class="wrapper">

        <?php echo SidebarProfile(); ?>

        <div class="main-content">
            <div class="content">
                hola
            </div>
        </div>
    </div>

    <script src="resources/js/script.js"></script>
    
</body>
</html>
