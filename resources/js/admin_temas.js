// Obtener el botón y la ventana modal
var btnShowModal = document.getElementById('show-form-btn');
var modal = document.getElementById('add-topic-form-container');
var overlay = document.getElementById('overlay');

// Agregar evento clic al botón
btnShowModal.addEventListener('click', function() {
    // Mostrar la ventana modal y el fondo gris oscurecido
    modal.style.display = 'block';
    overlay.style.display = 'block';
});

// Agregar evento clic al fondo gris oscurecido para cerrar la ventana modal
overlay.addEventListener('click', function() {
    // Ocultar la ventana modal y el fondo gris oscurecido
    modal.style.display = 'none';
    overlay.style.display = 'none';
});
