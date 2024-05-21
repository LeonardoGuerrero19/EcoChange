<?php
require "../conection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['topic_id'])) {
    $topic_id = $_POST['topic_id'];
    
    // Eliminar el tema de la base de datos
    $sql = "DELETE FROM topics WHERE topic_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $topic_id);
    mysqli_stmt_execute($stmt);
    
    // Verificar si se eliminó correctamente
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Si se elimina correctamente, simplemente termina el script sin imprimir nada
        // No es necesario imprimir ninguna respuesta
    }
    
    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    // Si la solicitud es incorrecta, retorna un código de estado de error
    http_response_code(400);
}
?>
