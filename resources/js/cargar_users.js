$(document).ready(function() {
    // Maneja el clic en el botón para mostrar usuarios registrados
    $('#showRegistered').click(function() {
        loadUsers('usuario_registrado');
    });

    // Maneja el clic en el botón para mostrar usuarios inactivos
    $('#showInactive').click(function() {
        loadUsers('inactivo');
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

                // Asignar manejadores de eventos para los nuevos botones
                assignFormHandlers(role);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function assignFormHandlers(role) {
        $('form').off('submit').on('submit', function(event) {
            event.preventDefault(); // Evitar el envío del formulario de la manera tradicional

            var form = $(this);
            var actionUrl = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Mostrar mensaje de éxito o manejar la respuesta
                    console.log(response);

                    // Volver a cargar los usuarios según el rol actual
                    loadUsers(role);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    }

    // Cargar usuarios registrados al inicio
    loadUsers('usuario_registrado');
});
