<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Business */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'file')->fileInput(['accept' => 'image/*']) ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?php
    echo '<label class="control-label">Pa&iacute;s</label>';
    echo Select2::widget([
        'model' => $model,
        'attribute' => 'country_id',
        'data' => $_dataCountries,
        'options' => ['placeholder' => 'Selecione o pais ...'],
        'pluginOptions' => ['allowClear' => false],
    ]);
    echo '<br/>';
?>

<?= $form->field($model, 'payment_channel')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'cashout')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'privacy')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'accountable')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'support_name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'support_email')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'support_phone')->textInput(['maxlength' => true]) ?>

<?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
