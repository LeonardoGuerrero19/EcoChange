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
                        <div><a href="#">Vida de ecosistemas</a></div>
                    </div>
                    <div id="theme">
                        <i class="bi bi-water icon"></i>
                        <div><a href="#">Vida submarina</a></div>
                    </div> 
                    <div id="theme">
                        <i class="bi bi-globe-americas icon"></i>
                        <div><a href="#">Acción por el clima</a></div>
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
                        <div class="a">Ir a mi perfil</div>
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
    ?>