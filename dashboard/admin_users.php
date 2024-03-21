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
    <title>Administrar Usuarios</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <?php echo Head(); ?>
    </nav>

    <div class="wrapper">
        <!-- Barra lateral -->
        <?php echo SidebarMod(); ?>
        
        <!-- Mostrar usuarios -->
        <div class="main-content">
            <h1>Administrar Usuarios</h1>
            <div class="rol">
                <button id="showInactiveUser" onclick="loadUsers('inactive')">Cuentas Inactivas</button>
            </div>
            
            <div class="users-container">
                <?php
                    // Incluir el archivo para cargar usuarios
                    require "load_users.php";
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Otros scripts aquí si los necesitas -->
</body>
</html>
