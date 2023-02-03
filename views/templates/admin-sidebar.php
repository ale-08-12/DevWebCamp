<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a class="dashboard__enlace <?php echo pagina_actual("/dashboard") ? "dashboard__enlace--actual" : ""; ?>" href="/admin/dashboard">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">Inicio</span> 
        </a>

        <a class="dashboard__enlace <?php echo pagina_actual("/ponentes") ? "dashboard__enlace--actual" : ""; ?>" href="/admin/ponentes">
            <i class="fa-solid fa-microphone dashboard__icono"></i>
            <span class="dashboard__menu-texto">Ponentes</span> 
        </a>

        <a class="dashboard__enlace <?php echo pagina_actual("/eventos") ? "dashboard__enlace--actual" : ""; ?>" href="/admin/eventos">
            <i class="fa-solid fa-calendar dashboard__icono"></i>
            <span class="dashboard__menu-texto">Eventos</span> 
        </a>

        <a class="dashboard__enlace <?php echo pagina_actual("/registrados") ? "dashboard__enlace--actual" : ""; ?>" href="/admin/registrados">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">Registrados</span> 
        </a>

        <a class="dashboard__enlace <?php echo pagina_actual("/regalos") ? "dashboard__enlace--actual" : ""; ?>" href="/admin/regalos">
            <i class="fa-solid fa-gift dashboard__icono"></i>
            <span class="dashboard__menu-texto">Regalos</span> 
        </a>
    </nav>
</aside>