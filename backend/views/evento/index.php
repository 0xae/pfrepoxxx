<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Produtor;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="evento-index">
    <?php //= Html::a('Criar Novo', ['create'], ['class' => 'btn btn-success bt']) ?>           
    <br>
        <?php 
           /* if($models){

                foreach ($models as $key => $model) {?>
                    <div class="evento_proximo">
                        
                        <?php if($key == 0){ ?>
                            <div class="col-md-7 cartaz">
                                
                                <small><?php //echo $model->data; ?></small>
                                <div class="event_cartaz">
                                    <img class="img-responsive" alt="Image" src="we/<?= $model['cartaz'] ;?>">
                                </div>
                                <h2 class="event_name" style="width:100%;"><?php echo $model->nome; ?></h2>
                            </div>
                            <div class="col-md-5 info">
                                <div class="info_evento">
                                    <h2 style="color:#fff;"><strong>Informação de Vendas</strong> 
                                        <a href="index.php?r=evento%2Fupdate&id= <?= $model->idevento ?>">
                                        <small>Edit <i class="fa fa-pencil-square"></i></small></a>
                                    </h2>
                                    <h4>Vendas - 5000</h4>
                                    <h4>Reservas - 5000</h4>
                                    <h4><i class="fa fa-thumbs-up"></i> Like - 7000</h4>
                                    <h4><i class="fa fa-comment"></i> Comment - 14</h4>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                     
               <?php }
            }

       */ ?>
        <div class="search">
            <h4 style="color:#565656;">Filtrar Eventos Por...</h4>
           <div class="row">
                <div class="col-md-3">
                    <input type="email" name="" id="input" class="form-control" placeholder="Tipo evento">
                </div>
                <div class="col-md-3">
                    <input type="email" name="" id="input" class="form-control" placeholder="Produtor">
                </div>
                <div class="col-md-3">
                    <input type="email" name="" id="input" class="form-control" placeholder="Nome">
                </div>
                <div class="col-md-3">
                    <input type="email" name="" id="input" class="form-control" placeholder="Data">
                </div>
           </div>
        </div>
        <br>
         <?php 
                if($models){

                    foreach ($models as $key => $model) {

                        $_model = Produtor::findOne($model->produtor_idprodutor);

                        ?>
                    <div class="list_evento">
                        <div class="row">
                            <a href="?r=evento%2Fview&id=<?= $model->idevento ?>">
                                <div class="col-md-2">
                                   <img class="img-responsive" src="<?= $model->cartaz ?>">
                                </div>
                                <div class="col-md-2">
                                   <h4>Produtor</h4>
                                  <span><?php if(isset($_model->nome)) echo $_model->nome;  ?></span>
                                </div>
                                <div class="col-md-3">
                                   <h4>Tipo Evento</h4>
                                   <span><?= $model->nome ?></span>
                                </div>
                                <div class="col-md-4">
                                   <h4>Data</h4>
                                   <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i> <?= $model->data ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
         <?php }
            }

        ?>



    <?php /*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'idevento',
            'tipoevento_idtipoevento',
            'produtor_idprodutor',
            'nome',
            'data',
            //'hora',
            //'estado',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>
</div>
    <div class="row">
        <div class="evento_proximo">
        <?php 
           /* if($models){

                foreach ($models as $key => $model) {?>
                        
                    <div class="col-md-4">
                        <div class="event_cartaz">
                            <img class="img-responsive" src="<?= $model->cartaz ?>">
                        </div>
                        <h4 class="fock"><a href="?r=evento%2Fview&id=<?= $model->idevento ?>"><?php echo $model->nome; ?></a></h4>
                    </div>
                            
               <?php }
            }

       */ ?>
        </div>
    </div>


