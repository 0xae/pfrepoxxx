<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Rule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'percentagem_bilhete')->textInput() ?>

    <?= $form->field($model, 'preco_min')->textInput() ?>

    <?= $form->field($model, 'preco_max')->textInput() ?>

    <?= $form->field($model, 'nome_regra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stockMin')->textInput() ?>

    <?= $form->field($model, 'stockMax')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
