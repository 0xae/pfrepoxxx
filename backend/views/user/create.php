<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

$this->title = 'Registrar Utilizador';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form1', [
    'model' => $model,
    'userPermissions' => $userPermissions,
    '_dataPermissions' => $_dataPermissions
]) ?>
<!--
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                
                <?php
                    echo '<label class="control-label">Permissoes</label>';
                    echo Select2::widget([
                        'model' => $model,
                        'attribute' => 'permissions',
                        'data' => $_dataPermissions,
                        'options' => [
                            'placeholder' => 'Permicoes',
                            'multiple' => true,
                        ],
                        'pluginOptions' => [
                            'allowClear' => false,
                            'allowMultiple' => true
                        ],
                    ]);
                    echo '<br/>';
                ?>
                <div class="form-group">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
-->
