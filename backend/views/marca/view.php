<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Marca */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marca-view">

    <!--h1><?php //= Html::encode($this->title) ?></h1-->

    <p>
    <a href="index.php?r=marca%2Fupdate&id=<?php echo $model->idmarca; ?>" class="btn btn-primary bt">
        <i class="fa fa-pencil"></i>
    </a>
     <a href="index.php?r=marca%2Fupdate&id=<?php echo $model->idmarca; ?>" class="btn btn-primary bt">
        <i class="fa fa-trash-o"></i>
    </a>
        <?= Html::a('Delete', ['delete', 'id' => $model->idmarca], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php /*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idmarca',
            'nome',
            'logo',
            'estado',
        ],
    ])*/ ?>
    <div class="row">
        <div class="col-md-4">
            <div class="fundo_marca">
                <?php //echo $model->nome ?>
                <div class="fundo_logo">
                    <img src="<?= $model['logo'] ;?>" class="img-responsive" alt="Image">
                </div>
            </div>
            <div class="text-center" style="margin-top:10px;">   
                <span><?= $model->nome; ?></span>
                <div class="marca-separator"></div>
            </div>
        </div>
    </div>

</div>
