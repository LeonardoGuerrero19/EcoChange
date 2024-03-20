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
    <title>Panel General</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <?php echo Head(); ?>
    </nav>

    <div class="wrapper">

        <?php echo Sidebar(); ?>

        <div class="main-content">
            <?php 
                $sql = "SELECT *, user.user_name AS user_name FROM post
                INNER JOIN user ON post.user_id = user.user_id";
        
                $res = mysqli_query($con, $sql);
        
                if (mysqli_num_rows($res) > 0) {
                    // Imprimir los datos de cada publicación
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <div class="main-pubs">
                            <div class="headForm">
                                <?php echo $row["user_name"]; ?>
                                <div id="theme-section"> <?php echo $row["post_tema"]; ?></div>
                            </div>
                            <div class="title">
                                <b><?php echo $row["post_titulo"]; ?></b>
                            </div>
                            <div>
                                <?php echo $row["post_contenido"]; ?>
                            </div>
                        </div>
                        <hr id="hr-pubs">
                        
                    <?php
                        echo "Imagen: " . $row["post_image"] . "<br>";
                    }
                } else {
                    echo "No hay publicaciones.";
                }
            ?>
                </div>
                
            </div>
        </div>
    </div>

    <script src="resources/js/script.js"></script>
    
</body>
</html>