<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MarcaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marca-index">
    <?= Html::a('Criar Marca', ['create'], ['class' => 'btn btn-success bt']) ?>
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
    
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_criar_marca">
      Launch modal
    </button>
    <?php echo $this->render('create_marca', ['newMarca' => $newMarca]); ?>
</div>
