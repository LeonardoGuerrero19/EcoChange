<?php
session_start();
require "conection.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];

    try {
        if (isset($_POST['liked'])) {
            // Si se hace clic en el botón "Like"
            $stmt = $con->prepare("INSERT INTO likes (like_id, user_id, post_id) VALUES (1, ?, ?)");
            $stmt->bind_param("ii", $user_id, $post_id);
            $stmt->execute();
        } elseif (isset($_POST['disliked'])) {
            // Si se hace clic en el botón "Dislike"
            $stmt = $con->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
            $stmt->bind_param("ii", $user_id, $post_id);
            $stmt->execute();
        }

        // Redireccionar de vuelta a la página anterior o a donde corresponda
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } catch(Exception $e) {
        // En caso de error, imprimir un mensaje de error
        echo "Error al actualizar el like en la base de datos: " . $e->getMessage();
    }
}
?>
