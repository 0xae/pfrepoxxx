<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$roleNameConfig = [
    'maxlength' => true,
];

if ($model->name) {
    $roleNameConfig['disabled'] = true;
}

?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput($roleNameConfig) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?php
        /*
        echo '<label class="control-label">Permissoes</label>';
        echo Select2::widget([
            'model' => $model,
            'name' => 'children',
            'data' => $_dataChildren,
            'options' => [
                'placeholder' => 'Select ...',
                'multiple' => true
            ],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);
        echo '<br>';
        */
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
