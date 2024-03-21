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
