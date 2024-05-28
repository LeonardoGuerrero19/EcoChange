<?php
session_start();
include 'conection.php';

if (isset($_SESSION['user_id']) && isset($_POST['action']) && isset($_POST['topic_id'])) {
    $user_id = $_SESSION['user_id'];
    $topic_id = $_POST['topic_id'];
    $action = $_POST['action'];

    if ($action === 'follow') {
        // Comprobar si ya existe la relación en la tabla follows
        $sql = "SELECT * FROM follows WHERE user_id = ? AND topic_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $user_id, $topic_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Insertar la nueva relación en la tabla follows
            $sql = "INSERT INTO follows (user_id, topic_id) VALUES (?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ii", $user_id, $topic_id);
            $stmt->execute();
        }
    } elseif ($action === 'unfollow') {
        // Eliminar la relación de la tabla follows
        $sql = "DELETE FROM follows WHERE user_id = ? AND topic_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $user_id, $topic_id);
        $stmt->execute();
    }

    $stmt->close();
} else {
    echo "Datos incompletos.";
}

$con->close();
?>