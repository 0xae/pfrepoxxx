<div class="container-fluid" id='comentario'>

		<h4 style="margin: 0px; padding: 0px 50px;"><div class="borderlefttitlo"></div><span style="margin-left: 20px; font-size: 20px; color: #009447; font-weight: 700; font-family: 'DINBold'; text-transform: uppercase;">Comentários</span></h4>
    <div class="comentarios">
        <?php if( $comentario):?>
        <div id="carousel-id" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $in=0;?>
                <div class="item active">
                    <div class="box_coment">
                        <div class="row">
                            <?php for (;$in < count($comentario) && $in<2 ; $in++):?>
                            <div class="col-md-6">
                                <div class="coment text-center">
                                    <i class="avatar">
                                        <?php
                                        $foto=Yii::$app->mycomponent->getNomeUser($comentario[$in]->utilizador_idutilizador)['foto'];
                                        if($foto && strpos($foto, "uploads")!==false){?>
                                                <img src="../../../<?=Yii::$app->request->baseUrl.'/'.$foto ?>" class="img-responsive" alt="">
                                            <?php } else{ ?>
                                                <img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt="">
                                            <?php }?>
                                    </i><br>
                                    <small><?= Yii::$app->mycomponent->getNomeUser($comentario[$in]->utilizador_idutilizador)['nome'] ?></small>
                                </div>
                                <div class="coment_text">
                                   	<span class="commentblockquote">"</span>
                                    <p><?= $comentario[$in]->comentario ?></p>
                                    <div class="data_coment"><small><i class="fa fa-clock-o"></i>
										<?=date('d',strtotime($comentario[$in]->data))?> de
										<?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', strtotime($comentario[$in]->data)))?> de
										<?=date('Y',strtotime($comentario[$in]->data))?></small>
                               		</div>
                                </div>
                            </div>
                            <?php endfor;?>
                        </div>
                    </div>
                </div>
                    <?php for($i=$in;$i<count($comentario);$i++): ?>

                    <div class="item">
                        <div class="box_coment">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="coment text-center">
                                        <i class="avatar">
                                            <?php
                                                $foto=Yii::$app->mycomponent->getNomeUser($comentario[$i]->utilizador_idutilizador)['foto'];
                                            if($foto && strpos($foto, "uploads")!==false){?>
                                                <img src="../../../<?=Yii::$app->request->baseUrl.'/'.$foto ?>" class="img-responsive" alt="">
                                            <?php } else{ ?>
                                                <img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt="">
                                            <?php }?>
                                        </i><br>
                                        <small><?= Yii::$app->mycomponent->getNomeUser($comentario[$i]->utilizador_idutilizador)['nome'] ?></small>
                                    </div>
                                    <div class="coment_text">
                                       	<span class="commentblockquote">"</span>
                                        <p><?= $comentario[$i]->comentario ?></p>
                                        <div class="data_coment"><small><i class="fa fa-clock-o"></i>

                                                <?=date('d',strtotime($comentario[$i]->data))?> de
                                                <?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', strtotime($comentario[$i]->data)))?> de
                                                <?=date('Y',strtotime($comentario[$i]->data))?>
                                            </small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php endfor;?>
            </div>

            <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
        <?php endif;?>
               <?php if(!$comentario):?>
                    <div style="padding: 10px 12px; color: #fff; border-radius: 4px;">
                        <h4>Não existem Comentários!</h4>
                    </div>
                <?php endif;?>

    </div>

</div>

<?php /* ?>
    <div class="col-md-12"> 
          <!-- Carousel
        ================================================== -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class=""></li>
            <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="item active left">
              <div class="container">
                <div class="carousel-caption">
                  <h1>Título 1</h1>
                  <p>Sub Título 1</p>
                </div>
              </div>
            </div>
            <div class="item next left">
              <div class="container">
                <div class="carousel-caption">
                  <h1>Título 2</h1>
                  <p>Sub Título 2</p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="container">
                <div class="carousel-caption">
                  <h1>Título 3</h1>
                  <p>Sub Título 3</p>
                </div>
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div><!-- /.carousel -->
    </div>
<?php /**/ ?>




