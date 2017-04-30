<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\file\FileInput;
use kartik\time\TimePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-3">
            <?php echo $form->field($model, 'tipoevento_idtipoevento')->widget(Select2::className(), [
                'data' => $data = $_dataTipoevento,
                'options' => ['placeholder' => 'Escolha a tipo de evento...', 'multiple' => false],
            ]);?>
        </div> 
        <div class="col-md-3">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?> 
        </div> 
        <div class="col-md-3">
            <?php echo $form->field($model, 'ilha')->widget(Select2::className(), [
    'data' => $data = $_dataIlhas,
    'options' => ['placeholder' => 'Escolha a ilha...', 'multiple' => false],
    ]);?>
        </div> 
        <div class="col-md-3">
            <?php echo $form->field($model, 'filtro')->widget(Select2::className(), [
    'data' => $data = $_dataFiltros,
    'options' => ['placeholder' => 'Escolha o filtro...', 'multiple' => false],
    ]);?>
        </div> 
        <div class="col-md-3">
             <?= $form->field($model, 'data')->widget(
    DatePicker::className(), [
         'inline' => false, 
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>
        </div>        

    <div class="col-md-3">
     <?= $form->field($model, 'hora')->widget(
        TimePicker::className(), [
        'name' => 'start_time', 
        'pluginOptions' => [
            'showSeconds' => true,
            //'autoclose'=>true,
            'format' => 'hh:ii',
            'showMeridian' => false,
            //'minuteStep' => 1,
            'secondStep' => 5,
        ]
        ]);?></div> 
    <div class="col-md-3">  <?= $form->field($model, 'local')->textInput(['maxlength' => true]) ?></div> 
    <div class="col-md-3">
     <?php /**/ echo $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        ]); /**/ ?>
            
        </div> 

      </div> <!-- fim de row -->

        <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>
        <?php // $form->field($model, 'estado')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success bt' : 'btn btn-primary bt']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    
</div>
