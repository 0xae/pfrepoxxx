<?php
/* @var $this yii\web\View */
$this->title = 'Analitics';
$user = Yii::$app->user;
?>
<div class="container-fluid pagebusiness  pageanalitics">
    <?php if ($user->can('admin') || $user->can('passafree_staff')): ?>
        <?php echo \Yii::$app->view->renderFile('@app/views/site/business_modal.php', []); ?>
    <?php endif; ?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>User Analitics</span></h4>
			</div>
		</div>
	</div>
	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php /*?>//<?php */?>
				<div class="accountingbox">
					<?php /*?>tab<?php */?>
					<div role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#new" aria-controls="home" role="tab" data-toggle="tab">New</a></li>
							<li role="presentation"><a href="#usage" aria-controls="profile" role="tab" data-toggle="tab">Usage</a></li>
							<li role="presentation"><a href="#interation" aria-controls="profile" role="tab" data-toggle="tab">Interation</a></li>
						</ul>
						<?php /*?>conteudo<?php */?>
						<div class="tab-content">
							<?php /*?>New<?php */?>
							<div role="tabpanel" class="tab-pane active" id="new">New
							</div>
							<?php /*?>Usage<?php */?>
							<div role="tabpanel" class="fade tab-pane" id="usage">Usage
							</div>
							<?php /*?>Interation<?php */?>
							<div role="tabpanel" class="fade tab-pane" id="interation">Interation
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php /*?>TITULO, BT<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Producer Analitics</span></h4>
			</div>
		</div>
	</div>

	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="accountingbox">
					<?php /*?>tab<?php */?>
					<div role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#maisfestas" aria-controls="home" role="tab" data-toggle="tab">Mais Festas</a></li>
							<li role="presentation"><a href="#maisvendidos" aria-controls="profile" role="tab" data-toggle="tab">Mais Bilhetes Vendidos</a></li>
							<li role="presentation"><a href="#maisrendimento" aria-controls="profile" role="tab" data-toggle="tab">Mais Rendimento</a></li>
						</ul>
						<?php /*?>conteudo<?php */?>
						<div class="tab-content">
							<?php /*?>Mais Festas<?php */?>
							<div role="tabpanel" class="tab-pane active" id="maisfestas">Mais Festas
							</div>
							<?php /*?>Mais Bilhetes Vendidos<?php */?>
							<div role="tabpanel" class="fade tab-pane" id="maisvendidos">Mais Bilhetes Vendidos
							</div>
							<?php /*?>Mais Rendimento<?php */?>
							<div role="tabpanel" class="fade tab-pane" id="maisrendimento">Mais Rendimento
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php /*?>TITULO, BT<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Digital Revenue Breakdown</span></h4>
			</div>
		</div>
	</div>
	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr class="active">
							<th>Subscriber</th>
							<th>Country</th>
							<th>Age</th>
							<th>Period</th>
							<th>Expira</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Mark</td>
							<td>Otto</td>
							<td>@mdo</td>
							<td>@mdo</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@fat</td>
							<td>@mdo</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<td>Larry</td>
							<td>the Bird</td> 
							<td>@twitter</td>
							<td>@mdo</td>
							<td>@mdo</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
