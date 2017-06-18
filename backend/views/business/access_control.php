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
            <?php $form = ActiveForm::begin(['action' => './index.php?r=biz-access/create', 'id' => 'permission_form', 'enableAjaxValidation'=>true, 'enableClientValidation'=>true]); ?>

            <div class="col-md-12">
                <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true])->label("Email") ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label("Password") ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'password_confirmation')->passwordInput(['maxlength' => true])->label("Password Confirmation") ?>
            </div>

            <div class="col-md-12" >
                <?php
                    echo $form->field($model, 'permissions')->widget(Select2::classname(), [
                        'data' => $_dataPermissions,
                        'options' => ['multiple' => false],
                    ])->label("Permission");
                ?>

                <?= $form->field($model, 'country_id')->hiddenInput(['value' => $bizModel->country_id])->label(false); ?>
                <?= $form->field($model, 'business_id')->hiddenInput(['value' => $bizModel->id])->label(false); ?>

                <div class="biz-footer">
                     <?php echo Html::submitButton(
                         'Add', ['class' =>  'criar btn btn-primary', 'id'=> 'submit_business']
                          );
                     ?>
                 </div>

                <?php ActiveForm::end(); ?>
            </div>
    </div>
</div>
