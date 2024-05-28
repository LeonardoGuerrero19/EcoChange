<?php
session_start();
require "conection.php";
require "functions/side-bar.php";
require "functions/header.php";

// Asegúrate de que el usuario esté autenticado
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
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
        <?php echo Sidebar(); ?>
    </div>

    <div class="content">
        <div class="pubs__container">
            <?php 
            date_default_timezone_set('America/Mexico_City'); // Establecer la zona horaria a la de México
            $sql = "SELECT post.*, user.user_name, topics.topic_id, topics.topic_name 
                    FROM post
                    INNER JOIN user ON post.user_id = user.user_id
                    INNER JOIN topics ON post.post_tema = topics.topic_name";

            $res = mysqli_query($con, $sql);

            if (mysqli_num_rows($res) > 0) {
                // Imprimir los datos de cada publicación
                while ($row = mysqli_fetch_assoc($res)) {
                    $post_id = $row['post_id']; // Definir $post_id aquí
                    if ($row["estado"] === "revisado") { ?>
                        <div class="pubs__row">
                            <div class="pubs__header">
                                <?php echo $row["user_name"] . " - " . $row["post_creacion"]; ?>
                                <div id="theme-section"> 
                                    <a href="view_topic.php?topic_id=<?php echo $row['topic_id']; ?>">
                                        <?php echo $row["post_tema"]; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="pubs__title">
                                <b><?php echo $row["post_titulo"]; ?></b>
                            </div>
                            <div class="pubs__text">
                                <?php echo $row["post_contenido"]; ?>
                            </div>
                            <div class="pubs__image">
                                <?php if (!empty($row["post_image"])): ?>
                                    <img src="data:image/jpg/png/jpeg;base64,<?php echo base64_encode($row['post_image']); ?>"/>
                                <?php endif; ?>
                            </div>
                            <div class="pubs__options">
                                <div class="pubs__likes">
                                    <?php
                                    // Consulta para obtener el número de likes de la publicación actual
                                    $stmt = $con->prepare("SELECT COUNT(*) AS like_count FROM likes WHERE post_id = ?");
                                    $stmt->bind_param("i", $post_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $like_count = $result->fetch_assoc()['like_count'];
                                    ?>
                                    <form action="agregar_like.php" method="post">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                        <button id="like-btn-<?php echo $post_id; ?>" class="like-btn" type="submit" name="liked"><i class="bi bi-hand-thumbs-up-fill"></i></button>
                                        <span class="like-count"><?php echo $like_count; ?></span>
                                        <button class="like-btn" type="submit" name="disliked"><i class="bi bi-hand-thumbs-down-fill"></i></button>
                                </form>

                                </div>
                                <div class="pubs__comments">
                                    <?php
                                    // Contar el número de comentarios para la publicación actual
                                    $comment_count_sql = "SELECT COUNT(*) AS comment_count FROM comments WHERE post_id = ?";
                                    $comment_count_stmt = $con->prepare($comment_count_sql);
                                    $comment_count_stmt->bind_param("i", $post_id);
                                    $comment_count_stmt->execute();
                                    $comment_count_res = $comment_count_stmt->get_result();
                                    $comment_count_row = $comment_count_res->fetch_assoc();
                                    $comment_count = $comment_count_row['comment_count'];
                                    ?>
                                    <button id="OpenProfileBtn-<?php echo $post_id; ?>" class="pubs__button">
                                        <i class="bi bi-chat-left-dots">&nbsp;</i>
                                        <?php echo $comment_count; ?>
                                    </button>
                                    <div id="OpenProfileModal-<?php echo $post_id; ?>" class="modal">
                                        <div class="modal-content">
                                            <form action="comments.php" method="post">
                                                <p for="comment" class="text__edit">Comentarios</p>
                                                <hr>
                                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                                <textarea name="comment_text" placeholder="Agrega un comentario"></textarea>
                                                <button type="submit" class="btn">Comentar</button>
                                                <hr>
                                            <?php
                                            // Mostrar comentarios
                                            $comment_sql = "SELECT c.comment, u.user_name 
                                                            FROM comments c 
                                                            INNER JOIN user u ON c.user_id = u.user_id 
                                                            WHERE c.post_id = ?";
                                            $comment_stmt = $con->prepare($comment_sql);
                                            $comment_stmt->bind_param("i", $post_id);
                                            $comment_stmt->execute();
                                            $comment_res = $comment_stmt->get_result();

                                            if ($comment_res->num_rows > 0) {
                                                while ($comment_row = $comment_res->fetch_assoc()) {
                                                    echo "<div class='comment'>";
                                                    echo "<b>" . htmlspecialchars($comment_row['user_name']) . "</b><br> ";
                                                    echo htmlspecialchars($comment_row['comment']);
                                                    echo "</div>";
                                                }
                                            } else {
                                                echo "<p>No hay comentarios.</p>";
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>
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
        <?php if (isset($_SESSION['user_id'])): ?>
    <div class="fav__container">
        <div class="fav__title">
            <p>FAVORITOS</p>
        </div>
        <div class="fav__content">
            <?php
            $user_id = $_SESSION['user_id'];

            // Obtener los topic_id que el usuario sigue
            $sql = "SELECT t.topic_id, t.topic_name, COUNT(f2.user_id) AS follower_count
                    FROM follows f
                    INNER JOIN topics t ON f.topic_id = t.topic_id
                    LEFT JOIN follows f2 ON t.topic_id = f2.topic_id
                    WHERE f.user_id = ?
                    GROUP BY t.topic_id, t.topic_name";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="fav__theme">
                        <a href="view_topic.php?topic_id=<?php echo $row['topic_id']; ?>">
                            <?php echo htmlspecialchars($row['topic_name']); ?>
                        </a>
                        <br>
                        <p><?php echo htmlspecialchars($row['follower_count']); ?> miembros</p>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No sigues ningún tema.</p>";
            }
            ?>
        </div>
    </div>
<?php endif; ?>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalBtns = document.querySelectorAll('button[id^="OpenProfileBtn-"]');
        modalBtns.forEach(function(btn) {
            var post_id = btn.id.split('-')[1];
            var modal = document.getElementById('OpenProfileModal-' + post_id);

            btn.onclick = function() {
                modal.style.display = 'block';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        });
    });
    </script>

    <script src="resources/js/script.js"></script>
    <script src="resources/js/admin_temas.js"></script>
</body>
</html>
