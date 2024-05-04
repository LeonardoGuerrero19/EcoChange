<?php
// vote.php

session_start();

require "conection.php"; // Asegúrate de que este archivo contiene la conexión correcta

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'No has iniciado sesión.']);
    exit;
}

if (isset($_POST['post_id'], $_POST['action'])) {
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];
    $user_id = $_SESSION['user_id']; // Asumiendo que el ID del usuario está almacenado en la sesión

    // Validar acción
    if (!in_array($action, ['like', 'dislike', 'unvote'])) {
        echo json_encode(['status' => 'error', 'message' => 'Acción inválida.']);
        exit;
    }

    // Verificar si el usuario ya ha votado en esta publicación
    $checkVoteSql = "SELECT action FROM votes WHERE user_id = ? AND post_id = ?";
    $stmt = mysqli_prepare($con, $checkVoteSql);
    mysqli_stmt_bind_param($stmt, 'ii', $user_id, $post_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $existingVote = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($existingVote) {
        if ($action === $existingVote['action']) {
            // Eliminar voto existente si el usuario hace clic en el mismo botón nuevamente
            $removeVoteSql = "DELETE FROM votes WHERE user_id = ? AND post_id = ?";
            $stmt = mysqli_prepare($con, $removeVoteSql);
            mysqli_stmt_bind_param($stmt, 'ii', $user_id, $post_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
    
            // Actualizar contadores de likes y dislikes en la tabla post
            if ($action === 'like') {
                $updatePostSql = "UPDATE post SET likes_count = likes_count - 1 WHERE post_id = ?";
            } else {
                $updatePostSql = "UPDATE post SET dislikes_count = dislikes_count - 1 WHERE post_id = ?";
            }
            $stmt = mysqli_prepare($con, $updatePostSql);
            mysqli_stmt_bind_param($stmt, 'i', $post_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
    
            $likes = getLikeCount($post_id);
            $dislikes = getDislikeCount($post_id);
            echo json_encode(['status' => 'success', 'message' => 'Voto retirado.', 'likes' => $likes, 'dislikes' => $dislikes]);
        } else {
            // El usuario cambia su voto de like a dislike o viceversa
            $updateVoteSql = "UPDATE votes SET action = ? WHERE user_id = ? AND post_id = ?";
            $stmt = mysqli_prepare($con, $updateVoteSql);
            mysqli_stmt_bind_param($stmt, 'sii', $action, $user_id, $post_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Actualizar contadores de likes y dislikes en la tabla post
            if ($action === 'like') {
                $updatePostSql = "UPDATE post SET likes_count = likes_count + 1, dislikes_count = dislikes_count - 1 WHERE post_id = ?";
            } else {
                $updatePostSql = "UPDATE post SET likes_count = likes_count - 1, dislikes_count = dislikes_count + 1 WHERE post_id = ?";
            }
            $stmt = mysqli_prepare($con, $updatePostSql);
            mysqli_stmt_bind_param($stmt, 'i', $post_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $likes = getLikeCount($post_id);
            $dislikes = getDislikeCount($post_id);
            echo json_encode(['status' => 'success', 'message' => 'Voto actualizado.', 'likes' => $likes, 'dislikes' => $dislikes]);
        }
    } else {
        // El usuario no ha votado, insertar nuevo voto
        $insertVoteSql = "INSERT INTO votes (user_id, post_id, action) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $insertVoteSql);
        mysqli_stmt_bind_param($stmt, 'iis', $user_id, $post_id, $action);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Actualizar contadores de likes y dislikes en la tabla post
        if ($action === 'like') {
            $updatePostSql = "UPDATE post SET likes_count = likes_count + 1 WHERE post_id = ?";
        } else {
            $updatePostSql = "UPDATE post SET dislikes_count = dislikes_count + 1 WHERE post_id = ?";
        }
        $stmt = mysqli_prepare($con, $updatePostSql);
        mysqli_stmt_bind_param($stmt, 'i', $post_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $likes = getLikeCount($post_id);
        $dislikes = getDislikeCount($post_id);
        echo json_encode(['status' => 'success', 'message' => 'Voto registrado.', 'likes' => $likes, 'dislikes' => $dislikes]);
    }
}

mysqli_close($con);

function getLikeCount($post_id) {
    global $con;
    $sql = "SELECT likes_count FROM post WHERE post_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $post_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $row['likes_count'];
}

function getDislikeCount($post_id) {
    global $con;
    $sql = "SELECT dislikes_count FROM post WHERE post_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $post_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $row['dislikes_count'];
}
?>