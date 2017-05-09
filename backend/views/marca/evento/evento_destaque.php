<?php if (isset($destaque)): ?>
    <div class="col-md-12 proximo">
        <a href="index.php?r=evento/view&id=<?= $destaque->idevento; ?>">
            <div class="evento_proximo" style="margin:0">
                <div class="filtro"></div>
                <div id="event_cartaz" class="event_cartaz">
                    <img class="img-responsive" src="../passafree_uploads/<?= $destaque->cartaz?$destaque->cartaz:'evento/x22Ps-2U0zMCJvucY8GCY00uPocAtvon.jpg' ?>" />
                </div>
                <div class="info_cartaz">
                    <div class="row">
                        <div class="col-md-6 detalhes_geral">
                            <h1><?php echo $destaque->nome ?></h1>
                            <span>
                                <i class="fa fa-calendar"></i> 
                                <span> 
                                    <?php ?><?= date( 'd',strtotime($destaque->data) ) ?>
                                    <?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', strtotime($destaque->data) )) ?>
                                    de <?= date('Y', strtotime($destaque->data) ) ?>
                                </span>
                            </span>
                            <span>
                                <i class="fa fa-map-marker"></i>
                                <span><?= $destaque->local; ?>, <?= $destaque->ilha ?></span>
                            </span>
                            <div>
                                <button class="btn btn-default">
                                    <a href="index.php?r=evento/view&id=<?= $destaque->idevento; ?>">Ver Detalhes</a>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-3 text-center"><br><br>
                            <div class="fundo_circle">
                                <div class="c100 p50">
                                    <span>35% <br/> <span class="value">1500</span> </span>
                                    <div class="slice">
                                        <div class="bar"></div>
                                        <div class="fill"></div>
                                    </div>
                                </div>
                                <span>Entrada</span>
                            </div>
                        </div>

                        <div class="col-md-3 text-center"><br><br>
                            <div class="fundo_circle">
                                <div class="c100 p50">
                                    <span>75% <br/> <span class="value">30000</span> </span>
                                    <!--
                                    <span>75%</span>
                                    <span class="value">de 30000</span>
                                    -->
                                    <div class="slice">
                                        <div class="bar"></div>
                                        <div class="fill"></div>
                                    </div>
                                </div>
                                <span>Stock</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php endif; ?>
