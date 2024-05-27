<?php
session_start();
require "conection.php";
require "functions/side-bar.php";
require "functions/header.php";
require "functions/forms.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- css -->
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/all.css">
    <link rel="stylesheet" href="resources/css/profile-user.css">
    <link rel="stylesheet" href="resources/css/forms.css">
    <!-- js -->
    <script src="resources/js/bootstrap.bundle.min.js"></script>
    <title>Perfil de usuario</title>
</head>
<body>
    <header class="header">
        <section class="flex">
            <?php echo Head(); ?>
        </section>
    </header>

    <div class="nav" id="navbar">
        <?php
            echo SidebarProfile();
        ?>
    </div>

    <div class="content">
        <div class="pubs__container">
            <div class="form__create">
                <button id="open__form" class="form__insertText">Comparte con la comunidad ...</button>
                <div class="form__options">
                    
                    
                </div>
            </div>
            <hr id="form__line">

            <?php
            echo Modal_Create();

            date_default_timezone_set('America/Mexico_City'); // Establecer la zona horaria a la de México
            // Verificar si el usuario ha iniciado sesión y obtener su ID de usuario
            if (isset($_SESSION["user_id"])) {
                $user_id = $_SESSION["user_id"];

                // Consulta SQL para seleccionar las publicaciones del usuario actual
                $sql = "SELECT *, user.user_name AS user_name 
                        FROM post
                        INNER JOIN user ON post.user_id = user.user_id
                        WHERE post.user_id = $user_id";

                $res = mysqli_query($con, $sql);
                
                if (mysqli_num_rows($res) > 0) {
                    // Imprimir los datos de cada publicación
                    while ($row = mysqli_fetch_assoc($res)) {
                        if ($row["estado"] === "revisado") {
                            $post_id = $row['post_id'];
                            ?>
                            <div class="pubs__row">
                                <div class="pubs__header">
                                <div id="myModal-<?php echo $post_id; ?>" class="modal">
                                        <div class="modal-content">
                                            <div class="form__container">
                                                <div class="form__label">
                                                    <b>Editar publicación</b>
                                                    <button id="close__form"><i class="bi bi-x-circle-fill close"></i></button>
                                                </div>
                                                <hr>
                                                <form id="FormCreate" action="edit_post.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
                                                    <div class="form__user">
                                                        <div><?php echo $_SESSION["user_name"]; ?></div>

                                                        <div class="form__menu">
                                                            <select name="topic-post">
                                                                <option selected disabled>Temas</option>
                                                            <?php
                                                                $sql1 = "SELECT topic_name FROM topics";
                                                                $result1 = $con->query($sql1);

                                                                // mostrar los temas
                                                                if ($result1->num_rows > 0) {
                                                                    while ($row1 = $result1->fetch_assoc()) {
                                                                        echo '
                                                                        <option>'. $row1["topic_name"] .'</option>
                                                                        ';
                                                                    }
                                                                } 
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form__title">
                                                        <input type="text" name="title-post" value="<?php echo $row['post_titulo']?>">
                                                    </div>
                                                    <div class="form__text">
                                                        <textarea name="text-post"><?php echo $row['post_contenido']; ?></textarea>
                                                    </div>

                                                    <figure class="form__image">
                                                        <?php if (!empty($row['post_image'])): ?>            
                                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['post_image']); ?>"/>
                                                        <?php endif; ?>
                                                        <button type="button" id="remove-media"><i class="bi bi-x-circle-fill"></i></button>
                                                    </figure>

                                                    <input type="file" name="image-post">
                                                    
                                                    <div class="form__add">
                                                        <p>Agrega a tu publicación</p>
                                                        <div>
                                                            
                                                        </div>
                                                    </div>
                                                    <button class="form__input" id="PubForm" name="edit">Guardar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <?php echo $row["user_name"] . " - " . $row["post_creacion"]; ?>
                                    <div class="pubs__edit">
                                        <div class="pubs__editBtn">
                                            <span><i class="bi bi-three-dots"></i></span>
                                        </div>
                                        <ul class="options__edit">
                                            <button class="option__edit openModalButton" data-postid="<?php echo $post_id; ?>">
                                                <i class="bi bi-pencil-fill"></i>
                                                <span>Editar</span>
                                            </button>
                                            <form method="post" action="delete_post.php">
                                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                                <button class="option__edit" data-postid="<?php echo $post_id; ?>">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    <span>Eliminar</span>
                                                </button>
                                            </form>
                                        </ul>
                                    </div>
                                    <div id="theme-section"> <?php echo $row["post_tema"]; ?></div>
                                </div>
                                <div class="pubs__title">
                                    <b><?php echo $row["post_titulo"]; ?></b>
                                </div>
                                <div class="pubs__text">
                                    <?php echo $row["post_contenido"]; ?>
                                </div>
                                <div class="pubs__image">
                                    <?php if (!empty($row["post_image"])): ?>
                                        <img src="data:image/jpg/png/jpeg;base64,<?php echo base64_encode($row['post_image']);?>"/>
                                    <?php endif; ?>
                                </div>
                                <div class="pubs__options">
                                    <div class="pubs__likes">
                                        hola
                                    </div>
                                    <div class="pubs__comments">
                                        hola2
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php
                        }
                    }
                } else {
                    echo "No hay publicaciones.";
                }
            }
            ?>
        </div>
    </div>

    <script src="resources/js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const optionMenus = document.querySelectorAll(".pubs__edit");
        optionMenus.forEach(menu => {
            
            const selectBtn = menu.querySelector(".pubs__editBtn");
            selectBtn.addEventListener("click", () => {
                menu.classList.toggle("active");
            });
        });
    });       
    </script>
</body>

</html>