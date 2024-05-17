<?php
require "../conection.php";

// Verificar si se ha enviado un estado a través de la solicitud POST
if (isset($_POST['status'])) {
    $status = $_POST['status'];

    // Consulta SQL para seleccionar los usuarios según el estado especificado
    $sql = "SELECT user_name, user_id, user_email, user_rol
            FROM user
            WHERE user_rol = '$status'";
    $result = mysqli_query($con, $sql);

    // Verificar si se encontraron resultados
    if (mysqli_num_rows($result) > 0) {
        // Mostrar los usuarios
        while ($row = mysqli_fetch_assoc($result)) {
            // Agregar la información que deseas mostrar
            echo "<div class='user'>";
            echo "<div class='header-text'>";
            echo $row["user_name"];
            echo "<div id='button-theme'>" . $row["user_rol"] . "</div>";
            echo "</div>";
            echo "<p class='text'>" . $row["user_email"] . "</p>";

            // Mostrar botón para activar o inactivar según el estado
            if ($row["user_rol"] === "inactivo") {
                echo "<div class='botones'>";
                echo "<form action='user_active.php' method='post'>";
                echo "<input type='hidden' name='user_id' value='" . $row["user_id"] . "'>";
                echo "<button type='submit'>Activar usuario</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "<div class='botones'>";
                echo "<form action='user_inactive.php' method='post'>";
                echo "<input type='hidden' name='user_id' value='" . $row["user_id"] . "'>";
                echo "<button type='submit'>Inactivar usuario</button>";
                echo "</form>";
                echo "</div>";
            }

            echo "</div>";
        }
    } else {
        echo "<div class='no_usuarios'>No se han encontrado usuarios para mostrar con el estado '$status'.</div>";
    }
} else {
    // Cargar usuarios registrados por defecto
    $status = 'usuario_registrado';
    $sql = "SELECT user_name, user_id, user_email, user_rol
            FROM user
            WHERE user_rol = '$status'";
    $result = mysqli_query($con, $sql);

    // Verificar si se encontraron resultados
    if (mysqli_num_rows($result) > 0) {
        // Mostrar los usuarios registrados
        while ($row = mysqli_fetch_assoc($result)) {
            // Agregar la información que deseas mostrar
            echo "<div class='user'>";
            echo "<div class='header-text'>";
            echo $row["user_name"];
            echo "<div id='button-theme'>" . $row["user_rol"] . "</div>";
            echo "</div>";
            echo "<p class='text'>" . $row["user_email"] . "</p>";

            echo "<div class='botones'>";
            echo "<form action='user_inactive.php' method='post'>";
            echo "<input type='hidden' name='user_id' value='" . $row["user_id"] . "'>";
            echo "<button type='submit'>Inactivar usuario</button>";
            echo "</form>";
            echo "</div>";

            echo "</div>";
        }
    } else {
        echo "<div class='no_usuarios'>No se han encontrado usuarios registrados para mostrar.</div>";
    }
}

// Cerrar la conexión
mysqli_close($con);
?>