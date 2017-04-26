<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Marca */

$this->title = 'Criar Marca';
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marca-create">

    <h2 style="color:#565656;"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
