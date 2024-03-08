<?php
    session_start();
    require "conection.php";

    if(isset($_SESSION['name'])) {
        header("Location: index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel general</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- style -->
    <link rel="stylesheet" href="resources/css/index.css">
    <link rel="stylesheet" href="resources/css/all.css">
</head>
<body>
    <header>
        <img src="resources/images/logo.png" alt="">
        <input type="search" placeholder="Buscar" id="buscador"/>
        <button class="loginBtn">Inicia Sesión</button>
    </header>

    <div class="sidebar">
        <div class="home">
            <a href="#"><i class='bx bx-home-alt-2'></i>Home</a>
        </div>
        <hr>
        <div class="dropdown" id="Dropdown">
            <button class="dropbtn" onclick="DropdownActive()">Temas
                <div class="arrow-box">
                    <i class='bx bx-chevron-down' id="down"></i>
                    <i class='bx bx-chevron-up' id="up"></i>
                </div>
            </button>
            <div class="dropdown-content">
                <div id="theme">
                    <i class='bx bxs-tree-alt icon'></i>
                    <div><a href="#">Vida de ecosistemas terrestres</a></div>
                </div>
                <div id="theme">
                    <i class='bx bx-water icon'></i>
                    <div><a href="#">Vida submarina</a></div>
                </div> 
                <div id="theme">
                    <i class='bx bx-world icon'></i>
                    <div><a href="#">Acción por el clima</a></div>
                </div> 
            </div>
        </div>
        
        <div id="Options">
            <button class="userBtn" onclick="OptionsActive()"><?php echo $_SESSION['name']; ?></button>
            <div class="options-content">
                <div class="opt">
                    <i class='bx bx-user'></i>
                    <div><a href="#">Ir a mi perfil</a></div>
                </div>
                <div class="opt">
                    <i class='bx bx-log-out'></i>
                    <div><a href="#">Cerrar Sesión</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="pub">
        <h1>e</h1>
    </div>

</body>
    <script>
        function DropdownActive() {
        var dropdown = document.getElementById("Dropdown");
        var b = document.getElementById("down");
        var c = document.getElementById("up");

        dropdown.classList.toggle("active");

        if (dropdown.classList.contains("active")) {
            b.style.opacity = "0";
            c.style.opacity = "1";
        } else {
            b.style.opacity = "1";
            c.style.opacity = "0";
        }
        }

        function OptionsActive() {
            var options = document.getElementById("Options");
            options.classList.toggle("active");
        }
    </script>
</html>


