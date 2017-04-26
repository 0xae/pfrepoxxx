<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <!--
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
    -->

    <?php
        echo '<label class="control-label">Permissoes</label>';
        echo Select2::widget([
            'name' => 'permissions',
            'value' => $userPermissions,
            'attribute' => 'name',
            'data' => $_dataPermissions,
            'options' => [
                'multiple' => true
            ]
        ]);
        echo '<br/>';
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
