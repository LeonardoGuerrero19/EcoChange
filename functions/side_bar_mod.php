<?php
function SidebarMod() {
?>
    <div class="sidebar">
        <div class="home">
            <a href="../panel.php"><i class="bi bi-house"></i> Home</a>
        </div>
        <hr>
        <div id="theme">
            <i class="bi bi-tree-fill icon"></i>
            <div><a href="dashboard.php">Administrar publicaciones</a></div>
        </div>
        <div id="theme">
            <i class="bi bi-water icon"></i>
            <div><a href="admin_users.php">Administrar Usuarios</a></div>
        </div>
        <div id="theme">
            <i class="bi bi-globe-americas icon"></i>
            <div><a href="#">Administrar temas disponibles</a></div>
        </div>
        <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'administrador'): ?>
            <div id="theme">
                <i class="bi bi-shield-lock icon"></i>
                <div><a href="admin_mods.php">Administrar Moderadores</a></div>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_name'])): ?>
            <div id="Options" class="options">
                <button class="userBtn" onclick="OptionsActive()"><?= htmlspecialchars($_SESSION['user_name']) ?></button>
                <div class="options-content">
                    <button class="opt">
                        <i class="bi bi-person-fill"></i>
                        <div><a href="profile-user.php">Ir a mi perfil</a></div>
                    </button>
                    <button class="opt">
                        <i class="bi bi-box-arrow-left"></i>
                        <div><a href="../logout.php">Cerrar Sesión</a></div>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php
}
?>
