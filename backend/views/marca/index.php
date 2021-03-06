<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MarcaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcas';
$this->params['breadcrumbs'][] = $this->title;
$user = Yii::$app->user;
$session = Yii::$app->session;
?>
    
<div class="container-fluid pagebusiness">
    <?php echo \Yii::$app->view->renderFile('@app/views/site/business_modal.php', []); ?>
</div>
<div class="container-fluid pagebusiness pagemarcas">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Producer</span></h4>
                <div class="pageventbtngroup">
                    <button type="button" class="criar btn btn-primary" data-toggle="modal" data-target="#modal_criar_marca"> New Producer </button>
                </div>
			</div>
		</div>
	</div>
	<div class="col-md-12 contentbox">
        <?php foreach($models as $m): ?>
            <div class="col-md-3">
                <a href="index.php?r=marca/view&id=<?= $m->idmarca ?>">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12 imgbussinessbox">
                                <div class="filtro_eventos">
                                	<div class="col-md-12 descbussinessbox">
										<div class="linetopbox"></div>
										<div><?= $m->nome ?></div>
										<span><?= $m->slogan ?></span>
									</div>
                                </div>
                                <img class="img-responsive" src="../passafree_uploads/<?= $m->logo ?>" alt="" title="">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
    echo $this->render('create_marca', [
                            'newMarca' => $newMarca,
                            'newUser' => $newUser,
                            'newProdutor' => $newProdutor,
                            '_dataBusiness' => $_dataBusiness,
                       ]);
?>
</div>
