<?php
session_start();
require "conection.php";

if (isset($_POST['create'])) {
    $title = $_POST["title-post"];
    $text = $_POST["text-post"];
    $topic = $_POST["topic-post"];

    // Verificar si el usuario está iniciado sesión y obtener su ID
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

    // Verificar si se ha subido un archivo
    if(isset($_FILES["image-post"]) && $_FILES["image-post"]["error"] == 0) {
        $image = addslashes(file_get_contents($_FILES["image-post"]["tmp_name"]));
    } else {
        $image = '';
    }

    $sql = "INSERT INTO post (user_id, post_titulo, post_contenido, post_tema, post_image) VALUES ('$user_id', '$title', '$text', '$topic', '$image')";

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
