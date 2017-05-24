<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use backend\models\PaymentCard;
$model = new PaymentCard();
$formConf = [
    'action'=>'./index.php?r=payment-card/create',
    'options' => [
        'enctype'=>'multipart/form-data'
    ]
];
?>

<div class="modal fade popupcriarbilhete popuplocalizacao" id="new_paymentcard">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Payment Card</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin($formConf); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                echo $form->field($model, 'file')->fileInput([
                                    'onchange'=>'readURL(this)',
                                    'id'=>"file",
                                    'accept' => 'image/*'
                                ])->label(false);
                            ?>
                            <div class="upload text-center">
                                <img style="" class="img-responsive" id="blah" src="<?= $model->file ? $model->file: '#'?>" alt="" />
                                <div id="papelFundo">
                                    <div class="papelFundoinner">
                                        <i class="fa fa-upload" id='upload'></i>
                                        <span id="ecrevCriv">Upload Image</span>
                                    </div>
                                </div>
                                <i class="fa fa-trash" id="trashd"></i>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'description')->textInput() ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-sucesss " 
                                    data-dismiss="modal">Close</button>
                            <?php echo Html::submitButton('Save', [
                                'class' => 'btn btn-primary criar',
                                'ng-click' => 'submitForm()'
                            ]) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
