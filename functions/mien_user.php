
<link rel="stylesheet" href="resources/css/panel.css">
<div class="dest">
    <span>
        <?php if(isset($_SESSION['user_id'])): ?>
            <button class="seguir-Btn">
                <a href="">+ Seguir</a>
            </button>
        <?php endif; ?>
    </span>
    <p>FAVORITOS</p>
    <div class="favoritos">
        <ul>
            <li><span class="circulo"></span><a href="?theme=Vida de ecosistemas">Vida de Ecosistemas</a> <span>1,000 miembros</span></li>
            <li><span class="circulo"></span><a href="?theme=Vida submarina">Vida Submarina</a> <span>1,000 miembros</span></li>
            <li><span class="circulo"></span><a href="?theme=Acción por el clima">Acción por el clima</a> <span>1,000 miembros</span></li>
        </ul>
        <a href="panel.php" class="ver-mas">Ver más</a>
    </div>
</div>
