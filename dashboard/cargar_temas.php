<?php
require "../conection.php";

$sql = "SELECT topic_id, topic_name, topic_desc FROM topics";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='temas-container'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='tema'>";
        echo "<div class='header-text-tema'>";
        echo "<h3 class='text-center'>" . htmlspecialchars($row["topic_name"]) . "</h3>";
        echo "</div>";
        echo "<p class='text-center'>" . htmlspecialchars($row["topic_desc"]) . "</p>";
        // Agregar botón para eliminar tema
        echo "<button onclick='eliminarTema({$row["topic_id"]})' class='eliminar-tema-btn'>Eliminar</button>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<div class='no_tema'>No hay temas disponibles.</div>";
}
?>
