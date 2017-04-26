<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Businesses';
?>

<?php /*?><h1><?= Html::encode($this->title) ?></h1>
<?php if (Yii::$app->user->can('admin')): ?>
    <p>
        <?= Html::a('Create Business', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php endif; ?>

<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'created_at:datetime',
        'updated_at:datetime',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?><?php */?>

<div class="container-fluid pagebusiness">
	<?php /*?>///<?php */?>
	<div class="row nomebusinessbt">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<div class="nomebusiness">
					<div class="circulobusiness"></div>
					<div>Nome de Business</div>
				</div>
				<div class="labeltipobilhete">Alterar</div>
			</div>
		</div>
	</div>
	<?php /*?>TITULO, BT<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Bussiness</span></h4>
			</div>
		</div>
	</div>
	<?php /*?>BOX CONTENT<?php */?>
	<div class="col-md-12 contentbox">
		<div class="col-md-3">
			<a href="#">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-12 imgbussinessbox">
							<img class="img-responsive" src="../../img/fundologin.png" alt="" title="">
						</div>
						<div class="col-md-12 descbussinessbox">
							<span>Francis Johnsom</span>
							<span>Armenia</span>
						</div>
					</div>
				</div>
			</a>
		</div>
		<?php /*?>Adcionar<?php */?>
		<div class="col-md-3">
			<a href="#">
				<div class="panel panel-default addbusiness">
					<div class="panel-body">+</div>
				</div>
			</a>
		</div>
	</div>
</div>