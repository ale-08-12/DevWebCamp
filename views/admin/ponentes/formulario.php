<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input class="formulario__input" type="text" id="nombre" name="nombre" placeholder="Nombre Ponente" value="<?php echo $ponente->nombre ?? ""; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input class="formulario__input" type="text" id="apellido" name="apellido" placeholder="Apellido Ponente" value="<?php echo $ponente->apellido ?? ""; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad</label>
        <input class="formulario__input" type="text" id="ciudad" name="ciudad" placeholder="Ciudad Ponente" value="<?php echo $ponente->ciudad ?? ""; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="pais">País</label>
        <input class="formulario__input" type="text" id="pais" name="pais" placeholder="País Ponente" value="<?php echo $ponente->pais ?? ""; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">Imagen</label>
        <input class="formulario__input formulario__input--file" type="file" id="imagen" name="imagen">
    </div>

    <?php if(isset($ponente->imagen_actual)){ ?>
        <p class="formulario__texto">Imagen Actual:</p>

        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV["HOST"] . "/img/speakers/" . $ponente->imagen_actual; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV["HOST"] . "/img/speakers/" . $ponente->imagen_actual; ?>.png" type="image/png">
                <img src="<?php echo $_ENV["HOST"] . "/img/speakers/" . $ponente->imagen_actual; ?>.png" alt="Imagen Ponente">
            </picture>   
        </div>
    <?php } ?>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="tags_input">Áreas de Experiencia (separadas por coma)</label>
        <input class="formulario__input" type="text" id="tags_input" placeholder="Ej. Node.js, PHP, CSS, Laravel, UX / UI">

        <div class="formulario__listado" id="tags"></div>

        <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? "";?>">
    </div>   
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>
    
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>

            <input class="formulario__input--sociales" type="text" name="redes[facebook]" placeholder="Facebook" value="<?php echo $redes->facebook ?? ""; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>

            <input class="formulario__input--sociales" type="text" name="redes[twitter]" placeholder="Twitter" value="<?php echo $redes->twitter ?? ""; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>

            <input class="formulario__input--sociales" type="text" name="redes[youtube]" placeholder="YouTube" value="<?php echo $redes->youtube ?? ""; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>

            <input class="formulario__input--sociales" type="text" name="redes[instagram]" placeholder="Instagram" value="<?php echo $redes->instagram ?? ""; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>

            <input class="formulario__input--sociales" type="text" name="redes[tiktok]" placeholder="Tiktok" value="<?php echo $redes->tiktok ?? ""; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>

            <input class="formulario__input--sociales" type="text" name="redes[github]" placeholder="GitHub" value="<?php echo $redes->github ?? ""; ?>">
        </div>
    </div>
</fieldset>