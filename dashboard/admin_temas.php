<?php
    session_start();
    require "../conection.php";
    require "../functions/side-bar.php";
    require "../functions/header.php";
    require "../functions/forms.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/panel_mod.css">
    <link rel="stylesheet" href="../resources/css/all.css">
    <!-- JavaScript -->
    <script src="../resources/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Dashboard temas</title>
</head>
<body>
    <!-- Barra de navegación -->
    <header class="header">
        <section class="flex">
            <?php echo HeadMod(); ?>
        </section>
    </header>

    <div class="nav" id="navbar">
        <!-- Barra lateral -->
        <?php echo SidebarMod(); ?>
    </div>

    <!-- Wrapper -->
    <div class="content">   
        <!-- Contenido principal -->
        <div class="main-content">
            <!-- Botón para mostrar el formulario de manera flotante -->
            <div class="content-header">
                <button id="show-form-btn" class="agregar-tema-btn">Agregar Nuevo Tema</button>
            </div>

            <!-- Ventana modal -->
            <?php echo Modal_Add_Topic(); ?>

            <!-- Fondo gris oscurecido -->
            <div class="overlay" id="overlay" style="display: none;"></div>

            <!-- Cargar temas existentes -->
            <?php include 'cargar_temas.php'; ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../resources/js/admin_temas.js"></script>
    <script src="../resources/js/eliminar_tema.js"></script>
    <script src="../resources/js/script.js"></script>
</body>
</html>
