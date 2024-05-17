<?php
// Incluir el archivo de conexión a la base de datos
require "../conection.php";

// Verificar si se ha enviado un rol a través de la solicitud POST
if(isset($_POST['rol'])) {
    $rol = $_POST['rol'];

    // Consulta SQL para seleccionar los usuarios según el rol especificado
    $sql = "SELECT * FROM user WHERE user_rol = '$rol'";
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
            
            // Botón para cambiar el rol de usuario
            echo "<div class='botones'>";
            echo "<form action='cambiar_rol.php' method='post'>";
            echo "<input type='hidden' name='user_id' value='" . $row["user_id"] . "'>";
            echo "<label for='nuevo_rol'>Nuevo Rol:</label>";
            echo "<select name='nuevo_rol'>";
            echo "<option value='visitante'>Visitante</option>";
            echo "<option value='usuario_registrado'>Usuario Registrado</option>";
            echo "<option value='moderador'>Moderador</option>";
            echo "<option value='administrador'>Administrador</option>";
            echo "<option value='inactivo'>Inactivo</option>";
            echo "</select>";
            echo "<button type='submit'>Cambiar Rol</button>";
            echo "</form>";
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
