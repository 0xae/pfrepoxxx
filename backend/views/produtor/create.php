<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use kartik\file\FileInput;
use kartik\select2\Select2;


$this->title = 'Create a produtor account';
$this->params['breadcrumbs'][] = ['label' => 'Produtor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<h4><a href="index.php?r=user/index" class="btn btn-success criar admibt">Users</a></h4>


<div class="category-form" style="border: 1px solid rgba(0, 0, 0, 0.1); padding: 10px; background: #fafafa;">
    <div class="row">
        <div class="col-md-3">
            <div style="background:#fff; padding:10px; border:1px solid #eee;">
                <?= Nav::widget([
                    'options' => [
                        'class' => 'nav-pills nav-stacked',
                    ],
                    'items' => [
                        ['label' => 'Detalhes da conta', 'url' => ['/produtor/registar']],
                        ['label' => 'Detalhes do perfil', 'options' => [
                            'class' => 'disabled',
                            'onclick' => 'return false;',
                        ]],
                        ['label' => 'Informação', 'options' => [
                            'class' => 'disabled',
                            'onclick' => 'return false;',
                        ]],
                    ],
                ]) ?>
            </div>
        </div>
        <div class="col-md-9">
            <div style="background:#fff; padding:10px; border:1px solid #eee;">
                
                <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data'],
                    'id' => 'form-signup',
                    'layout' => 'horizontal',
                     'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-sm-9',
                        ],
                    ],
                ]); ?>

                <?= $form->field($produtor, 'nome')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                 <?php echo $form->field($marca, 'nome')->widget(Select2::className(), [
                'data' => $_dataMarca,
                'name' => 'choose_spoonser',
                'maintainOrder' => true,
                'options' => ['placeholder' => 'Selecionar Segmentação...', 'multiple' => false],
                'pluginOptions' => [
                    'tags' => true,
                    //'maximumInputLength' => 25
                ],]);

                 ?>

                <?php echo $form->field($marca, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                ]); ?>

                <?= $form->field($marca, 'telefone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($marca, 'sede')->textInput(['maxlength' => true]) ?>

                <?= $form->field($marca, 'slogan')->textInput(['maxlength' => true]) ?>

                <?= $form->field($marca, 'email')->textInput(['maxlength' => true]) ?>


                


                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?php  echo Html::submitButton('Save', ['class' => 'btn btn-block btn-success criar']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br>
</div>


