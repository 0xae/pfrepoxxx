<?php
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Update a user account';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/views/artista/_base_.php', ['model' => $model]) ?>


<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation'   => true,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>

   <?php  echo 'previlegio'; ?>

<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton('Save', ['class' => 'btn btn-block btn-success criar']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>