<?php foreach ($nextEvents as $e) : ?>
    <div class="col-md-6 next" style="margin-bottom: 30px">
        <a href="index.php?r=evento/view&id=<?= $e->idevento ?>">
            <div class="fundo_next_event">
                <div class="filtro_eventos" style="background: <?= $e->filtro ?>; "></div>
                <div id="img_eventos" style="height:300px">
                    <img class="img-responsive" src="../passafree_uploads/<?php echo $e->cartaz ?>" />
                </div>
                <div class="info_next_event">
                    <div class="col-md-12">
                        <div class="col-md-1">
                            <div class="diaevento"><?= $e->getDay(); ?></div>
                            <div class="mesevento"><?= $e->getMonth(); ?></div>
                        </div>
                        <div class="col-md-11">
                            <span class="tipoevento"><?php echo $e->getEventTypeLabel(); ?></span>
                            <h3><?php echo $e->nome; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php endforeach; ?>

