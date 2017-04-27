<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Marca */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Produtor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div role="tabpanel" style="padding:0; display: table;margin-top: 5px">
	<?php /*?>MENU<?php */?>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#usertab" aria-controls="home" role="tab" data-toggle="tab">Eventos</a>
		</li>
		<li role="presentation">
			<a href="#permissaotab" aria-controls="profile" role="tab" data-toggle="tab">Informação</a>
		</li>
	</ul>
	<?php /*?>//<?php */?>
	<div class="tab-content">
		<?php /*?>Eventos<?php */?>
		<div role="tabpanel" class="biz-pane tab-pane active" id="usertab">
			<div class="col-md-12 proximo">
				<a href="#">
					<div class="evento_proximo">
						<div class="filtro"></div>
							<div id="event_cartaz" class="event_cartaz">
								<img class="img-responsive" src="http://192.168.1.110/passa_free_/uploads/evento/ACjVz0KLdkAuCR-C0zjASihZs8mRtMXt.jpg" title="" alt="">
							</div>
							<div class="info_cartaz">
								<div class="row">
									<div class="col-md-6 detalhes_geral">
										<h1>Nome Evento<?php /*?><?= $_model->nome; ?><?php */?></h1>
										<span>
											<i class="fa fa-calendar"></i> 
											<span>
												11 de abril
												<?php /*?><?= date( 'd',strtotime($_model->data) ) //dia?>
												<?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', strtotime($_model->data) )) //mes?>
												de, <?= date( 'Y', strtotime($_model->data) ) //ano?><?php */?>
											</span>
										</span>
										<span>
											<i class="fa fa-map-marker"></i>
											<span>Angar 7, Santiago<?php /*?><?=$_model->local; //Local?>, <?= $_model->ilha //ilha?><?php */?></span>
										</span>
										<div>
											<button class="btn btn-default"><a href="#<?php /*?><?= Url::to($_model->idevento)?><?php */?>">Ver Detalhes</a></button>
										</div>
									</div>
									<div class="col-md-3 text-center"><br><br><br>
										<div class="fundo_circle">
											<div class="c100 p50">
												<span>68% <br>1500</span>
												<div class="slice">
													<div class="bar"></div>
													<div class="fill"></div>
												</div>
											</div>
										</div>
										<span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Entrada</span>
									</div>

									<div class="col-md-3 text-center"><br><br><br>
										<div class="fundo_circle">
											<div class="c100 p50">
												<span>68%<br><small>5000</small></span>
												<div class="slice">
													<div class="bar"></div>
													<div class="fill"></div>
												</div>
											</div>
										</div>
										<span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Stock</span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<!--inicio de eventos proximos-->
				<div class="row">
					<div class="col-md-12 titulosection">
						<div class="proximo_evento">
							<h4><div class="borderlefttitlo"></div><span>Proxímos Eventos</span></h4>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 next" style="margin-bottom: 30px">
						<a href="#<?php /*?><?= Url::to($model->idevento)?><?php */?>">
							<div class="fundo_next_event">
								<div class="filtro_eventos" style="background:#0f0 <?php /*?> <?= $model->filtro ?>; <?php */?>"></div>
									<div id="img_eventos" style="height:300px">
										<img class="img-responsive" src="http://192.168.1.110/passa_free_/uploads/evento/ACjVz0KLdkAuCR-C0zjASihZs8mRtMXt.jpg<?php /*?><?= $model->cartaz ?><?php */?>">
									</div>
									<div class="info_next_event">
										<div class="col-md-12">
											<div class="col-md-1">
												<div class="diaevento">30<?php /*?><?= date( 'd',strtotime($model->data) ) //dia?> <?php */?></div>
												<div class="mesevento">MAi<?php /*?><?= $model->GetMonth(date( 'm',strtotime($model->data) ))  ?> <?php */?></div>
											</div>
											<div class="col-md-11">
												<span class="tipoevento">Fotebol<?php /*?><?= $model->tipoeventoIdTipoevento->nome ?><?php */?></span>
												<h3>Cabo Verde VS Alemanha<?php /*?><?= $model->nome ?><?php */?></h3>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>