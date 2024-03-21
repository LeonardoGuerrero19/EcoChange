<?php
    function Head()
    { 
?>
    <div class="container-fluid">
        <img src="resources/images/logo.png" class="navbar-brand" alt="">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        </form>
        <?php
        if(!isset($_SESSION['user_name'])) {
            echo '
            <button class="Btn">
                <a href="register.php">Inicia Sesión</a>
            </button>';
        } else {
            echo '
            <button class="Btn">
                <a href="">Notificaciones</a>
            </button>';
        }
        ?>
    </div>
<?php
    }

    function HeadMod() {
?>
    <div class="container-fluid">
        <img src="../resources/images/logo.png" class="navbar-brand" alt="">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        </form>
        <button class="Btn">
            <a href="">Notificaciones</a>
        </button>
    </div>
<?php
    }
?>