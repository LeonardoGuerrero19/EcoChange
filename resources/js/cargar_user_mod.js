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
    $('#showRegistered').click(function() {
        loadUsersWithSearch('usuario_registrado', $('#searchTerm').val());
        $('#showRegistered').addClass('active');
        $('#showModerador').removeClass('active');
    });

    $('#showModerador').click(function() {
        loadUsersWithSearch('moderador', $('#searchTerm').val());
        $('#showModerador').addClass('active');
        $('#showRegistered').removeClass('active');
    });

    $('#searchButton').click(function() {
        var searchTerm = $('#searchTerm').val();
        var currentRole = $('#showRegistered').hasClass('active') ? 'usuario_registrado' : 'moderador';
        loadUsersWithSearch(currentRole, searchTerm);
    });

    window.assignFormHandlers = function(role) {
        $('.botones button').off('click').on('click', function(event) {
            event.preventDefault();
            var userId = $(this).closest('form').find('input[name="user_id"]').val();
            var actionUrl = $(this).closest('form').attr('action');

            if ($(this).hasClass('agregar-moderador-btn')) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡¿Deseas agregar a este usuario como un nuevo moderador?!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, agregar moderador',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: actionUrl,
                            method: 'POST',
                            data: { user_id: userId },
                            success: function(response) {
                                if (response.includes('success')) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Usuario agregado como moderador exitosamente',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    loadUsersWithSearch('usuario_registrado', $('#searchTerm').val());
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al agregar moderador',
                                        text: response
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un problema al procesar su solicitud'
                                });
                            }
                        });
                    }
                });
            } else if ($(this).hasClass('quitar-moderador-btn')) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esto removera el rol de moderador del usuario!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, quitar moderador',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: actionUrl,
                            method: 'POST',
                            data: { user_id: userId },
                            success: function(response) {
                                if (response.includes('success')) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Moderador eliminado exitosamente',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    loadUsersWithSearch('moderador', $('#searchTerm').val());
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al quitar moderador',
                                        text: response
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un problema al procesar su solicitud'
                                });
                            }
                        });
                    }
                });
            }
        });
    }

    loadUsersWithSearch('moderador', '');
});
