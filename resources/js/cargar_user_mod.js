// Define una función para cargar los usuarios según el rol y término de búsqueda
window.loadUsersWithSearch = function(role, searchTerm) {
    $.ajax({
        url: 'cargar_user_mod.php',
        method: 'POST',
        data: { rol: role, search: searchTerm }, // Incluir el término de búsqueda en los datos enviados al servidor
        success: function(response) {
            $('.user-container').html(response);
            assignFormHandlers(role);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

$(document).ready(function() {
    // Manejar el clic en el botón para mostrar usuarios registrados
    $('#showRegistered').click(function() {
        loadUsersWithSearch('usuario_registrado', $('#searchTerm').val()); // Obtener el término de búsqueda del campo de entrada
        $('#showRegistered').addClass('active');
        $('#showModerador').removeClass('active');
    });

    // Manejar el clic en el botón para mostrar usuarios inactivos
    $('#showModerador').click(function() {
        loadUsersWithSearch('moderador', $('#searchTerm').val()); // Obtener el término de búsqueda del campo de entrada
        $('#showModerador').addClass('active');
        $('#showRegistered').removeClass('active');
    });

    // Manejar el clic en el botón de búsqueda
    $('#searchButton').click(function() {
        var searchTerm = $('#searchTerm').val();
        var currentRole = $('#showRegistered').hasClass('active') ? 'usuario_registrado' : 'moderador';
        loadUsersWithSearch(currentRole, searchTerm);
    });

    // Definir assignFormHandlers como una función global
    window.assignFormHandlers = function(role) {
        // Manejar los clics en los botones para quitar y agregar moderadores
        $('.botones button').off('click').on('click', function(event) {
            event.preventDefault();
            var userId = $(this).closest('form').find('input[name="user_id"]').val();
            var actionUrl = $(this).closest('form').attr('action');

            if ($(this).hasClass('agregar-moderador-btn')) {
                confirmAddModerator(userId);
            } else if ($(this).hasClass('quitar-moderador-btn')) {
                confirmRemoveModerator(userId);
            }
        });
    }

    // Cargar usuarios con rol de moderador al inicio (sin término de búsqueda)
    loadUsersWithSearch('moderador', '');
});
