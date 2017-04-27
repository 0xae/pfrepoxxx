<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MarcaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcas';
$this->params['breadcrumbs'][] = $this->title;
?>
    
<div class="container-fluid pagebusiness pagemarcas">
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
	<?php /*?>//<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Marcas</span></h4>
			</div>
		</div>
	</div>
	<div class="col-md-12 contentbox">
		<div class="col-md-4">
			<a href="#">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="col-md-12 imgbussinessbox">
								<div class="userciculo"></div>
								<img class="img-responsive" src="../../img/Unitel_img.jpg" alt="" title="">
							</div>
							<div class="col-md-12 descbussinessbox">
								<div class="linetopbox"></div>
								<div>Sigui Sabura</div>
								<span>gettinng free publicity for you</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-4">
				<a href="index.php?r=business/create">
					<div class="panel panel-default addbusiness">
						<div class="panel-body">+</div>
					</div>
				</a>
			</div>
		</div>
	</div>
    
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_criar_marca">
      Launch modal
    </button>
    <?php echo $this->render('create_marca', ['newMarca' => $newMarca, '_dataBusiness' => $_dataBusiness]); ?>
</div>
