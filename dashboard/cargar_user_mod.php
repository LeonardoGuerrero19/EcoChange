<?php
// Incluir el archivo de conexión a la base de datos
require "../conection.php";

// Verificar si se ha enviado un rol a través de la solicitud POST
if(isset($_POST['rol'])) {
    $rol = $_POST['rol'];

    // Consulta SQL para seleccionar los usuarios según el rol especificado y formatear la fecha de registro
    $sql = "SELECT user_id, user_name, user_email, user_rol, DATE_FORMAT(user_registration, '%Y-%m-%d %H:%i:%s') as user_registration 
            FROM user 
            WHERE user_rol = '$rol'";
    $result = mysqli_query($con, $sql);

    // Verificar si se encontraron resultados
    if (mysqli_num_rows($result) > 0) {
        // Mostrar los usuarios
        while ($row = mysqli_fetch_assoc($result)) {
            // Agregar la información que desees mostrar
            echo "<div class='user'>";
            echo "<div class='header-text'>";
            echo "Nombre de Usuario: " . $row["user_name"];
            echo "</div>";
            echo "<p class='text'>Correo Electrónico: " . $row["user_email"] . "</p>";
            echo "<p class='text'>Rol de Usuario: " . $row["user_rol"] . "</p>";
            echo "<p class='text'>Fecha de Registro: " . $row["user_registration"] . "</p>";

            // Botón para cambiar el estado del usuario
            echo "<div class='botones'>";
            if ($row["user_rol"] === "usuario_registrado") {
                echo "<form id='addModeratorForm_{$row["user_id"]}' action='agregar_mod.php' method='post'>";
                echo "<input type='hidden' name='user_id' value='{$row["user_id"]}'>";
                echo "<button type='button' onclick='confirmAddModerator({$row["user_id"]})'>Agregar como moderador</button>";
                echo "</form>";
            } else {
                echo "<form id='removeModeratorForm_{$row["user_id"]}' action='quitar_mod.php' method='post'>";
                echo "<input type='hidden' name='user_id' value='{$row["user_id"]}'>";
                echo "<button type='button' onclick='confirmRemoveModerator({$row["user_id"]})'>Quitar Moderador</button>";
                echo "</form>";
            }
            echo "</div>";

            echo "</div>";
        }
    } else {
        echo "<div class='no_user'>No se han encontrado usuarios con el rol '$rol'.</div>";
    }
} else {
    // Si no se envió un rol, mostrar un mensaje de error
    echo "No se especificó un rol.";
}
?>
