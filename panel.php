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
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/all.css">
    <!-- js -->
    <script src="resources/js/bootstrap.bundle.min.js"></script>
    <title>Panel General</title>
</head>
<body>
    <header class="header">
        <section class="flex">
            <?php echo Head(); ?>
        </section>
    </header>

    <div class="nav" id="navbar">
        <?php
            echo Sidebar();
        ?>
    </div>

    <div class="content">
        <div class="pubs__container">
            <?php 
                $sql = "SELECT *, user.user_name AS user_name FROM post
                INNER JOIN user ON post.user_id = user.user_id";
        
                $res = mysqli_query($con, $sql);
        
                if (mysqli_num_rows($res) > 0) {
                    // Imprimir los datos de cada publicación
                    while ($row = mysqli_fetch_assoc($res)) {
                        if($row["estado"] === "revisado"){
                            ?>
                            <div class="pubs__row">
                                <div class="pubs__header">
                                    <?php echo $row["user_name"]; ?>
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
            ?>
        </div>
        <div class="other-section">
            hola2
        </div>
    </div>

    <script src="resources/js/script.js"></script>
</body>
</html>