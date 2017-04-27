<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MarcaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcas';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php /*<div class="marca-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a('Criar Marca', ['create'], ['class' => 'btn btn-success bt']) ?>
    = GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idmarca',
            'nome',
            'logo',
            'estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); <br><br>
    <div class="row">
        <?php
            if($modelsMarca){

                foreach ($modelsMarca as $key => $model) { ?>
                    <div class="col-md-3">
                        
                            <a href="index.php?r=marca%2Fview&id=<?php echo $model->idmarca; ?>">
                                <div class="fundo_marca">
                                    <div class="fundo_logo">
                                        <img class="img-responsive" src="<?= $model['logo']; ?>">
                                    </div>
                                </div>
                                <div class="text-center" style="margin-top:10px;">   
                                    <span><?= $model->nome; ?></span>
                                    <div class="marca-separator"></div>
                                </div>
                            </a>
                        </div>        
                    
            <?php   
                }
            }
        ?>
    </div>
</div>*/?>
    
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