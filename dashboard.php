<?php
    session_start();
    require "conection.php";
    require "functions/side_bar_mod.php";
    require "functions/header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- css -->
    <link rel="stylesheet" href="resources/css/panel_mod.css">
    <link rel="stylesheet" href="resources/css/all.css">
    <!-- js -->
    <script src="resources/js/bootstrap.bundle.min.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <!-- Tu barra de navegación aquí -->
        <nav class="navbar bg-body-tertiary">
        <?php echo Head(); ?>
    </nav>
    </nav>

    <div class="wrapper">
        <!-- Barra lateral -->
        <?php echo SidebarMod(); ?>
        
        <!-- Mostrar publicaciones -->
        <div class="main-content">
            <div class="post-container">
                <!--<button id="toggle-viewed">Mostrar solo vistas</button>-->
                <?php
                // Incluir el archivo de conexión a la base de datos
                require "conection.php";

                // Consulta SQL para seleccionar todas las publicaciones
                $sql = "SELECT * FROM post";
                $result = mysqli_query($con, $sql);

                // Verificar si se encontraron resultados
                if (mysqli_num_rows($result) > 0) {
                    // Mostrar las publicaciones
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Agregainformación que desees mostrar
                        echo "<div class='post'>";
                        echo "<h2>" . $row["post_titulo"] . "</h2>";
                        echo "<p>" . $row["post_contenido"] . "</p>";
                        if (!empty($row["imagen"])) {
                            echo "<img src='" . $row["imagen"] . "' alt='Imagen de la publicación'>"; #Mostrar imagen
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
                    echo "No se encontraron publicaciones.";
                }

                // Cerrar la conexión
                mysqli_close($con);
                ?>
            </div>
        </div>
    </div>

    <script src="resources/js/script.js"></script>
</body>
</html>