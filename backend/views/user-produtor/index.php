<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArtistaSearchUserProdutor */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Produtors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-produtor-index">

    <p><a href="index.php?r=user-produtor%2Fcreate" class="btn btn-success bt">Criar User produtor</a></p>
    <br>
    <div class="row">
    <?php
            if($models){

                foreach ($models as $key => $model_) { ?>

                    <div class="col-md-3">
                        <a href="?r=user-produtor%2Fupdate&id=<?php echo $model_['idprodutor']; ?>"> 
                            <div class="fundo_marca">
                                <div class="fundo_logo">
                                    <img class="img-responsive" src="uploads/others/usersemfoto.png">
                                </div>
                            </div>      
                                <div class="text-center" style="margin-top:10px;">
                                    <span style="color: green">
                                        <?php 
                                            if($model_['nome'])
                                                echo $model_['nome'].' '.$model_['apelido'];
                                            else
                                                echo $nome = $model->loadModelUserProdutor($model_['idprodutor']);
                                        ?>
                                    </span>
                                    <div class="marca-separator"></div>
                                    
                                </div>
                            
                             
                        </a>
                    </div>
               <?php }

            }
        ?>
    </div>
</div>
