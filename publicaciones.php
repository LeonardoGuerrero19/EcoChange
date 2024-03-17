<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Cambia esto si es necesario
$username = "root"; // Tu nombre de usuario de MySQL
$password = ""; // Tu contraseña de MySQL, si no tienes contraseña, déjala en blanco
$database = "foro"; // Nombre de la base de datos a la que quieres conectarte

// Crear conexión
$con = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}

// Procesar el formulario solo si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $imagen = $_FILES['imagen']['name'];
    $temp = $_FILES['imagen']['tmp_name'];
    $tema_id = $_POST['tema'];

    // Mover el archivo a una ubicación permanente
    $ruta_imagen = "resources/images/" . $imagen;
    move_uploaded_file($temp, $ruta_imagen);

    // Query para insertar la publicación en la base de datos
    $sql = "INSERT INTO post (user_id, post_titulo, post_contenido, imagen, post_creacion, post_ultima_edicion, tema_id) 
            VALUES ('$user_id', '$titulo', '$contenido', '$ruta_imagen', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$tema_id')";

    if ($con->query($sql) === TRUE) {
        echo "Publicación agregada correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Cerrar conexión
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Crear Publicación</title>
</head>
<body>
<h2>Crear Publicación</h2>
<form method="post" enctype="multipart/form-data">
    <label for="user_id">ID de usuario:</label><br>
    <input type="text" id="user_id" name="user_id" required><br><br>

    <label for="titulo">Título:</label><br>
    <input type="text" id="titulo" name="titulo" required><br><br>
    
    <label for="contenido">Contenido:</label><br>
    <textarea id="contenido" name="contenido" rows="4" cols="50" required></textarea><br><br>

    <label for="imagen">Seleccionar imagen:</label><br>
    <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>

    <label for="tema">Seleccionar tema:</label><br>
        <select id="tema" name="tema">
            <option value="1">Vida de ecosistemas</option>
            <option value="2">Vida submarina</option>
            <option value="3">Acción por el clima</option>
        </select><br><br>

    <input type="submit" value="Publicar">
</form>
</body>
</html>
