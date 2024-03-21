<?php
require "conection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["post_id"])) {  // El script verifica si la petición HTTP es de tipo POST y si existe un parámetro POST llamado post_id. Esto indica que el script espera recibir un formulario enviado con un campo post_id definido.
    $postId = mysqli_real_escape_string($con, $_POST["post_id"]); // Sanitizar la consulta
    
    // Consulta para actualizar el estado a pendiente,
    $sql = "UPDATE post SET estado = 'pendiente' WHERE post_id = '$postId'";
    if (mysqli_query($con, $sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error al revertir a pendiente.";
    }

    mysqli_close($con);
} else {
    echo "No se especificó una publicación para revertir a pendiente.";
}
?>
