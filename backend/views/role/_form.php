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

<?php $form = ActiveForm::begin(['options' => ['class' => 'col-md-12']]); ?>
<div class="container-fluid pagebusiness create-role">
    <div class="row">
        <div class="col-md-12 titulosection">
            <div class="proximo_evento">
                <h4>
                    <div class="borderlefttitlo"></div><span>New Role</span>
                </h4>
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-default criar' : 'btn btn-default criar']) ?>
            </div>
        </div>
    </div>

    <div class="col-md-12 contentbox">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="business-create">
                    <div class="business-form">
                          <div class="form-group">
                            <?= $form->field($model, 'name')->textInput($roleNameConfig) ?>
                          </div>
                          <div class="form-group">
                            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<!-- <div class="role-form">

    <?php //$form = ActiveForm::begin(); ?>
    <?php //= $form->field($model, 'name')->textInput($roleNameConfig) ?>
    <?php //= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
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
        <?php //= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php// ActiveForm::end(); ?>

</div> -->
