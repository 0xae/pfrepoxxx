<?php
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;


$this->title = 'Atualizar Conta Produtor';
$this->params['breadcrumbs'][] = ['label' => 'Produtor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<?php $this->beginContent('@app/views/user-produtor/_base_.php', ['model' => $model]) ?>


<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>

     <?php echo $form->field($profile, 'marca_idmarca')->widget(Select2::className(), [
    'data' => $data = $_dataMarca,
    'options' => ['placeholder' => 'Escolha a marca em que este pertence...', 'multiple' => false],
    ]);?>
    <?= $form->field($profile, 'nome') ?>
    <?= $form->field($profile, 'apelido') ?>
    <?= $form->field($profile, 'public_email') ?>
    <?= $form->field($profile, 'sexo') ?>
    <?= $form->field($profile, 'telefone') ?>
    <?= $form->field($profile, 'foto') ?>


<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton('Save', ['class' => 'btn btn-block btn-success criar']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>