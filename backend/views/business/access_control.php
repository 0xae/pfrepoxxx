<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use backend\models\BizUserForm;
$model = new BizUserForm;
?>

<div class="row">
    <div class="col-md-5">
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

    
    <div class="col-md-7" style="margin-top: 15px;padding:15px;background-color:#eee;height:400px;overflow-y:scroll;">
        <?php foreach ($_dataAccess as $v): ?>
        <div class="panel panel-default" id="mapping_<?= $v->id; ?>">
            <div class="panel-body">
                <div class="message-box ">
                    <div class="row">
                        <div class="col-md-2" style="">
                            <div class="text-center box_icon">
                                <i class="overview_icons overall_users">business</i>
                            </div>
                        </div>
                        <div class="col-md-10" style="padding: 15px;margin-left:-40px;">
                            <div><?= $v->email; ?></div>
                            <span><?= $v->username; ?></span>
                            <br/>
                            <span>
                                <a href="javascript:void(0)"><span ng-click="deleteUser(<?= $v->id; ?>)" class="label label-danger">DELETE</span></a>
                                <a href="javascript:void(0)"><span class="label label-primary"><?= $v->getSinglePermission()->item_name ?></span></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="panel panel-default" ng-repeat="m in mappings" id="mapping_{{::m.id}}">
            <div class="panel-body">
                <div class="message-box ">
                    <div class="row">
                        <div class="col-md-2" style="padding:10px;">
                            <div class="text-center box_icon">
                                <i class="overview_icons overall_users">business</i>
                            </div>
                        </div>
                        <div class="col-md-10" style="padding: 15px;margin-left:-40px;">
                            <div>{{ ::m.email }}</div>
                            <span>{{ ::m.username }}</span>
                            <br/>
                            <span>
                                <a href="javascript:void(0)"><span ng-click="deleteUser(m.id, $index)" class="label label-danger">DELETE</span></a>
                                <a href="javascript:void(0)"><span class="label label-primary">{{ ::m.permission}}</span></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

