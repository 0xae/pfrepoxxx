<?php
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;



$this->title = 'Atualizar Conta Produtor';
?>
<?php include_once(__DIR__.'/../site/create_popup.php') ?>
<?php $this->beginContent('@app/views/site/_base_.php', ['model' => $model]) ?>


<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>

<div id="formulario" style="margin-top: 6%;width: 450px; height: 450px;">
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton('Editar', ['class' => 'glyphicon glyphicon-pencil btn btn-block btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
</div>
