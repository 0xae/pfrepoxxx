<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Marca */

$this->title = ' ' . $model->nome;
?>
<div class="marca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        '_dataBusiness' => $_dataBusiness
    ]) ?>

</div>
