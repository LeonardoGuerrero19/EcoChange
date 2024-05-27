<?php
date_default_timezone_set('America/Mexico_City'); // Establecer la zona horaria a la de México
session_start();
require "conection.php";

if (isset($_POST['create'])) {
    $title = $_POST["title-post"];
    $text = $_POST["text-post"];
    $topic = $_POST["topic-post"];

    // Verificar si el usuario está iniciado sesión y obtener su ID
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Verificar si se ha subido un archivo de imagen
        if(isset($_FILES["image-post"]) && $_FILES["image-post"]["error"] == 0) {
            $image = addslashes(file_get_contents($_FILES["image-post"]["tmp_name"]));
        } else {
            $image = '';
        }

        // Verificar si se ha subido un archivo de video
        if(isset($_FILES["video-post"]) && $_FILES["video-post"]["error"] == 0) {
            $video = addslashes(file_get_contents($_FILES["video-post"]["tmp_name"]));
        } else {
            $video = '';
        }

        // Obtener la fecha y hora actual
        $post_creacion = date('Y-m-d H:i:s'); // Formato: Año-Mes-Día Hora:Minuto:Segundo

        // Preparar el INSERT SQL statement con el campo post_creacion
        $sql = "INSERT INTO post (user_id, post_titulo, post_contenido, post_tema, post_image, post_video, estado, post_creacion) 
                VALUES ('$user_id', '$title', '$text', '$topic', '$image', '$video', 'pendiente', '$post_creacion')";

        // Ejecutar la consulta SQL
        if (mysqli_query($con, $sql)) {
            // Publicación guardada exitosamente
            echo "<script> window.alert('¡publicacion guardada!'); window.location='profile-user.php'</script>";
        } else {
            // Error al guardar la publicación
            echo "Error al crear la publicación: " . mysqli_error($con);
        }
    }
}
?>

