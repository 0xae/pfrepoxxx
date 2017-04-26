<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\helpers\Html;


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
                    'id' => 'form-signup',
                    'layout' => 'horizontal',
                     'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-sm-9',
                        ],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

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


