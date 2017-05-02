<?php
use backend\models\Evento;
use yii\helpers\Url;
use backend\models\Tipoevento;

$this->title = 'Histórico';
?>

<?php include_once(__DIR__.'/../site/create_popup.php') ?>
<div class="container-fluid historicoevento">
   <!--inicio de eventos proximos-->
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Histórico</span></h4>
			</div>
		</div>
	</div>
   
    <div class="row">
        <?php
            if($modelEventoss){
                echo '<div class="row margin_left-right">';
                foreach ($modelEventoss as $key => $model) {
                    ?>
						<div class="col-md-6 next" style="margin-bottom: 30px">
							<a href="<?= Url::to($model->idevento)?>">
								<div class="fundo_next_event">
									<div class="filtro_eventos" style="background: <?= $model->filtro ?>; "></div>
										<div id="img_eventos" style="height:300px">
											<img class="img-responsive" src="<?= $model->cartaz ?>">
										</div>
										<div class="info_next_event">
											<div class="col-md-12">
												<div class="col-md-1">
													<div class="diaevento"><?= date( 'd',strtotime($model->data) ) //dia?> </div>
													<div class="mesevento"><?= $model->GetMonth(date( 'm',strtotime($model->data) ))  ?> </div>
												</div>
												<div class="col-md-11">
													<span class="tipoevento"><?= $model->tipoeventoIdTipoevento->nome ?></span>
													<h3><?= $model->nome ?></h3>
												</div>
											</div>
										</div>
									</div>
							</a>
						</div>
                    <?php
                }

                echo \yii\widgets\LinkPager::widget(['pagination' => $pag,]);
                echo '</div>';
            }
        ?>  
    </div>
</div>

