$(document).ready(function() {
    // Maneja el clic en el botón para mostrar publicaciones pendientes
    $('#showPending').click(function() {
        loadPosts('pendiente');
    });

    // Maneja el clic en el botón para mostrar publicaciones revisadas
    $('#showReviewed').click(function() {
        loadPosts('revisado');
    });

    function loadPendingPosts(){
        loadPosts('pendiente');
    }

    loadPendingPosts();

});


function loadPosts(status) {
    // Realiza una solicitud AJAX al servidor para obtener las publicaciones según el estado
    $.ajax({
        url: 'load_posts.php',
        method: 'POST',
        data: { status: status },
        success: function(response) {
            // Actualiza el contenedor de publicaciones con el contenido devuelto por el servidor
            $('.post-container').html(response); // Cambiado '#postContainer' a '.post-container'
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
// Función para revertir el estado de una publicación a pendiente
function revertToPending(postId) {
    $.ajax({
        url: 'revertir_pendiente.php',
        method: 'POST',
        data: { post_id: postId },
        success: function(response) {
            if (response.success) {
                //Obtener el estado actual de los posts para cargarlos correctamente.
                var activeButton =$('.active-button').attr('id');
                var status =activeButton === 'showPending' ? 'pendiente' : 'revisado';

                //Funcion para cargar los pots según el estado del boton activo.
                loadPosts(status); // Aquí asumimos que quieres cargar los posts revisados nuevamente
            } else {
                // Si hubo un error, mostrar un mensaje de error
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
