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
#falta acomodar aqui abajo
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