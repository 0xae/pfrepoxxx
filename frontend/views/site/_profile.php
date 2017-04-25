<?php
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;


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
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<div id="formulario" style="margin-top: 6%;width: 450px; height: 450px;">
     <?php echo $form->field($profile, 'marca_idmarca')->widget(Select2::className(), [
    'data' => $data = $_dataMarca,
    'options' => ['placeholder' => 'Escolha a marca em que este pertence...', 'multiple' => false],
     'disabled' => true
    ]);?>
    <?= $form->field($profile, 'nome') ?>
    <?= $form->field($profile, 'apelido') ?>
    <?= $form->field($profile, 'public_email') ?>
    <?= $form->field($profile, 'sexo') ?>
    <?= $form->field($profile, 'telefone') ?>
    <?= $form->field($profile, 'foto')->fileInput(['accept' => 'image/*'])?>


<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton('Editar', ['class' => 'glyphicon glyphicon-pencil btn btn-block btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
</div>
