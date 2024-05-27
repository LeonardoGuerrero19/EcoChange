
function toggleClearButton() {
    var input = document.getElementById('search-input');
    var clearButton = document.getElementById('clear-btn');
    
    // Mostrar u ocultar el botón de limpiar según si hay texto en el campo de búsqueda
    if (input.value.length > 0) {
        clearButton.style.display = 'block';
    } else {
        clearButton.style.display = 'none';
    }
}

function clearSearch() {
    var input = document.getElementById('search-input');

    // Limpiar el campo de búsqueda y ocultar el botón de limpiar
    input.value = '';
    document.getElementById('clear-btn').style.display = 'none';
}

// open and close forms
const open__form = document.querySelector("#open__form"),
        close__form = document.querySelector("#close__form"),
        modal = document.querySelector("#modal"),
        fileImage = document.getElementById("fileImage"),
        fileVideo = document.getElementById("fileVideo");

open__form.addEventListener("click", () => {
    modal.showModal();
});

close__form.addEventListener("click", () => {
    modal.close();
    // Limpiar los campos del formulario
    document.querySelector('input[name="title-post"]').value = ""; // Limpiar el campo de título
    document.querySelector('textarea[name="text-post"]').value = ""; // Limpiar el campo de texto
    document.querySelector('select[name="topic-post"]').value = "Temas";
});

// Observar los cambios en la selección de archivos para las imágenes
fileImage.addEventListener("change", () => {
    // Verificar si se seleccionó un archivo de imagen
    if (fileImage.files && fileImage.files.length > 0) {
        modal.showModal(); // Mostrar el diálogo modal
    }
});

// Observar los cambios en la selección de archivos para los videos
fileVideo.addEventListener("change", () => {
    // Verificar si se seleccionó un archivo de video
    if (fileVideo.files && fileVideo.files.length > 0) {
        modal.showModal(); // Mostrar el diálogo modal
    }
})

// show image and video
let uploadButtonImage = document.getElementById("fileImage"),
    uploadButtonVideo = document.getElementById("fileVideo"),
    chosenImage = document.getElementById("chosen-image"),
    chosenVideo = document.getElementById("chosen-video");

uploadButtonImage.onchange = () => {
    let reader = new FileReader();
    reader.readAsDataURL(uploadButtonImage.files[0]);
    reader.onload = () => {
        chosenImage.setAttribute("src", reader.result);
        chosenImage.style.display = "block"; // Mostrar la imagen
    }
}

uploadButtonVideo.onchange = () => {
    let reader = new FileReader();
    reader.readAsDataURL(uploadButtonVideo.files[0]);
    reader.onload = () => {
        chosenVideo.setAttribute("src", reader.result);
        chosenVideo.style.display = "block"; // Mostrar el video
    }
}

document.getElementById("remove-media").addEventListener("click", () => {
    // Restablecer la imagen o el video
    chosenImage.setAttribute("src", "");
    chosenVideo.setAttribute("src", "");
    // Restablecer el campo de entrada de archivo
    uploadButtonImage.value = null;
    uploadButtonVideo.value = null;
})

// Obtener referencia al botón de eliminar
const removeMediaButton = document.getElementById("remove-media");

// Evento de clic para el botón de eliminar
removeMediaButton.addEventListener("click", () => {
    // Ocultar el botón de eliminar
    removeMediaButton.style.display = "none";

    // Ocultar la imagen y el video
    chosenImage.style.display = "none";
    chosenVideo.style.display = "none";

    // Restablecer el valor del campo de entrada de imagen y video
    uploadButtonImage.value = "";
    uploadButtonVideo.value = "";
});

// Evento change para el campo de entrada de imagen
uploadButtonImage.addEventListener("change", () => {
    if (uploadButtonImage.files.length > 0) {
        chosenImage.style.display = "block"; // Mostrar la imagen
        chosenVideo.style.display = "none"; // Ocultar el video
        document.getElementById("remove-media").style.display = "block"; // Mostrar el botón de eliminar
    } else {
        chosenImage.style.display = "none"; // Ocultar la imagen
    }
});

// Evento change para el campo de entrada de video
uploadButtonVideo.addEventListener("change", () => {
    if (uploadButtonVideo.files.length > 0) {
        chosenVideo.style.display = "block"; // Mostrar el video
        chosenImage.style.display = "none"; // Ocultar la imagen
        document.getElementById("remove-media").style.display = "block"; // Mostrar el botón de eliminar
    } else {
        chosenVideo.style.display = "none"; // Ocultar el video
    }
});

var openModalButtons = document.querySelectorAll('.openModalButton');
    // Iterar sobre cada botón y añadir el evento de click
    openModalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var postId = this.getAttribute('data-postid');
            var modal = document.getElementById('myModal-' + postId);
            modal.style.display = 'block';
        });
    });

    // Obtener todos los elementos que cierran los modales
    var closeButtons = document.querySelectorAll('.close');
    // Iterar sobre cada botón y añadir el evento de click
    closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var postId = this.getAttribute('data-postid');
            var modal = document.getElementById('myModal-' + postId);
            modal.style.display = 'none';
        });
    });

    // Cerrar el modal cuando el usuario haga clic fuera de la ventana modal
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    });
