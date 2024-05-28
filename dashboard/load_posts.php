<?php
// Incluir el archivo de conexión a la base de datos
require "../conection.php";

// Verificar si se ha enviado un estado a través de la solicitud POST
if(isset($_POST['status'])) {
    $status = $_POST['status'];

    // Consulta SQL para seleccionar las publicaciones según el estado especificado
    $sql = "SELECT post.*, user.user_name 
            FROM post 
            INNER JOIN user ON post.user_id = user.user_id 
            WHERE post.estado = '$status'";
    $result = mysqli_query($con, $sql);

    // Verificar si se encontraron resultados
    if (mysqli_num_rows($result) > 0) {
        // Mostrar las publicaciones
        while ($row = mysqli_fetch_assoc($result)) {
            // Agregar la información que desees mostrar
            echo "<div class='post'>";
            echo "<div class='header-text'>";
            echo $row["user_name"];
            echo "<div id='button-theme'>".  $row["post_tema"] . "</div>";
            echo "</div>";
            echo "<b class='text'>" . $row["post_titulo"] . "</b>";
            echo "<p class='text'>" . $row["post_contenido"] . "</p>";
            echo "<div class='image-pub'>";
            echo "<img src='data:image/jpg/png/jpeg;base64," . base64_encode($row['post_image']). "'/>";
            echo "</div>";

            // Botón para marcar post como revisada.
            if($row["estado"] === "pendiente"){
                echo "<div class='botones'>";
                echo "<form action='marcar_revisado.php' method='post'>";
                echo "<input type='hidden' name='post_id' value='" . $row["post_id"] . "'>";
                echo "<button type='submit'>Aceptar</button>";
                echo "</form>";

                echo "<form action='rechazar_posts.php' method='post'>";
                echo "<input type='hidden' name='post_id' value='" . $row["post_id"] . "'>";
                echo "<button type='submit'>Rechazar</button>";
                echo "</form>";
                echo "</div>";

            } else{
                // Botón para revertir a pendiente si el estado es revisado
                echo "<div class='botones'>";
                echo "<form action='revertir_pendiente.php' method='post'>";
                echo "<input type='hidden' name='post_id' value='" . $row["post_id"] . "'>";
                echo "<button type='submit'>Revertir a Pendiente</button>";
                echo "</form>";
                echo "</div>";
            }
            echo "</div>";
        }
    } else {
        echo "<div class='no_post'> No se han encontrado publicaciones para mostrar aquí =*) '$status'.</div>";
    }
} else {
    // Si no se envió un estado, mostrar un mensaje de error
    echo "No se especificó un estado.";
}
?>
