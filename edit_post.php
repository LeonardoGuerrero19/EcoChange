<?php
session_start();
require "conection.php";

if (isset($_POST['edit'])) {
    $title = $_POST["title-post"];
    $text = $_POST["text-post"];
    $post_id = $_POST["post_id"];

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Procesar la imagen si se ha cargado una nueva
        if (isset($_FILES["image-post"]) && $_FILES["image-post"]["error"] == 0) {
            $image = addslashes(file_get_contents($_FILES["image-post"]["tmp_name"]));

            // Preparar la declaración SQL con el campo para la imagen
            $sql = "UPDATE post SET post_titulo = ?, post_contenido = ?, post_image = ? WHERE post_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sssi", $title, $text, $image, $post_id);
        } else {
            // Si no se carga una nueva imagen, no actualizar el campo de la imagen
            $sql = "UPDATE post SET post_titulo = ?, post_contenido = ? WHERE post_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssi", $title, $text, $post_id);
        }

        // Ejecutar la declaración
        if ($stmt->execute()) {
            echo "<script> window.alert('¡Cambios en la publicación guardados exitosamente!'); window.location='profile-user.php'</script>";
        } else {
            echo "Error al actualizar la publicación: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Usuario no autenticado.";
    }
}

$con->close();
?>