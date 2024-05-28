<?php
function Head() {
?>
    <div class="container-fluid">
        <img src="resources/images/logo.png" class="navbar-brand" alt="">
        <form class="d-flex" role="search" method="get" action="">
            <input class="form-control me-2" type="search" placeholder="Buscar por palabra clave" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES) : ''; ?>">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
        <?php
        if (!isset($_SESSION['user_name'])) {
            echo '<button class="Btn"><a href="register.php">Inicia Sesión</a></button>';
        } else {
            echo '<button class="Btn"><a href="">Notificaciones</a></button>';
        }
        ?>
    </div>
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