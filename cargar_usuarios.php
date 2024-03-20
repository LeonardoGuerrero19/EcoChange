<?php
// Incluir el archivo de conexión a la base de datos
require "conection.php";

// Consulta SQL para seleccionar todos los usuarios activos
$sql = "SELECT user_name, user_email FROM user WHERE user_rol = 'usuario_registrado'";
$result = mysqli_query($con, $sql);

// Verificar si se encontraron resultados
if (mysqli_num_rows($result) > 0) {
    // Mostrar los usuarios
    while ($row = mysqli_fetch_assoc($result)) {
        // Agregar la información que deseas mostrar
        echo "<div class='usuario'>";
        echo "<p>Nombre: " . $row["user_name"] . "</p>";
        echo "<p>Correo: " . $row["user_email"] . "</p>";
        //echo "<img src='" . $row["user_profile_picture"] . "' alt='Foto de perfil'>"; // Mostrar foto de perfil
        echo "</div>";
    }
} else {
    echo "<div class='no_usuarios'> No se han encontrado usuarios activos para mostrar.</div>";
}

// Cerrar la conexión
mysqli_close($con);
?>
