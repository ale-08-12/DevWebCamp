<h2 class="pagina__heading"><?php echo $titulo; ?></h2>
<p class="pagina__descripcion">Elige hasta 5 eventos para asistir de forma presencial.</p>

<div class="eventos-registro">
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias /></h3>
        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php foreach($eventos["conferencias_v"] as $evento){ ?>
                <?php include __DIR__ . "/evento.php"; ?>
            <?php } ?>
        </div>

        <p class="eventos-registro__fecha">Sábado 6 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php foreach($eventos["conferencias_s"] as $evento){ ?>
                <?php include __DIR__ . "/evento.php"; ?>
            <?php } ?>
        </div>

        <h3 class="eventos-registro__heading--workshops">&lt;Workshops /></h3>
        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach($eventos["workshops_v"] as $evento){ ?>
                <?php include __DIR__ . "/evento.php"; ?>
            <?php } ?>
        </div>

        <p class="eventos-registro__fecha">Sábado 6 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach($eventos["workshops_s"] as $evento){ ?>
                <?php include __DIR__ . "/evento.php"; ?>
            <?php } ?>
        </div>
    </main>

    <aside class="registro registro-aside">
        <h2 class="registro__heading">Tu Registro</h2>

        <div id="registro-resumen" class="registro__resumen"></div>

        <div class="registro__regalo">
            <label class="registro__label" for="regalo">Selecciona un regalo</label>
            <select class="registro__select" id="regalo">
                <option value="" disabled selected>-- Seleciona tu regalo --</option>
                <?php foreach($regalos as $regalo){ ?>
                    <?php if(!str_contains(strtolower($regalo->nombre), "nada")){ ?><!-- Agregado el if para que no aparezca la opcion "nada" -->
                        <option value="<?php echo $regalo->id; ?>"><?php echo $regalo->nombre; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>

        <form class="formulario" id="registro" action="">
            <div class="formulario__campo">
                <input class="formulario__submit formulario__submit--full" type="submit" value="Registrarme">
            </div>
        </form>
    </aside>
</div>
    