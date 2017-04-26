<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Business */

$this->title = 'Business';
/*
$this->params['breadcrumbs'][] = ['label' => 'Businesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 */
?>

<?php /*?>PAGINA EDITAR BUSINESS<?php */?>
<div class="container-fluid pagebusiness">
	<?php /*?>///<?php */?>
	<div class="row nomebusinessbt">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<div class="nomebusiness">
					<div class="circulobusiness"></div>
					<div>Nome de Business</div>
				</div>
			</div>
		</div>
	</div>
	<?php /*?>TITULO, BT<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<?php /*?>TITULO<?php */?>
				<h4>
					<div class="borderlefttitlo"></div><span>Bussiness</span>
					<div class="nomebusinesscreate">
						<div class="borderlefttitlo"></div>
						<span>Francis Johnsom, Cabo Verde</span>
					</div>
				</h4>
				<?php /*?>BT<?php */?>
				<div class="pageventbtngroup">
					<a href="#" class="criar btn bt-primary">Publish</a>
					<a href="#" class="criar btn bt-primary">Guardar</a>
				</div>
			</div>
		</div>
	</div>
	<?php /*?>BOX CONTENT<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="business-create">
					<?= $this->render('_form', [
						'model' => $model,
						'producerForm' => $producerForm,
						'producers' => [],
						'_dataCountries' => $_dataCountries,
						'_dataUsers' => $_dataUsers,
						'_dataProducers' => $_dataProducers
					]) ?>
				</div>
			</div>
		</div>
	</div>
</div>