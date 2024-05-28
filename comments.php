<?php
session_start();
require 'conection.php'; // Asegúrate de que este archivo establece la conexión a tu base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $comment_text = htmlspecialchars(trim($_POST['comment_text']));

    if (!empty($comment_text)) {
        $sql = "INSERT INTO comments (user_id, post_id, comment) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iis", $user_id, $post_id, $comment_text);

        if ($stmt->execute()) {
            header("Location: panel.php"); // Redirige a la página de la publicación comentada
            exit();
        } else {
            echo "Error al insertar el comentario.";
        }

        $stmt->close();
    } else {
        echo "El comentario no puede estar vacío.";
    }
}

$con->close();
?>
