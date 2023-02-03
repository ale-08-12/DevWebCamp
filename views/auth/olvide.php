<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Recupera tu acceso a DevWebcamp</p>

    <?php
        include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <form class="formulario" method="POST" action="/olvide">
        <div class="formulario__campo">
            <label class="formulario__label" for="email">Email</label>
            <input class="formulario__input" type="email" placeholder="Tu Email" id="email" name="email">
        </div>

        <input class="formulario__submit" type="submit" value="Enviar Instrucciónes">
    </form>

    <div class="acciones">
        <a class="acciones__enlace" href="/login">¿Ya tienes cuenta? Inicia Sesión</a>
        <a class="acciones__enlace" href="/registro">¿Aún no tienes cuenta? Obtener una</a>
    </div>
</main>