<?php

?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- styles -->
    <link rel="stylesheet" href="resources/css/view_adm.css">
    <link rel="stylesheet" href="resources/css/all.css">
    <title>dashboard</title>
  </head>
  
  <body>
    <header> 
    </header>
    <nav class="menu">
        <img src="/resources/images/logo.png"  class="rounded mx-auto d-block" alt="Logo">
      
      <div class="perfil">
        <div class="foto">
          <img src="/resources/images/foto.png">
          <div class="user">
            <a>@usuario.33</a>
          </div>
        </div>
     
      <h2>EcoChange</h2>
     
      <a onclick="desplazarfiltro">
        PUBLICACIONES
      </a>
      
      <a href="#">
        USUARIOS REGISTRADOS
      </a>
      <a href="#">
        TEMAS DISPONIBLES
      </a>
    </nav>
    <section>
    <div class="apartado">
      <div class="filtros">
        <label for="filtro-estado">Filtrar por:</label>
        <select id="filtro-estado">
          <option value="publicadas">Publicadas (240)</option>
          <option value="pendientes">Pendientes (120)</option>
        </select>
        <select id="filtro-estado">
          <option value="publicadas">Publicadas (240)</option>
          <option value="pendientes">Pendientes (120)</option>
        </select>
      </div>
    </div>
    <div class="PublicacionesLeft">
      <div class="publicacion">
        <h2>Publicación 1</h2>
        <p>Contenido de la publicación 1.........................................................</p>
        <button class="pub">Ver</button>
      </div>
      <div class="publicacion">
        <h2>Publicación 2</h2>
        <p>Contenido de la publicación 2.........................................................</p>
        <button class="pub">Ver</button>
      </div>
      <div class="PublicacionesRight">
        <div class="publicacion">
          <h2>Publicación 3</h2>
          <p>Contenido de la publicación 3..........................................................</p>
          <button class="pub">Ver</button>
        </div>
        <div class="publicacion">
          <h2>Publicación 4</h2>
          <p>Contenido de la publicación 4.........................................................</p>
          <button class="pub">Ver</button>
        </div>
      </div>
 | </section>
  </body>
  <script>
  const filtroEstado = document.getElementById('filtro-estado');
  const contenedorFiltro = document.querySelector('.filtros');

  filtroEstado.addEventListener('change', () => {
  if (filtroEstado.value === 'publicadas') {
    contenedorFiltro.classList.remove('oculto');
  } else {
    contenedorFiltro.classList.add('oculto');
  }
  });
  </script>
</html>