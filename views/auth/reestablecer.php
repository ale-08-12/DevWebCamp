<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Coloca tu nuevo password</p>

    <?php
        include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <?php if($token_valido){ ?>
        <form class="formulario" method="POST">
            <div class="formulario__campo">
                <label class="formulario__label" for="password">Nuevo Password</label>
                <input class="formulario__input" type="password" placeholder="Tu Nuevo Password" id="password" name="password">
            </div>

            <input class="formulario__submit" type="submit" value="Guardar Password">
        </form>

        <div class="acciones">
            <a class="acciones__enlace" href="/registro">¿Aún no tienes cuenta? Obtener una</a>
            <a class="acciones__enlace" href="/olvide">¿Olvidaste tu Password?</a>
        </div>
    <?php } ?>
</main>