 <?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Bilhete;
use backend\models\Evento;
use backend\models\Tipoevento;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
       <div class="row">

            <div class="col-md-12 proximo">

                <?php
                    if($models){
                        foreach ($models as $key => $model) { ?>
                            <div class="evento_proximo">
                                <?php if($key == 0){ ?>

                                    <div class="event_cartaz">
                                        <img class="img-responsive" src="<?= $model->cartaz ?>">
                                    </div>

                                    <div class="info_cartaz">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h1><i class="fa fa-home"></i> PAINEL 
                                                    
                                                </h1>
                                                <h1>
                                                    <?= Tipoevento::find()->where(['idtipoevento'=>$model->tipoevento_idtipoevento])->one()->nome?>
                                                </h1>
                                                <span>
                                                    <i class="fa fa-calendar"></i> 
                                                    <?= date( 'd',(int) $model->data ) //dia?>
                                                    <?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', (int) $model->data )) //mes?>
                                                    de <?= date( 'Y', (int) $model->data ) //ano?>
                                                </span><br>
                                                <span><i class="fa fa-map-marker"></i> <?=$model->local; //Local?>,
                                                    <?= $model->ilha //ilha?></span>
                                            </div>

                                            <div class="col-md-3">
                                               <div class="percentagem"></div> 
                                            </div>

                                            <div class="col-md-3">
                                                <div class="percentagem"></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                             
                                <?php } ?>

                            </div>

                        <?php

                        }

                    }
                ?>
            </div>
        </div>



        <!--inicio de eventos proximos-->
        <h4 style="color: #009447; font-weight: 700; font-stretch: normal; font-style: normal;"><i class="fa fa-minus" style="transform: rotate(-90deg);"></i> Proxímos Eventos</h4>
        <div class="row">    
            <?php
                if($models){
                    foreach ($models as $key => $model) {

                        if($key > 0){ ?>
                            <div class="col-md-6" style="margin-bottom: 30px;">
                                <div class="fundo_next_event">
                                    <div style="height: 300px;">
                                        <a href="index.php?r=evento%2Fview&id=<?php echo $model->idevento; ?>">
                                            <img class="img-responsive" src="<?= $model->cartaz ?>">
                                        </a>
                                    </div>
                                    <div class="info_next_event"><?php //if($key % 2 != 0) echo 'info_next_event'; else  echo 'info_next_eventr';?> 
                                        <div class="row">
                                            <div class="col-md-3">
                                                <strong style="color:#fff; font-size:25px;">
                                                    <?= $dia = date( 'd', (int)$model->data ) ?>
                                                </strong><br>
                                                <span style="color:#333; font-size:14px; background: #fff; padding: 4px 10px; border-radius: 4px;">
                                                    <?= $mes = date( 'M', (int)$model->data ) ?>
                                                    <?php //= $mes = date( 'Y', (int)$model->data ) ?>
                                                </span>
                                            </div>

                                            <div class="col-md-9">
                                                <h3 class="media-heading">
                                                    <a href="index.php?r=evento%2Fview&id=<?php echo $model->idevento; ?>"><?php echo $model->nome; ?></a>
                                                </h3>
                                                <span style="color:#fff; font-size:35px; font-weight: 700;">
                                                    <?php echo $model->local; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            ?>
            
        </div>
        <!--fim de eventos proximos-->

<div class="modal fade" id="modal-id">
    
</div>
