<?php
// Incluir el archivo de conexión a la base de datos
require "../conection.php";

// Consulta SQL para seleccionar los temas junto con sus descripciones
$sql = "SELECT topic_id, topic_name, topic_desc FROM topics";
$result = mysqli_query($con, $sql);

// Verificar si se encontraron resultados
if (mysqli_num_rows($result) > 0) {
    echo "<div class='temas-container'>"; // Añadir un contenedor principal
    // Mostrar los temas
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='tema'>"; // Añadir clase 'tema' para aplicar el estilo
        echo "<div class='header-text'>";
        echo "<h3 class='text-center'>" . htmlspecialchars($row["topic_name"]) . "</h3>"; // Nombre del tema centrado
        echo "</div>";
        echo "<p class='text-center'>" . htmlspecialchars($row["topic_desc"]) . "</p>"; // Descripción del tema centrada
        echo "</div>";
    }
    echo "</div>"; // Cerrar el contenedor principal
} else {
    echo "<div class='no_tema'>No hay temas disponibles.</div>";
}
?>
