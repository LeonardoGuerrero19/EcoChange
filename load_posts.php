<?php
// Incluir el archivo de conexión a la base de datos
require "conection.php";

// Verificar si se ha enviado un estado a través de la solicitud POST
if(isset($_POST['status'])) {
    $status = $_POST['status'];

    // Consulta SQL para seleccionar las publicaciones según el estado especificado
    $sql = "SELECT * FROM post WHERE estado = '$status'";
    $result = mysqli_query($con, $sql);

    // Verificar si se encontraron resultados
    if (mysqli_num_rows($result) > 0) {
        // Mostrar las publicaciones
        while ($row = mysqli_fetch_assoc($result)) {
            // Agregar la información que desees mostrar
            echo "<div class='post'>";
            echo "<h2>" . $row["post_titulo"] . "</h2>";
            echo "<p>" . $row["post_contenido"] . "</p>";
            if (!empty($row["imagen"])) {
                echo "<img src='" . $row["imagen"] . "' alt='Imagen de la publicación'>"; // Mostrar imagen
            }

            // Obtener el nombre del tema
            $topic_id = $row["topic_id"];
            $query_topic = "SELECT topic_name FROM topics WHERE topic_id = $topic_id";
            $result_topic = mysqli_query($con, $query_topic);
            if ($result_topic && mysqli_num_rows($result_topic) > 0) {
                $topic = mysqli_fetch_assoc($result_topic);
                $topic_name = $topic["topic_name"];
                echo "<p class='topic'>$topic_name</p>";
            } else {
                echo "<p>No se encontró el tema para esta publicación.</p>";
            }
            echo "<form action='marcar_revisado.php' method='post'>";
            echo "<input type='hidden' name='post_id' value='" . $row["post_id"] . "'>";
            echo "<button type='submit'>Aceptar Publicación</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "No se encontraron publicaciones con el estado '$status'.";
    }

    // Cerrar la conexión
    mysqli_close($con);
} else {
    // Si no se envió un estado, mostrar un mensaje de error
    echo "No se especificó un estado.";
}
?>
