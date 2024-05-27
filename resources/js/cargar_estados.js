$(document).ready(function() {
    // Maneja el clic en el botón para mostrar publicaciones pendientes
    $('#showPending').click(function() {
        loadPosts('pendiente');
    });

    // Maneja el clic en el botón para mostrar publicaciones revisadas
    $('#showReviewed').click(function() {
        loadPosts('revisado');
    });

    // Maneja el clic en el botón para mostrar publicaciones inactivas
    $('#showInactive').click(function() {
        loadPosts('inactivo');
    });

    // Cargar publicaciones pendientes al inicio
    loadPosts('pendiente');
});

function loadPosts(status) {
    // Realiza una solicitud AJAX al servidor para obtener las publicaciones según el estado
    $.ajax({
        url: 'load_posts.php',
        method: 'POST',
        data: { status: status },
        success: function(response) {
            // Actualiza el contenedor de publicaciones con el contenido devuelto por el servidor
            $('.post-container').html(response);
            
            // Asigna manejadores de eventos a los formularios dentro de las publicaciones cargadas
            assignFormHandlers(status);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function assignFormHandlers(status) {
    // Asigna manejadores de eventos a los formularios dentro de las publicaciones cargadas
    $('.post-container form').off('submit').on('submit', function(event) {
        event.preventDefault(); // Evitar el envío del formulario de la manera tradicional

        var form = $(this);
        var actionUrl = form.attr('action');
        var formData = form.serialize();

        // Agrega el estado de la publicación al formulario
        formData += '&status=' + status;

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            success: function(response) {
                // Volver a cargar las publicaciones según el estado actual
                loadPosts(status);
            }
        });
    });
}
