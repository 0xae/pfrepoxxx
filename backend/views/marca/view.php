<style type="text/css">
	.content.box_cont {
		padding-left: 0;
		padding-right: 0;
	}
</style>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->nome;
?>
<div class="container-fluid pagebusiness pageusers">
	<div role="tabpanel" style="padding:0; display: table;margin-top: 5px; width: 100%">
        <!--
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#eventotab" aria-controls="home" role="tab" data-toggle="tab">Eventos</a>
			</li>
			<li role="presentation">
				<a href="#informacaotab" aria-controls="profile" role="tab" data-toggle="tab">Informação</a>
			</li>
		</ul>
        -->

		<div class="tab-content" style="padding: 0">
			<div role="tabpanel" class="tab-pane active" id="eventotab">
				<div class="col-md-12 proximo">
					<a href="#<?php /*?><?= Url::to($_model->idevento)?><?php */?>">
						<div class="evento_proximo" style="margin:0">
							<div class="filtro"></div>
								<div id="event_cartaz" class="event_cartaz">
                                    <img class="img-responsive" src="uploads/evento/x22Ps-2U0zMCJvucY8GCY00uPocAtvon.jpg" />
								</div>
								<div class="info_cartaz">
									<div class="row">
										<div class="col-md-6 detalhes_geral">
											<h1>Nome evento<?php /*?><?= $_model->nome; ?><?php */?></h1>
											<span>
												<i class="fa fa-calendar"></i> 
												<span> 30 Abril de 2017
													<?php /*?><?= date( 'd',strtotime($_model->data) ) //dia?>
													<?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', strtotime($_model->data) )) //mes?>
													de, <?= date( 'Y', strtotime($_model->data) ) //ano?><?php */?>
												</span>
											</span>
											<span>
												<i class="fa fa-map-marker"></i>
												<span>Tarrafall, Santiago<?php /*?><?=$_model->local; //Local?>, <?= $_model->ilha //ilha?><?php */?></span>
											</span>
											<div>
												<button class="btn btn-default"><a href="#<?php /*?><?= Url::to($_model->idevento)?><?php */?>">Ver Detalhes</a></button>
											</div>
										</div>

										<div class="col-md-3 text-center"><br><br>
											<div class="fundo_circle">
												<div class="c100 p50">
													<span>25%</span>
													<span class="value">de 1500</span>
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
													<span>75%</span>
													<span class="value">de 30000</span>
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
					<?php /*?>Proxímos Eventos<?php */?>
					<div class="row">
						<div class="col-md-12 titulosection">
							<div class="proximo_evento" style="padding: 0 15px">
								<h4><div class="borderlefttitlo"></div><span>Proxímos Eventos</span></h4>
							</div>
						</div>
					</div>
					<div class="col-md-6 next" style="margin-bottom: 30px">
						<a href="#">
							<div class="fundo_next_event">
								<div class="filtro_eventos" style="background: #0f0<?php /*?><?= $model->filtro ?>; <?php */?>"></div>
								<div id="img_eventos" style="height:300px">
									<img class="img-responsive" src="uploads/evento/x22Ps-2U0zMCJvucY8GCY00uPocAtvon.jpg<?php /*?><?= $model->cartaz ?><?php */?>">
								</div>
								<div class="info_next_event">
									<div class="col-md-12">
										<div class="col-md-1">
											<div class="diaevento">30<?php /*?><?= date( 'd',strtotime($model->data) ) //dia?> <?php */?></div>
											<div class="mesevento">Set<?php /*?><?= $model->GetMonth(date( 'm',strtotime($model->data) ))  ?> <?php */?></div>
										</div>
										<div class="col-md-11">
											<span class="tipoevento">Footebol<?php /*?><?= $model->tipoeventoIdTipoevento->nome ?><?php */?></span>
											<h3>Nome evento<?php /*?><?= $model->nome ?><?php */?></h3>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			
			<?php /*?>Informação<?php */?>
			<div role="tabpanel" class="tab-pane" id="informacaotab">
				<div class="col-md-12 proximo">
					<a href="#<?php /*?><?= Url::to($_model->idevento)?><?php */?>">
						<div class="evento_proximo" style="margin:0">
							<div class="filtro"></div>
								<div id="event_cartaz" class="event_cartaz">
									<img class="img-responsive" src="uploads/evento/x22Ps-2U0zMCJvucY8GCY00uPocAtvon.jpg<?php /*?><?= $_model->cartaz; ?><?php */?>">
							</div>
							<div class="info_cartaz">
								<div class="row">
									<div class="col-md-6 detalhes_geral">
										<h1>Nome evento<?php /*?><?= $_model->nome; ?><?php */?></h1>
										<span>
											<i class="fa fa-calendar"></i> 
											<span> 30 Abril de 2017
												<?php /*?><?= date( 'd',strtotime($_model->data) ) //dia?>
												<?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', strtotime($_model->data) )) //mes?>
												de, <?= date( 'Y', strtotime($_model->data) ) //ano?><?php */?>
											</span>
										</span>
										<span>
											<i class="fa fa-map-marker"></i>
											<span>Tarrafall, Santiago<?php /*?><?=$_model->local; //Local?>, <?= $_model->ilha //ilha?><?php */?></span>
										</span>
										<div>
											<button class="btn btn-default"><a href="#<?php /*?><?= Url::to($_model->idevento)?><?php */?>">Ver Detalhes</a></button>
										</div>
									</div>

									<div class="col-md-3 text-center"><br><br>
										<div class="fundo_circle">
											<div class="c100 p50">
												<span>25%</span>
												<span class="value">de 1500</span>
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
												<span>75%</span>
												<span class="value">de 30000</span>
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
			</div>
		</div>
	</div>
</div>
