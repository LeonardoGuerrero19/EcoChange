<?php
function Head() {
?>
    <div class="container-fluid header">
        <img src="resources/images/logo.png" class="navbar-brand" alt="">
        <form class="d-flex" role="search" method="get" action="">
            <input class="form-control me-2" type="search" placeholder="Buscar por palabra clave" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES) : ''; ?>">
            <button class="btn btn-secondary text-light" type="submit">Buscar</button>
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
        <img src="../resources/images/logo.png" class="navbar-brand" alt="">
        <form class="d-flex" role="search" method="get" action="">
            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES) : ''; ?>">
            <button class="btn" type="submit">Buscar</button>
        </form>
        <button class="Btn">
            <a href="">Notificaciones</a>
        </button>
    </div>
<?php
}
?>