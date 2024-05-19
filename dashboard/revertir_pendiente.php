<?php
// Verifica si se ha enviado el formulario y se ha recibido el post_id
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["post_id"])) {
    // Incluye el archivo de conexión a la base de datos
    require "../conection.php";

    // Sanitiza el valor del post_id para evitar inyección SQL
    $postId = mysqli_real_escape_string($con, $_POST["post_id"]);

    // Actualiza el estado del post en la base de datos a 'pendiente'
    $sql = "UPDATE post SET estado = 'pendiente' WHERE post_id = '$postId'";
    if (mysqli_query($con, $sql)) {
        // Redirecciona de vuelta al dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error al actualizar el estado del post: " . mysqli_error($con);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($con);
} else {
    // Si no se ha enviado el formulario correctamente, muestra un mensaje de error
    echo "Error: No se pudo revertir la publicación a pendiente. Por favor, intenta de nuevo.";
    // Redirecciona al dashboard después de unos segundos
    header("refresh:5;url=dashboard.php");
    exit();
}
?>
