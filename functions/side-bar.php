<?php
    function Sidebar()
    {
    require "conection.php";

    $sql = "SELECT * FROM topics";
    $result = $con->query($sql);
    
    ?>
    <nav class="nav__container">
        <div>
            <div class="nav__list">
                <div class="nav__items">
                    <a href="panel.php" class="nav__link home">
                        <i class="bi bi-house-fill nav__icon"></i>
                        <span>Inicio</span>
                    </a>
                    <hr>
                    <div class="nav__dropdown">
                        <p>
                            <span>Temas</span>
                            <i class="bi bi-chevron-down nav__dropdown-icon"></i>
                        </p>

                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">
                                <?php
                                    // mostrar los temas
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<a href="view_topic.php?topic_id=' . $row["topic_id"] . '" class="nav__dropdown-item">' . $row["topic_name"] . '</a>';
                                        }
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile-user.php" class="nav__link home">
                        <i class="bi bi-person-circle nav__icon"></i>
                        <span>Ir a mi perfil</span>
                    </a>
                    <a href="logout.php" class="nav__link home">
                        <i class="bi bi-box-arrow-left nav__icon"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <?php
            if(isset($_SESSION['user_name'])) {
                echo '
                <a href="profile-user.php" class="nav__user">
                    <span>' . $_SESSION["user_name"] . '</span>
                </a>';
            }
        ?>
    </nav>
    <?php
    }

    function SidebarProfile()
    {
        require "conection.php";

        $sql = "SELECT topic_name FROM topics";
        $result = $con->query($sql);

        // Obtener el ID del usuario actual
        $user_id = $_SESSION['user_id'];

        // Consulta para contar las publicaciones del usuario
        $sql2 = "SELECT COUNT(*) AS post_count FROM post WHERE user_id = ? AND estado = 'revisado'";
        $stmt = $con->prepare($sql2);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result2 = $stmt->get_result();
        $row = $result2->fetch_assoc();
        $post_count = $row['post_count'];
        $stmt->close();
    ?>
    <nav class="nav__container">
        <div>
            <div class="nav__list">
                <div class="nav__items">
                    <a href="panel.php" class="nav__link home">
                        <i class="bi bi-house-fill nav__icon"></i>
                        <span>Inicio</span>
                    </a>
                    <hr>
                    <div class="nav__dropdown">
                        <p>
                            <span>Temas</span>
                            <i class="bi bi-chevron-down nav__dropdown-icon"></i>
                        </p>

                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">
                                <?php
                                    // mostrar los temas
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<a href="#" class="nav__dropdown-item">' . $row["topic_name"] . '</a>';
                                        }
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a href="profile-user.php" class="nav__link home">
                        <i class="bi bi-person-circle nav__icon"></i>
                        <span>Ir a mi perfil</span>
                    </a>
                    <a href="logout.php" class="nav__link home">
                        <i class="bi bi-box-arrow-left nav__icon"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="nav__profile">
            <div>
                <div id="circle">
                    <div id="circle2">
                        <?php
                            $user_id = $_SESSION['user_id'];
                            $sql = "SELECT user_photo FROM user WHERE user_id = ?";
                            $stmt = $con->prepare($sql);
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $_SESSION['user_photo'] = $row['user_photo']; // Almacena la URL de la foto de perfil en la sesión
                            } else {
                                $_SESSION['user_photo'] = 'default.png'; // Imagen por defecto si no hay foto de perfil
                            }
                        ?>
                        <img src="<?php echo empty($_SESSION['user_photo']) ? 'resources/images/default.png' : 'resources/images/' . $_SESSION['user_photo']; ?>">
                    </div>
                </div>
                <span><b><?php echo $_SESSION["user_name"] ?></b></span>
                <hr>    
                <span><b><?php echo $post_count; ?></b>&nbsp;&nbsp;publicaciones</span>
            </div>
        </div>
    </nav>
    <?php
    }

    function SidebarMod() {
    ?>
        <nav class="nav__container">
            <div>
                <div class="nav__list">
                    <div class="nav__items">
                        <a href="../panel.php" class="nav__link home">
                            <i class="bi bi-house-fill nav__icon"></i>
                            <span>Inicio</span>
                        </a>
                        <hr>
                        <div class="nav__themes">
                            <div class="nav__dropdown-content">
                                <div id="theme" class="nav__dropdown-item">
                                    <a href="dashboard.php">Administrar publicaciones</a>
                                </div>
                                <div id="theme" class="nav__dropdown-item">
                                    <a href="admin_users.php">Administrar Usuarios</a>
                                </div> 
                                <div id="theme" class="nav__dropdown-item">
                                    <a href="admin_temas.php">Administrar temas disponibles</a>
                                </div>
                            <?php
                            if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'administrador') {
                                echo '
                                <div id="theme" class="nav__dropdown-item">
                                    <a href="admin_mods.php">Administrar Moderadores</a>
                                </div>';
                            }
                            ?>
                            </div>
                        </div>
                        <hr>
                        <a href="../logout.php" class="nav__link home">
                            <i class="bi bi-box-arrow-left nav__icon"></i>
                            <span>Cerrar Sesión</span>
                        </a>
                    </div>
                </div>
            </div>

        <?php
        if(isset($_SESSION['user_name'])) {
            echo '
            <a href="../profile-user.php" class="nav__user">
                <span>' . $_SESSION["user_name"] . '</span>
            </a>';
        }
        ?>
        </nav>
        
    <?php
    }
    ?>
