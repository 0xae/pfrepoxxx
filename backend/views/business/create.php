<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Business */

$this->title = 'Business';
?>

<div class="container-fluid pagebusiness">
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

	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
					<div class="borderlefttitlo"></div><span>Bussiness</span>
					<div class="nomebusinesscreate">
						<div class="borderlefttitlo"></div>
						<span>Francis Johnsom, Cabo Verde</span>
					</div>
				</h4>

				<div class="pageventbtngroup">
					<a href="#" class="criar btn bt-primary">Publish</a>
					<a href="#" class="criar btn bt-primary">Guardar</a>
				</div>
			</div>
		</div>
	</div>

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
