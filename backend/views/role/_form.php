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
                        <?php if (!$model->isNewRecord): ?>
                        <div class="borderlefttitlo"></div><span><?= $model->name; ?> ROLE</span>
                        <?php else: ?>
                            <div class="borderlefttitlo"></div><span>New Role</span>
                        <?php endif; ?>
                    </h4>
                    <?= Html::submitButton('SAVE', ['class' => 'btn btn-default criar']) ?>
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

