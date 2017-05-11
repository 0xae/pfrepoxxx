<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ChatMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chat-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'idBusiness')->textInput() ?>

    <?= $form->field($model, 'mensagem')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'is_read')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
