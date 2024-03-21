<?php
require "../conection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["post_id"])) {
    $postId = mysqli_real_escape_string($con, $_POST["post_id"]);

    $sql = "UPDATE post SET estado = 'pendiente' WHERE post_id = '$postId'";
    if (mysqli_query($con, $sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error al revertir a pendiente.";
    }

    mysqli_close($con);
} else {
    echo "No se especificó una publicación para revertir a pendiente.";
}
?>
