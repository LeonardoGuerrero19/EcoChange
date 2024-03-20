<?php
    session_start();
    require "conection.php";
    require "functions/side-bar.php";
    require "functions/header.php";

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
    <link rel="stylesheet" href="resources/css/panel.css">
    <link rel="stylesheet" href="resources/css/all.css">
    <link rel="stylesheet" href="resources/css/forms.css">
    <!-- js -->
    <script src="resources/js/bootstrap.bundle.min.js"></script>
    <title>Perfil de usuario</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <?php echo Head(); ?>
    </nav>

    <div class="wrapper">

        <?php echo SidebarProfile(); ?>

        <div class="main-content">
            <div class="content">
                <input type="button" class="btnPubs" value="  Comparte con la comunidad ... "  onclick="showForm()">
                <div id="optsPubs">
                    <button class="optsPubs"><i class="bi bi-image"></i> Imagen</button>
                    <button class="optsPubs"><i class="bi bi-camera-reels"></i></i> Video</button>
                </div>
            </div>
        </div>
    </div>

    <div id="BckgForm">
    <button onclick="closeForm()" class="closeButton"><i class="bi bi-x-circle"></i></button>
        <form id="FormCreate" action="create_post.php" method="post" enctype="multipart/form-data">
            <div id="contentForm">
                <h1>Crear publicación</h1>
                <hr class="pForm">
                <div class="headForm">
                    <div class="userForm"><?php echo $_SESSION["user_name"]; ?></div>
                    <input type="button" class="topicsForm" value="TEMAS" onclick="showTopics()">
                    <div id="topics">
                        <?php
                            $sql = "SELECT topic_name FROM topics";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<div id='topic-options'>";
                                    echo "<input type='radio' class='btn-options' name='topic-post' value='". $row["topic_name"] ."'>";
                                    echo "<label class='btn btn-text'>". $row["topic_name"] ."</label>";
                                    echo "</div>";
                                }
                            }  
                        ?>
                    </div>
                </div>
                <div>
                    <input type="text" name="title-post" placeholder="Escribe un título">
                </div>
                <div class="textForm">
                    <textarea placeholder="Comparte con la comunidad" name="text-post"></textarea>
                </div>
                <div class="optionsForm">
                    <p>Agrega a tu publicación</p>
                    <div>
                    <input type="file" id="fileImage" name="image-post" accept="image/*" />
                    <label for="fileImage"><i class="bi bi-image"></i></label>
                    <input type="file" id="fileVideo" name="video-post" accept="video/*" />
                    <label for="fileVideo"><i class="bi bi-camera-reels"></i></label>
                    </div>
                </div>
                <button class="Btn" id="PubForm" name="create">Publicar</button>
            </div>
        </form>
    </div>

    <script src="resources/js/script.js"></script>
</body>

</html>
