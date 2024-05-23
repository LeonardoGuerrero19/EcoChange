<?php
    session_start();
    require "../conection.php";
    require "../functions/side-bar.php";
    require "../functions/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- css -->
    <link rel="stylesheet" href="../resources/css/panel_mod.css">
    <link rel="stylesheet" href="../resources/css/all.css">
    <!-- js -->
    <script src="../resources/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Administrador de Moderadores</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <?php echo HeadMod(); ?>
    </nav>

    <div class="wrapper">
        <!-- Barra lateral -->
        <?php echo SidebarMod(); ?>
        
        <!-- Mostrar usuarios -->
        <div class="main-content">
            <div class="estado">
                <button id="showRegistered">Usuarios Registrados</button>
                <button id="showModerador">Moderadores activos</button>
            </div>

            <div class="user-container">
                <!-- Aquí se cargarán los usuarios -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../resources/js/cargar_user_mod.js"></script>
    <script src="../resources/js/confirmar_accion.js"></script>
    <script src="../resources/js/script.js"></script>
</body>
</html>
