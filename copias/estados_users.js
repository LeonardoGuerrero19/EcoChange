$(document).ready(function() {
    // Maneja el clic en el botón para mostrar usuarios inactivos
    $('#showInactiveUsers').click(function() {
        loadUsers('inactivo');
    });

    // Maneja el clic en el botón para mostrar usuarios activos
    $('#showActiveUsers').click(function() {
        loadUsers('usuario_registrado');
    });

    // Cargar usuarios activos por defecto al cargar la página
    loadUsers('usuario_registrado');
});

function loadUsers(status) {
    // Realiza una solicitud AJAX al servidor para obtener los usuarios según el estado
    $.ajax({
        url: 'load_users.php',
        method: 'POST',
        data: { status: status },
        beforeSend: function() {
            // Mostrar un indicador de carga antes de enviar la solicitud
            $('.users-container').html('<div class="loading">Cargando usuarios...</div>');
        },
        success: function(response) {
            // Actualiza el contenedor de usuarios con el contenido devuelto por el servidor
            $('.users-container').html(response);
        },
        error: function(xhr, status, error) {
            // Manejo de errores en caso de que la solicitud AJAX falle
            console.error('Error al cargar usuarios:', error);

            // Mostrar un mensaje de error en el contenedor de usuarios
            $('.users-container').html('<div class="error">Ha ocurrido un error al cargar los usuarios. Por favor, inténtalo nuevamente más tarde.</div>');
        },
        complete: function() {
            // Eliminar el indicador de carga después de completar la solicitud
            $('.loading').remove();
        }
    });
}