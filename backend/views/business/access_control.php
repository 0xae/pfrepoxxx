<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use backend\models\BizUserForm;
$model = new BizUserForm;
?>

<div class="row">
    <div class="col-md-6">
            <?php $form = ActiveForm::begin(['id' => 'permission_form']); ?>


            <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label("Email") ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label("Password") ?>

            <?= $form->field($model, 'password_confirmation')->passwordInput(['maxlength' => true])->label("Password Confirmation") ?>

            <?php
                echo '<label class="control-label">Permission</label>';
                echo Select2::widget([
                    'name' => 'permissions_to',
                    'attribute' => 'permissions',
                    'data' => $_dataPermissions,
                    'options' => ['multiple' => false]
                ]);
            ?>

            <?= $form->field($model, 'country_id')->hiddenInput()->label(false); ?>
            <?= $form->field($model, 'business_id')->hiddenInput()->label(false); ?>

            <?php ActiveForm::end(); ?>
    </div>
</div>
