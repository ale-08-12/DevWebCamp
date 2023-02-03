<main class="agenda">
    <h2 class="agenda__heading"><?php echo $titulo; ?></h2>
    <p class="agenda__descripcion">Talleres y Conferencias dictados por expertos en Desarrollo Web</p>

    <div class="eventos">
        <h3 class="eventos__heading">&lt;Conferencias /></h3>
        <p class="eventos__fecha">Viernes 5 de Octubre</p>

        <?php if(!empty($eventos["conferencias_v"])){ ?>
            <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach($eventos["conferencias_v"] as $evento){ ?>
                        <?php include __DIR__ . "../../templates/evento.php"; ?>
                    <?php } ?>
                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        <?php } else { ?>
            <p class="eventos__no-hay">No hay aún Conferencias.</p>
        <?php } ?>

        <p class="eventos__fecha">Sábado 6 de Octubre</p>

        <?php if(!empty($eventos["conferencias_s"])){ ?>
            <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach($eventos["conferencias_s"] as $evento){ ?>
                        <?php include __DIR__ . "../../templates/evento.php"; ?>
                    <?php } ?>
                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>                
            </div>
        <?php } else { ?>
            <p class="eventos__no-hay">No hay aún Conferencias.</p>
        <?php } ?>
    </div>

    <div class="eventos eventos--workshops">
        <h3 class="eventos__heading">&lt;Workshops /></h3>
        <p class="eventos__fecha">Viernes 5 de Octubre</p>

        <?php if(!empty($eventos["workshops_v"])){ ?>
            <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach($eventos["workshops_v"] as $evento){ ?>
                        <?php include __DIR__ . "../../templates/evento.php"; ?>
                    <?php } ?>
                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>                
            </div>
        <?php } else { ?>
            <p class="eventos__no-hay">No hay aún Workshops.</p>
        <?php } ?>

        <p class="eventos__fecha">Sábado 6 de Octubre</p>

        <?php if(!empty($eventos["workshops_s"])){ ?>
            <div class="eventos__listado slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach($eventos["workshops_s"] as $evento){ ?>
                        <?php include __DIR__ . "../../templates/evento.php"; ?>
                    <?php } ?>
                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>                
            </div>
        <?php } else { ?>
            <p class="eventos__no-hay">No hay aún Workshops.</p>
        <?php } ?>
    </div>
</main>