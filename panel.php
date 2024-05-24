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
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $theme = isset($_GET['theme']) ? $_GET['theme'] : '';

            if (!empty($theme)) {
                $sql .= " WHERE post_tema = '$theme'";
                include 'functions/mien_user.php';
            } elseif (!empty($search)) {
                $sql .= " WHERE post_titulo LIKE '%$search%' OR post_contenido LIKE '%$search%' OR post_tema LIKE '%$search%'";
            }

            $res = mysqli_query($con, $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row["estado"] === "revisado") {
                        ?>
                        <div class="main-pubs">
                            <div class="headForm">
                                <?php echo $row["user_name"]; ?>
                                <div id="theme-section"> <?php echo $row["post_tema"]; ?></div>
                            </div>
                            <div class="text-pub">
                                <b><?php echo $row["post_titulo"]; ?></b>
                            </div>
                            <div class="text-pub">
                                <?php echo $row["post_contenido"]; ?>
                            </div>
                            <div class="image-pub">
                                <img src="data:image/jpg/png/jpeg;base64,<?php echo base64_encode($row['post_image']); ?>"/>
                            </div>

                            <!-- Botones de votación con íconos de flechas -->
                            <div class="vote-buttons my-2">
                                <button class="like-button btn btn-outline-primary" data-postid="<?php echo $row['post_id']; ?>">
                                    <i class="bi bi-arrow-up"></i>
                                </button>
                                <span id="like-count-<?php echo $row['post_id']; ?>" class="like-count"><?php echo $row['likes_count']; ?></span>
                                <button class="dislike-button btn btn-outline-secondary" data-postid="<?php echo $row['post_id']; ?>">
                                    <i class="bi bi-arrow-down"></i>
                                </button>
                                <span id="dislike-count-<?php echo $row['post_id']; ?>" class="dislike-count"><?php echo $row['dislikes_count']; ?></span>
                            </div>
                        </div>
                        <hr id="hr-pubs">
                        <?php
                    }
                }
            } else {
                if (!empty($search)) {
                    echo "No se encontraron publicaciones para la búsqueda: " . htmlspecialchars($search, ENT_QUOTES);
                } else {
                    echo "No hay publicaciones disponibles.";
                }
            }
            ?>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const voteButtons = document.querySelectorAll('.like-button, .dislike-button');
        voteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                const post_id = this.dataset.postid;
                const isLike = this.classList.contains('like-button');
                const action = isLike ? 'like' : 'dislike';

                fetch('vote.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `post_id=${post_id}&action=${action}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const likeCountElement = document.getElementById(`like-count-${post_id}`);
                        const dislikeCountElement = document.getElementById(`dislike-count-${post_id}`);

                        if (likeCountElement && dislikeCountElement) {
                            likeCountElement.textContent = data.likes;
                            dislikeCountElement.textContent = data.dislikes;
                        }

                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar el voto. Por favor, inténtelo de nuevo.');
                });
            });
        });
    });
    </script>

    <script src="resources/js/script.js"></script>
</body>
</html>
