<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EventoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idevento') ?>

    <?= $form->field($model, 'produtor_idprodutor') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'hora') ?>

    <?php // echo $form->field($model, 'local') ?>

    <?php // echo $form->field($model, 'descricao') ?>

    <?php // echo $form->field($model, 'cartaz') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
