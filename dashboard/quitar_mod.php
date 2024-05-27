<?php
// Verifica si se ha enviado el formulario y se ha recibido el post_id
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["user_id"])) {
    // Incluye el archivo de conexión a la base de datos
    require "../conection.php";

    // Sanitiza el valor del post_id para evitar inyección SQL
    $userId = mysqli_real_escape_string($con, $_POST["user_id"]);

    // Actualiza el estado del post en la base de datos de "pendiente" a "inactivo"
    $sql = "UPDATE user SET user_rol = 'usuario_registrado' WHERE user_id = $userId";
    if (mysqli_query($con, $sql)) {
        // Redirecciona de vuelta al dashboard
        header("Location: admin_mods.php");
        exit();
    } else {
        echo "Error al actualizar el estado del post: " . mysqli_error($con);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($con);
} else {
    // Si no se ha enviado el formulario correctamente, muestra un mensaje de error y redirecciona al dashboard
    echo "Error: No se pudo reactivar al usuario seleccionado.";
    // Redirecciona al dashboard después de unos segundos
    header("refresh:5;url=dashboard.php");
    exit();
}
?>