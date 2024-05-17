$(document).ready(function() {
    // Maneja el clic en el botón para mostrar usuarios registrados
    $('#showRegistered').click(function() {
        loadUsers('usuario_registrado');
    });

    // Maneja el clic en el botón para mostrar usuarios inactivos
    $('#showInactive').click(function() {
        loadUsers('inactivo');
    });

    function loadRegisteredUsers(){
        loadUsers('usuario_registrado');
    }

    loadRegisteredUsers();
});

function loadUsers(role) {
    // Realiza una solicitud AJAX al servidor para obtener los usuarios según el rol
    $.ajax({
        url: 'load_users.php',
        method: 'POST',
        data: { rol: role },
        success: function(response) {
            // Actualiza el contenedor de usuarios con el contenido devuelto por el servidor
            $('.user-container').html(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
