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
#falta acomodar aqui abajo
    function HeadMod() {
?>
    <a href="panel.php" ><img src="../resources/images/logo.png" class="logo"></a>


    <a href="../panel.php" class="btn" style="margin-top: 0;">Panel general</a>

<?php
}
?>