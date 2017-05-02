<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Bilhete;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<section class="bg" style="background:#efefef; padding:3% 0px;">
    <div class="container">
        <div class="evento-index" style="margin-top:-2%;">
            <a href="index.php/?r=evento/create" class="btn btn-primary" id="criaEventos" style="background:#00a94b; width:15%; border-radius:4px; border:0px; padding:10px 0px; margin-bottom:10px; font-size:18px;" data-toggle="modal" data-target="#"> Criar Eventos
                            </a>


            <div class="row">



                        <div class="col-md-12">

                            <div class="info_evento">
                                <h4 class="title">Eventos Futuros</h4>
                                <ul class="list-unstyled">
                                <?php
                                    if($models){
                                       foreach ($models as $key => $model) {


                                            if($key > 0){

                                                ?>
                                                    <li class="evproximo">
                                                        <a href="?r=evento%2Fview&id=<?= $model->idevento ?>" >
                                                            <div class="pull-left" style="margin-right:10px; margin-top:-6px; border-right:1px solid darkgray; padding-right:10px;">
                                                                <strong><?= $dia = date( 'd', (int)$model->data ) ?></strong><br>
                                                                <span style="color:#333; font-size:12px;"><?=date( 'M', (int)$model->data )?></span>
                                                            </div>
                                                           <h3 class="media-heading"><?php echo $model->nome; ?></h3>
                                                           <span style="color:#333; font-size:12px;"><?php echo $model->local; ?>


                                                           </span>
                                                        </a>
                                                        <a href="index.php/?r=evento/update&id=<?=$model->idevento?>" class="editEvento" data-toggle="modal" data-target="#">Editar</a>
                                                    </li>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                                </ul>
                            </div>

                        </div>

                        <?php /* GridView::widget([
                        'dataProvider' => $models,
                        'columns' => [
                           'nome',
                           'ilha',
                            // ...
                        ],
                    ]) */ ?>



            </div>

            <div id="modal" class="modal fade new_event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="titulo-modal">Criar Evento</h4>
                </div>
                    <div class="modal-body" id="modalContent">

                    </div>
                </div>
              </div>
            </div>



        </div>

 <?php /*
         \yii\bootstrap\Modal::begin([
             'header'=>'<h4 id="titulo-modal"></h4>',
             'id'=>'modal',
             'size'=>'modal-lg'

         ]);
        echo '<div id="modalContent"></div>';

        \yii\bootstrap\Modal::end();
       */ ?>




    </div>

</section>
<?php

$scrip=<<<JS

$('#criaEventos').click(function() {

   $('#titulo-modal').text('Criar Eventos');
$("#modal").modal('show')
            .find("#modalContent")
            .load($(this).attr('href'));
})




$('.editEvento').click(function() {

   $('#titulo-modal').text('Editar Eventos');
  

    $("#modal").modal('show')
            .find("#modalContent")
            .load($(this).attr('href'));
})

JS;


$this->registerJs($scrip);
?>
