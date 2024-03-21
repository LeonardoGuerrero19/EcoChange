<?php
    session_start();

    // Cerrar la sesión
    session_unset();
    session_destroy();
    
    // Verificar si la sesión se cerró correctamente
    if(session_status() === PHP_SESSION_NONE) {
        // Redirigir al usuario a la página de inicio de sesión
        header("Location: panel.php");
        exit();
    } else {
        // Mostrar un mensaje de error o realizar alguna otra acción en caso de que la sesión no se cierre correctamente
        echo "Error al cerrar la sesión";
    }
    
    var_dump($_SESSION); // Imprime el contenido de $_SESSION para depurar

?>