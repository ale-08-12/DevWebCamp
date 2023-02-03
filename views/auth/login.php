<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Inicia sesión en DevWebcamp</p>

    <?php
        include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <form class="formulario" method="POST" action="/login">
        <div class="formulario__campo">
            <label class="formulario__label" for="email">Email</label>
            <input class="formulario__input" type="email" placeholder="Tu Email" id="email" name="email">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="password">Password</label>
            <input class="formulario__input" type="password" placeholder="Tu Password" id="password" name="password">
        </div>

        <input class="formulario__submit" type="submit" value="Iniciar Sesión">
    </form>

    <div class="acciones">
        <a class="acciones__enlace" href="/registro">¿Aún no tienes cuenta? Obtener una</a>
        <a class="acciones__enlace" href="/olvide">¿Olvidaste tu Password?</a>
    </div>
</main>