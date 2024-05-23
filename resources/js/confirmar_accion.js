function confirmRemoveModerator(userId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Estás a punto de quitar este usuario como moderador.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, quitar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar el formulario al servidor utilizando AJAX
            $.ajax({
                type: 'POST',
                url: 'quitar_mod.php',
                data: { user_id: userId },
                success: function(response) {
                    console.log(response);
                    // Recargar los usuarios sin recargar la página
                    loadUsers('moderador');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
    return false; // Evitar que el formulario se envíe tradicionalmente
}

function confirmAddModerator(userId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Estás a punto de agregar este usuario como moderador.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, agregar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar el formulario al servidor utilizando AJAX
            $.ajax({
                type: 'POST',
                url: 'agregar_mod.php',
                data: { user_id: userId },
                success: function(response) {
                    console.log(response);
                    // Recargar los usuarios sin recargar la página
                    loadUsers('usuario_registrado');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
    return false; // Evitar que el formulario se envíe tradicionalmente
}
