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
    <title>Panel de tema</title>
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
            <div class="header__theme">
                <?php
                    if (isset($_GET['topic_id'])) {
                        $topic_id = $_GET['topic_id'];

                        // Obtener el nombre del tema según el topic_id
                        $sql = "SELECT * FROM topics WHERE topic_id = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("i", $topic_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $topic = $result->fetch_assoc();
                            $topic_name = $topic['topic_name'];

                            // Mostrar los detalles del tema
                            echo "<b>" . htmlspecialchars($topic_name) . "</b>";
                            echo "<p>" . htmlspecialchars($topic['topic_desc']) . "</p>";
                            echo "<hr>";
                        } else {
                            echo "Tema no encontrado.";
                        }
                    } else {
                        echo "No se ha especificado un tema.";
                    }
                ?>
            </div>
            <?php
date_default_timezone_set('America/Mexico_City'); // Establecer la zona horaria a la de México

// Obtener las publicaciones relacionadas con el tema
$sql = "SELECT post.*, user.user_name AS user_name, topics.topic_id 
        FROM post
        INNER JOIN user ON post.user_id = user.user_id
        INNER JOIN topics ON post.post_tema = topics.topic_name
        WHERE post.post_tema = ? AND post.estado = 'revisado'";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $topic_name);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    // Imprimir los datos de cada publicación
    while ($row = $res->fetch_assoc()) {
        ?>
        <div class="pubs__row">
            <div class="pubs__header">
                <?php echo htmlspecialchars($row["user_name"]) . " - " . $row["post_creacion"]; ?>
                <div id="theme-section"> 
                    <a href="view_topic.php?topic_id=<?php echo $row['topic_id']; ?>">
                        <?php echo $row["post_tema"]; ?>
                    </a>
                </div>
            </div>
            <div class="pubs__title">
                <b><?php echo htmlspecialchars($row["post_titulo"]); ?></b>
            </div>
            <div class="pubs__text">
                <?php echo nl2br(htmlspecialchars($row["post_contenido"])); ?>
            </div>
            <div class="pubs__image">
                <?php if (!empty($row["post_image"])): ?>
                    <img src="data:image/jpg/png/jpeg;base64,<?php echo base64_encode($row['post_image']); ?>"/>
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
} else {
    echo "No hay publicaciones.";
}
?>

        </div>
        <div class="fav__container"> <?php
        if (isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];

                            $sql = "SELECT * FROM follows WHERE user_id = ? AND topic_id = ?";
                            $stmt = $con->prepare($sql);
                            $stmt->bind_param("ii", $user_id, $topic_id);
                            $stmt->execute();
                            $follow_result = $stmt->get_result();

                            $is_following = $follow_result->num_rows > 0;

                            // Botón de seguir/dejar de seguir
                            echo '<div class="other-section">';
                            echo '<form id="follow-form" action="add_favorite.php" method="post">';
                            echo '<input type="hidden" name="topic_id" value="' . $topic_id . '">';
                            echo '<button type="button" class="fav__button">' . ($is_following ? '<i class="bi bi-dash-lg"></i> Dejar de seguir' : '<i class="bi bi-plus-lg"></i> Seguir') . '</button>';
                            echo '</form>';
                            echo '</div>';

                            $stmt->close();
                        }
                        ?>
            <div class="fav__title">
                <p>FAVORITOS</p>
            </div>
            <div class="fav__content">
            <?php
                if (isset($_SESSION['user_id'])) {
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
                }
            ?>
            </div>
        </div>
    </div>

<script>
    document.querySelector('.fav__button').addEventListener('click', function() {
    var form = this.closest('form');
    var topicId = form.querySelector('input[name="topic_id"]').value;
    var action = this.innerText.includes('Seguir') ? 'follow' : 'unfollow';
    var button = this;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            location.reload(); // Recargar la página completa
        }
    };
    xhr.send('action=' + action + '&topic_id=' + topicId);
});
</script>

</body>
</html>