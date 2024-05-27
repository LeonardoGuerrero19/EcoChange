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
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/all.css">
    <!-- js -->
    <script src="../resources/js/bootstrap.bundle.min.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <header class="header">
        <section class="flex">
            <?php echo HeadMod(); ?>
        </section>
    </header>

    <div class="nav" id="navbar">
        <!-- Barra lateral -->
        <?php echo SidebarMod(); ?>
    </div>
        
        <!-- Mostrar publicaciones -->
        <div class="main-content">
            <div class="estado">
            <button id="showReviewed">Revisadas</button> 
            <button id="showPending">Pendientes</button>
            <button id="showInactive">Inactivas</button>

            </div>

            <div class="post-container">
            
            </div>
        </div>

        
    </div>

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../resources/js/cargar_estados.js"></script>
    <script src="../resources/js/script.js"></script>
    
</body>
</html>