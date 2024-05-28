<?php
function Head() {
?>
        <a href="panel.php" ><img src="resources/images/logo.png" class="logo"></a>

        
        <?php
        if (!isset($_SESSION['user_name'])): ?>
            <a href="register.php" class="btn" style="margin-top: 0;">Inicia sesión</a>
        <?php else: ?>
            <button id="editProfileBtn" class="btn" style="margin-top: 0;">Editar mi perfil</button>
            <?php if ($_SESSION['user_rol'] == 'moderador' || $_SESSION['user_rol'] == 'administrador'): ?>
                <a href="dashboard/dashboard.php" class="btn" style="margin-top: 0;">Panel de administración</a>
            <?php endif; ?>
        <?php endif; ?>
<?php
}

function HeadMod() {
    ?>
        <div class="container-fluid">
            <!-- Logo y otros elementos de la barra de navegación -->
            <img src="resources/images/logo.png" class="navbar-brand" alt="">
            <form id="searchForm" class="d-flex" role="search" onsubmit="return false;">
                <input id="searchTerm" class="form-control me-2" type="search" placeholder="Buscar por palabra clave" aria-label="Search">
                <button id="searchButton" class="btn btn-outline-success" type="button">Buscar</button>
            </form>
            <!-- Botón para notificaciones u otras acciones -->
        </div>
    <?php
    }
    ?>