<?php
session_start();
require 'conection.php'; // Asegúrate de que este archivo establece la conexión a tu base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $new_user_name = htmlspecialchars(trim($_POST['user_name']));

    if (!empty($new_user_name)) {
        $sql = "UPDATE user SET user_name = ? WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $new_user_name, $user_id);

        if ($stmt->execute()) {
            // Actualiza el nombre de usuario en la sesión
            $_SESSION['user_name'] = $new_user_name;
            header("Location: panel.php"); // Redirige a la página del perfil
            exit();
        } else {
            echo "Error al actualizar el nombre de usuario.";
        }
        $stmt->close();
    }
}
$con->close();
?>
