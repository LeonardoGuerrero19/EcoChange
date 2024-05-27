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
    <a href="panel.php" ><img src="../resources/images/logo.png" class="logo"></a>

    <div class="search-container">
        <input type="text" id="search-input" placeholder="Buscar" oninput="toggleClearButton()">
        <button id="clear-btn" onclick="clearSearch()"><i class="bi bi-x"></i></button>
    </div>

<?php
}
?>