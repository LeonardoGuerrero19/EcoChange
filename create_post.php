<?php
session_start();
require "conection.php";

if (isset($_POST['create'])) {
    $title = $_POST["title-post"];
    $text = $_POST["text-post"];
    $topic = $_POST["topic-post"];

    // Obtener el ID de usuario de la sesión actual
    $user_id = $_SESSION['user_id'];

    // Verificar si se ha subido un archivo
    if(isset($_FILES["image-post"])) {
        $image = $_FILES["image-post"]["tmp_name"]; // Nombre temporal del archivo
    } else {
        $image = '';
    }
        
    if(isset($_FILES["video-post"])) {
        $video = $_FILES["video-post"]["tmp_name"]; // Nombre temporal del archivo
    } else {
        $video = '';
    }

    $sql = "INSERT INTO post (user_id, post_titulo, post_contenido, post_tema, post_image, post_video) VALUES ('$user_id', '$title', '$text', '$topic', '$image', '$video')";

    if (mysqli_query($con, $sql)) {
        // Publicación guardada exitosamente
        echo "<script> window.alert('¡publicacion guardada!'); window.location='profile-user.php'</script>";
    } else {
        // Error al guardar la publicación
        echo "Error al crear la publicación: " . mysqli_error($con);
    }
}
?>
