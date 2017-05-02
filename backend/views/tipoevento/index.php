<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TipoeventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoevento-index">

    <p>
        <?= Html::a('Criar Tipo Evento', ['create'], ['class' => 'btn btn-success bt']) ?>
    </p>

    <?php /*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idtipoevento',
            'nome',
            'descricao:ntext',
            'estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>
    <div class="row">
        <?php
            if($modelsTipoevento){

                foreach ($modelsTipoevento as $key => $model) { ?>
                    <div class="col-md-3">
                        <a href="index.php?r=tipoevento%2Fview&id=<?php echo $model->idtipoevento; ?>">
                            <div class="fundo_marca">
                                    <div class="fundo_logo">
                                    <span><?= $model->nome; ?></span>
                                    </div>
                                </div>
                            <div class="text-center" style="margin-top:10px;">   
                                
                                <div class="marca-separator"></div>
                                <p><?= $model->descricao; ?></p>
                            </div>
                        </a>
                    </div>        
                    
            <?php   
                }
            }
        ?>
    </div>

</div>
