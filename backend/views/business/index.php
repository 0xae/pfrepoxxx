<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Businesses';
?>

<h1><?= Html::encode($this->title) ?></h1>
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
?>

<div class="container-fluid historicoevento">
	<?php /*?>TITULO, BT<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Bussiness</span></h4>
				<?php /*?>BT<?php */?>
				<ul class="nav nav-pills">
					<li role="presentation"><a href="#"><i class="fa fa-filter"></i></a></li>
					<li role="presentation" class="active"><a href="#">Bussiness</a></li>
					<li role="presentation"><a href="#">Carriers</a></li>
					<li role="presentation"><a href="#">Content Providers</a></li>
					<li role="presentation">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">New <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Bussiness</a></li>
								<li><a href="#">Carriers</a></li>
								<li><a href="#">Content Providers</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<?php /*?>BOX CONTENT<?php */?>
	<div class="row">
		<div class="col-md-12">
		<div class="col-md-4">
			<a href="#">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-12 imgbussinessbox">
							<img class="img-responsive" src="http://192.168.1.110/muska_uploads/imagens/operadora/ZNBcZsMeEgW7sLCycjvzx31DRJJSPpPy.jpg" alt="" title="">
						</div>
						<div class="col-md-12 descbussinessbox">Cabo Verde Tmais</div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>



