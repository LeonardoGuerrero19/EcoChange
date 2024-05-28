<?php
function Head() {
?>
        <a href="panel.php" ><img src="resources/images/logo.png" class="logo"></a>

        <div class="search-container">
            <input type="text" id="search-input" placeholder="Buscar" oninput="toggleClearButton()">
            <button id="clear-btn" onclick="clearSearch()"><i class="bi bi-x"></i></button>
        </div>
        
        <?php
        if(!isset($_SESSION['user_name'])) {
            echo '
            <a href="register.php" class="btn" style="margin-top: 0;">Inicia sesión</a>';
        } else {
            echo '
            <a href="#" class="btn" style="margin-top: 0;">Notificaciones</a>';
        }
        ?>
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