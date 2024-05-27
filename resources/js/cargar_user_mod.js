// Define loadUsers como una función global
window.loadUsers = function(role) {
    // Realiza una solicitud AJAX al servidor para obtener los usuarios según el rol
    $.ajax({
        url: 'cargar_user_mod.php',
        method: 'POST',
        data: { rol: role },
        success: function(response) {
            // Actualiza el contenedor de usuarios con el contenido devuelto por el servidor
            $('.user-container').html(response);

            // Asignar manejadores de eventos para los nuevos botones
            assignFormHandlers(role);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

$(document).ready(function() {
    // Maneja el clic en el botón para mostrar usuarios registrados
    $('#showRegistered').click(function() {
        loadUsers('usuario_registrado');
    });

    // Maneja el clic en el botón para mostrar usuarios inactivos
    $('#showModerador').click(function() {
        loadUsers('moderador');
    });

    // Define assignFormHandlers como una función global
    window.assignFormHandlers = function(role) {
        // Manejar los clics en los botones para quitar y agregar moderadores
        $('.botones button').off('click').on('click', function(event) {
            event.preventDefault(); // Evitar el envío del formulario de la manera tradicional

            var userId = $(this).closest('form').find('input[name="user_id"]').val();
            var actionUrl = $(this).closest('form').attr('action');

            if ($(this).hasClass('agregar-moderador-btn')) {
                confirmAddModerator(userId);
            } else if ($(this).hasClass('quitar-moderador-btn')) {
                confirmRemoveModerator(userId);
            }
        });
    }


    // Cargar usuarios registrados al inicio
    loadUsers('moderador');
});
