<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['class' => 'col-md-12']]); ?>
<div class="container-fluid pagebusiness create-country">
    <div class="row">
        <div class="col-md-12 titulosection">
            <div class="proximo_evento">
                <h4>
                    <?php if ($model->id): ?>
                        <div class="borderlefttitlo"></div><span><?= $model->name ?></span>
                    <?php else: ?>
                        <div class="borderlefttitlo"></div><span>New Country</span>
                    <?php endif; ?>
                </h4>
                <?= Html::submitButton('SAVE', ['class' => 'btn btn-success criar', 'style'=>'float:right']) ?>
            </div>
        </div>
    </div>

    <div class="col-md-12 contentbox">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="business-create" style="padding: 30px">
                    <div class="business-form">
                          <div class="form-group">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
                          </div>
                          <div class="form-group">
                            <?= $form->field($model, 'code')->textInput(['maxlength' => true]); ?>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
