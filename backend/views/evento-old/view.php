<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Evento */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-view">

    <h1 style="color:#00a94b;"><?= Html::encode($this->title) ?></h1>
        <?php //= Html::a('Update', ['update', 'id' => $model->idevento], ['class' => 'btn btn-primary']) ?>
        <?php /*= Html::a('Delete', ['delete', 'id' => $model->idevento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
  
    <div class="row">

        <div class="col-md-7 cartaz">
            <div class="event_cover">
                <img class="img-responsive" src="<?= $model->cartaz ?>">
            </div>
        </div>
        <div class="col-md-5 info">
            <div class="info_evento">
                <h2 style="color:#fff;"><strong>Informação de Vendas</strong> 
                    <a href="index.php?r=evento%2Fupdate&id= <?= $model->idevento ?>">
                        <small><i class="fa fa-pencil-square" style="margin-left:10px;"></i></small>
                    </a>

                    <a href="index.php?r=evento/delete&id= <?= $model->idevento ?>">
                        <small><i class="fa fa-trash-o"></i></small>
                    </a>
                </h2>
                <h4>Vendas - 5000</h4>
                <h4>Reservas - 5000</h4>
                <h4><i class="fa fa-thumbs-up"></i> Like - 7000</h4>
                <h4><i class="fa fa-comment"></i> Comment - 14</h4>
            </div>
        </div>

    </div>

</div>
