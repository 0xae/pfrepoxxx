<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use backend\models\PaymentCard;
$model = new PaymentCard();
?>

<div class="modal fade popupcriarbilhete popuplocalizacao" id="new_paymentcard">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Payment Card</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action'=>'./index.php?r=payment-card/create']); ?>
            
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textInput() ?>

                    <?= $form->field($model, 'logo')->textarea(['rows' => 6]) ?>

                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-sucesss" data-dismiss="modal">Close</button>
                            <?php echo Html::submitButton('Save', [
                                'class' => 'btn btn-lg btn-primary criar',
                                'ng-click' => 'submitForm()'
                            ]) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
