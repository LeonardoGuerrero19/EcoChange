<?php

session_start();
require "conection.php";

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Preparar la declaración SQL para eliminar la publicación
    $sql = "DELETE FROM post WHERE post_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $post_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script> window.alert('¡El dato se ha eliminado correctamente!'); window.location='profile-user.php'</script>";
    } else {
        echo "Error al eliminar el dato: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "No se ha proporcionado un ID de publicación válido.";
}

// Cerrar la conexión
$con->close();
?>