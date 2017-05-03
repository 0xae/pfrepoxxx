<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="rule-form">
    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'nome_regra')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'preco_min')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'preco_max')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'stockMin')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'stockMax')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'percentagem_bilhete')->textInput() ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>

