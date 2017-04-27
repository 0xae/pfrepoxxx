<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Marca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marca-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?php
            echo $form->field($model, 'business_id')->widget(Select2::className(), [
                'data' => $_dataBusiness,
                'options' => ['placeholder' => 'Clique para selecionar...', 'multiple' => false],
            ])->label('Business');
        ?>
        <?php echo $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        <?php echo $form->field($model, 'file')->widget(FileInput::classname(), ['options' => ['accept'=>'image/*']]);  ?>

        <div class="form-group">
            <?php echo Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success bt' : 'btn btn-primary bt']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
