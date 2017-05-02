<?php $aniv = Yii::$app->mycomponent->Anversario($model->idevento)?>

<?php /*?>ANIVERSARIANTES<?php */?>
<div class="container-fluid" id='aniversarios'>
    <h4 style="margin: 0px; padding: 0px 50px;"><div class="borderlefttitlo"></div><span style="margin-left: 20px; font-size: 20px; color: #009447; font-weight: 700; font-family: 'DINBold'; text-transform: uppercase;">Aniversariantes</span></h4><br>
    <div class="aniversarios">
        <?php if( $aniv):?>
            <div id="carousel-id" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $in=0;?>
                <div class="item active">
                    <div class="box_coment">
                        <div class="row">
                            <?php for (;$in < count($aniv) && $in<2 ; $in++):?>
								<div class="col-md-4">
									<div class="coment">
										<i class="avatar">
											<?php
												$fotoAn=$aniv[$in]['foto'];
												if($fotoAn && strpos($fotoAn, "uploads")!==false){?>
													<img src="../../../<?=Yii::$app->request->baseUrl.'/'.$fotoAn ?>" class="img-responsive" alt="">
												<?php } else{ ?>
													<img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt="">
												<?php }?>
										</i>
										<div class="anivernomeano">
											<h2 style="color: #282c37; font-weight: 700; font-size: 15px;"><?= $aniv[$in]['nome']?> <?= $aniv[$in]['apelido']?></h2>
											<small><?=date('Y',strtotime('today'))-date('Y', strtotime($aniv [$in]['data_nascimento']))?> Anos</small>
										</div>
									</div>
								</div>
                            <?php endfor;?>
                        </div>
                    </div>
                </div>
				<?php for($i=$in;$i<count($aniv);$i++): ?>

				<div class="item">
					<div class="box_coment">
						<div class="row">
							<div class="col-md-4">
								<div class="coment">
									<i class="avatar">
									   <?php
											$fotoAn=$aniv[$i]['foto'];
										if($fotoAn && strpos($fotoAn, "uploads")!==false){?>
											<img src="../../../<?=Yii::$app->request->baseUrl.'/'.$fotoAn ?>" class="img-responsive" alt="">
										<?php } else{ ?>
											<img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt="">
										<?php }?>
									</i>
									<div class="anivernomeano">
										<h2 style="color: #282c37; font-weight: 700; font-size: 15px;"><?= $aniv[$in]['nome']?> <?= $aniv[$in]['apelido']?></h2>
										<small><?=date('Y',strtotime('today'))-date('Y', strtotime($aniv [$in]['data_nascimento']))?> Anos</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php ++$i; if($i<count($aniv)):?>
					<div class="col-md-4">
						<div class="coment text-center">
							<i class="avatar">
								<?php
									$fotoAn=$aniv[$i]['foto'];
								if($fotoAn && strpos($fotoAn, "uploads")!==false){?>
									<img src="../../../<?=Yii::$app->request->baseUrl.'/'.$fotoAn ?>" class="img-responsive" alt="">
								<?php } else{ ?>
									<img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt="">
								<?php }
								?>
							</i>
							<div class="anivernomeano ">
								<h2 style="color: #282c37; font-weight: 700; font-size: 15px;"><?= $aniv[$in]['nome']?> <?= $aniv[$in]['apelido']?></h2>
								<small><?=date('Y',strtotime('today'))-date('Y', strtotime($aniv [$in]['data_nascimento']))?> Anos</small>
							</div>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
	<div>
	<?php endfor;?>
		</div>

       <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
       <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
        <?php endif;?>
               <?php if(!$aniv):?>
                    <div style="padding: 40px 30px; border-radius: 4px;">
                        <h4>Não existem Aniversariantes !</h4>
                    </div>
                <?php endif;?>
                
                

