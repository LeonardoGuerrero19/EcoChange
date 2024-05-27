<?php
require "../conection.php";

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $topic_name = $_POST["topic_name"];
    $topic_desc = $_POST["topic_desc"];

    // Preparar la consulta SQL para insertar un nuevo tema
    $sql = "INSERT INTO topics (topic_name, topic_desc) VALUES ('$topic_name', '$topic_desc')";

    // Ejecutar la consulta y verificar si fue exitosa
    if (mysqli_query($con, $sql)) {
        // Redireccionar a la página de administración de temas
        header("Location: admin_temas.php");
        exit();
    } else {
        // Mostrar un mensaje de error si la inserción falla
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
} else {
    // Si se intenta acceder a este archivo directamente sin enviar datos del formulario, redirigir a la página principal
    header("Location: admin_temas.php");
    exit();
}
?>
