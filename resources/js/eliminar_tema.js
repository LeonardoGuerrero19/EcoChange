function eliminarTema(topicId) {
    fetch('eliminar_tema.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'topic_id=' + encodeURIComponent(topicId),
    })
    .then(response => {
        if (response.ok) {
            // Mostrar la alerta después de la eliminación
            Swal.fire({
                icon: 'success',
                title: 'Tema eliminado',
                text: 'El tema ha sido eliminado correctamente',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Redireccionar a la página principal o realizar alguna otra acción
                window.location.href = 'admin_temas.php';
            });
        } else {
            throw new Error('Hubo un problema al eliminar el tema');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al eliminar el tema',
            showConfirmButton: false,
            timer: 1500
        });
    });
}
