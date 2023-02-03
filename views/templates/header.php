<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php if(is_auth()) { ?>
                <a class="header__enlace " href="<?php echo is_admin() ? "/admin/dashboard" : "/finalizar-registro"; ?>">Administrador</a>


                <form class="header__form" method="POST" action="/logout">
                    <input class="header__submit" type="submit" value="Cerrar Sesión">
                </form>
            <?php } else {?>
                <a class="header__enlace " href="/registro">Registro</a>
                <a class="header__enlace " href="/login">Iniciar Sesión</a>
            <?php } ?>    
        </nav>

        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">&#60;DevWebCamp/></h1>
            </a>

            <p class="header__texto">Octubre 5-6 - 2023</p>
            <p class="header__texto header__texto--modalidad">En Línea - Presencial</p>

            <a class="header__boton" href="/registro">Comprar Pase</a>
        </div>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
        <a href="/">
            <h2 class="barra__logo">&#60;DevWebCamp/></h2>
        </a>

        <nav class="navegacion">
            <a href="/devwebcamp" class="navegacion__enlace <?php echo pagina_actual('/devwebcamp') ? "navegacion__enlace--actual" : ""; ?>">Evento</a>
            <a href="/paquetes" class="navegacion__enlace <?php echo pagina_actual("/paquetes") ? "navegacion__enlace--actual" : ""; ?>">Paquetes</a>
            <a href="/workshops-conferencias" class="navegacion__enlace <?php echo pagina_actual("/workshops-conferencias") ? "navegacion__enlace--actual" : ""; ?>">Workshops / Conferencias</a>
            <a href="/registro" class="navegacion__enlace <?php echo pagina_actual("/registro") ? "navegacion__enlace--actual" : ""; ?>">Comprar Pase</a>
        </nav>
    </div>
</div>