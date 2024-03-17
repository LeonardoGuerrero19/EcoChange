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
                        echo "<div class='post'>";
                        echo "<h2>" . $row["post_titulo"] . "</h2>";
                        echo "<p>" . $row["post_contenido"] . "</p>";
                        if (!empty($row["imagen"])) {
                            echo "<img src='" . $row["imagen"] . "' alt='Imagen de la publicación'>"; #Mostrar imagen
                        }
                        // Agrega cualquier otra información que desees mostrar
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