<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Evento</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre Evento</label>

        <input class="formulario__input" type="text" id="nombre" name="nombre" placeholder="Nombre Evento" value="<?php echo $evento->nombre; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">Descripción</label>

        <textarea class="formulario__input" id="descripcion" name="descripcion" placeholder="Descripción Evento" rows="8"><?php echo $evento->descripcion; ?></textarea>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Categoria o Tipo de Evento</label>

        <select class="formulario__select" id="categoria" name="categoria_id">
            <option value="" selected disabled>- Seleccionar -</option>

            <?php foreach($categorias as $categoria){ ?>
                <option <?php echo ($evento->categoria_id == $categoria->id) ? "selected" : "" ?> value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Selecciona el día</label>
    
        <div class="formulario__radio">
            <?php foreach($dias as $dia){ ?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>

                    <input type="radio" id="<?php echo strtolower($dia->nombre); ?>" name="dia" value="<?php echo $dia->id; ?>" <?php echo ($evento->dia_id === $dia->id) ? 'checked' : ""; ?> >
                </div>
            <?php } ?>
        </div>
        
        <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="">Seleccionar Hora</label>

        <ul class="horas" id="horas">
            <?php foreach($horas as $hora){ ?>
                <li class="horas__hora horas__hora--deshabilitada" data-hora-id="<?php echo $hora->id; ?>"><?php echo $hora->hora; ?></li>
            <?php } ?>
        </ul>

        <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id; ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>
    
    <div class="formulario__campo">
        <label class="formulario__label" for="ponentes">Ponente</label>

        <input class="formulario__input" type="text" id="ponentes" placeholder="Buscar Ponente">

        <ul class="listado-ponentes" id="listado-ponentes"></ul>

        <input type="hidden" name="ponente_id" value="<?php echo $evento->ponente_id; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="disponibles">Lugares Disponibles</label>

        <input class="formulario__input" type="number" min="1" id="disponibles" name="disponibles" placeholder="Ej. 20" value="<?php echo $evento->disponibles; ?>">
    </div>
</fieldset>