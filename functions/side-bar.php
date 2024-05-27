<?php
    function Sidebar()
    {
    ?>
    <div class="sidebar">
            <div class="home">
                <a href="panel.php"><i class="bi bi-house"></i>Home</a>
            </div>
            <hr>
            <div class="dropdown" id="Dropdown">
                <button class="dropbtn" onclick="DropdownActive()">Temas
                    <div class="arrow-box">
                        <i class="bi bi-chevron-down" id="down"></i>
                        <i class="bi bi-chevron-up" id="up"></i>
                    </div>
                </button>
                <div class="dropdown-content">
                    <div id="theme">
                        <i class="bi bi-tree-fill icon"></i>
                        <div><a href="?theme=Vida de ecosistemas">Vida de ecosistemas</a></div>
                    </div>
                    <div id="theme">
                        <i class="bi bi-water icon"></i>
                        <div><a href="?theme=Vida submarina">Vida submarina</a></div>
                    </div> 
                    <div id="theme">
                        <i class="bi bi-globe-americas icon"></i>
                        <div><a href="?theme=Acción por el clima">Acción por el clima</a></div>
                    </div> 
                </div>
            </div>
            <?php
            if(isset($_SESSION['user_name'])) {
                echo '
                <div id="Options" class="options">
                <button class="userBtn" onclick="OptionsActive()">' . $_SESSION["user_name"] . '</button>
                <div class="options-content">
                    <button class="opt">
                        <i class="bi bi-person-fill"></i>
                        <div><a href="profile-user.php">Ir a mi perfil</a></div>
                    </button>
                    <button class="opt">
                        <i class="bi bi-box-arrow-left"></i>
                        <div><a href="logout.php">Cerrar Sesión</a></div>
                    </button>
                </div>
            </div>';
            }
            ?>
        </div>
    <?php
    }

    function SidebarProfile()
    {
    ?>
        <div class="sidebar">
            <div class="home">
                <a href="panel.php"><i class="bi bi-house"></i>Home</a>
            </div>
            <hr>
            <div class="dropdown" id="Dropdown">
                <button class="dropbtn" onclick="DropdownActive()">Temas
                    <div class="arrow-box">
                        <i class="bi bi-chevron-down" id="down"></i>
                        <i class="bi bi-chevron-up" id="up"></i>
                    </div>
                </button>
                <div class="dropdown-content">
                    <div id="theme">
                        <i class="bi bi-tree-fill icon"></i>
                        <div><a href="panel.php?theme=Vida de ecosistemas">Vida de ecosistemas</a></div>
                    </div>
                    <div id="theme">
                        <i class="bi bi-water icon"></i>
                        <div><a href="panel.php?theme=Vida Submarina">Vida submarina</a></div>
                    </div> 
                    <div id="theme">
                        <i class="bi bi-globe-americas icon"></i>
                        <div><a href="panel.php?theme=Acción por el clima">Acción por el clima</a></div>
                    </div> 
                </div>
            </div>
            <div class="options">
                <div class="profile">
                    <div id="cir">
                        <div id="cir2">
                        </div>
                    </div>
                    <p><b><?php echo $_SESSION["user_name"] ?></b></p>
                    <hr>
                    <p><b>250</b><br>publicaciones</p>
                    <button class="Btn" >
                        <a href="#">Editar perfil</a>
                    </button>
                </div>
            </div>
        </div>
    <?php
    }

    function SidebarMod() {
    ?>
        <div class="sidebar">
            <div class="home">
                <a href="../panel.php"><i class="bi bi-house"></i> Home</a>
            </div>
            <hr>
            <div id="theme">
                <div><a href="dashboard.php">Administrar publicaciones</a></div>
            </div>
            <div id="theme">
                <div><a href="admin_users.php">Administrar Usuarios</a></div>
            </div> 
            <div id="theme">
                <div><a href="admin_temas.php">Administrar temas disponibles</a></div>
            </div>
            <?php
            if (isset($_SESSION['user_name'])) {
                echo '
                <div id="Options" class="options">
                <button class="userBtn" onclick="OptionsActive()">' . htmlspecialchars($_SESSION["user_name"]) . '</button>
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
            </div>';
            }
            if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'administrador') {
                echo '
                <div id="theme">
                    <i class="bi bi-shield-lock icon"></i>
                    <div><a href="admin_mods.php">Administrar Moderadores</a></div>
                </div>';
            }
            ?>
        </div>
    <?php
    }
    ?>
