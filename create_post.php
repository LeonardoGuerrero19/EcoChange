<?php
    session_start();
    require "conection.php";

    if (isset($_POST['create'])) {
        $title = $_POST["title-post"];
        $text = $_POST["text-post"];

        // Obtener el ID de usuario de la sesión actual
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO post (user_id, post_titulo, post_contenido) VALUES ('$user_id', '$title', '$text')";

        if (mysqli_query($con, $sql)) {
            // Publicación guardada exitosamente
            echo "<script> window.alert('¡publicacion guardada!'); window.location='profile-user.php'</script>";
        } else {
            // Error al guardar la publicación
            echo "Error al crear la publicación: " . mysqli_error($con);
        }
    }
?>