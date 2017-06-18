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
            <?php $form = ActiveForm::begin(['action' => './index.php?r=biz-access/create', 
                                             'validationUrl' => './index.php?r=biz-access/validate',
                                             'id' => 'permission_form',
                                             'enableAjaxValidation'=>true,
                                             'enableClientValidation'=>true,
                                             'options' => ['ng-submit' => 'submitForm']
                                             ]); ?>


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
                     <?php echo Html::button(
                         'Add', ['class' =>  'criar btn btn-primary', 'ng-click'=> 'submitForm()', 'id'=> 'submit_business']
                          );
                     ?>
                 </div>

                <?php ActiveForm::end(); ?>
            </div>
    </div>

    
    <div class="col-md-5">
        <?php foreach ($_dataAccess as $v): ?>
            <a href="javascript:void(0)">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-4 imgbussinessbox">
                        </div>
                        <div class="col-md-4 descbussinessbox">
                            <div><?= $v->email; ?></div>
                            <span><?= $v->username; ?></span>
                            <span>
                                <span class="label label-danger">DELETE</span>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

