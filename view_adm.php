<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="view_adm.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  
  <body>
    <header> 
    </header>
    <nav class="menu">
        <img src="/resources/images/logo.png" alt="Logo">
      
      <div class="perfil">
        <div class="foto"> <i class="bi bi-person-circle"></i>
          <div class="user">
            <a>@usuario.33</a>
          </div>
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