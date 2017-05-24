<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use backend\models\PaymentChannel;
use backend\models\PaymentCard;

$conf = [
    'enableClientValidation' => true,
    'action' => ['payment-channel/create']
];

$options = ['maxlength' => true];
$model = new PaymentChannel();
$cards = PaymentCard::find()->all();
$data = ArrayHelper::map($cards, 'id', 'name');
?>

<div class="modal fade popupcriarbilhete popuplocalizacao" id="new_paymentchannel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header">
            <h4 class="modal-title"><?php if ($model->id) echo 'Update'; else echo 'Create'; ?> Payment Channel</h4>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <?php $form = ActiveForm::begin($conf); ?>
                <div class="col-md-12">
                    <?= $form->field($model, 'name')->textInput($options) ?>
                    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-12">
                    <?php
                        echo $form->field($model, 'supported_cards')->widget(Select2::classname(), [
                            'data' => $data,
                            'options' => ['multiple' => true],
                            'pluginOptions' => [
                                'tags' => true,
                                'tokenSeparators' => [' '],
                                'maximumInputLength' => 10
                            ],
                        ])->label('Supported cards');
                    ?>
                </div>

                <div class="modal-footer">
                    <div class="form-group">
                    <button type="button" class="btn btn-sucesss" data-dismiss="modal">Close</button>
                    <?php echo Html::submitButton('Save', [
                        'class' => 'btn btn-lg btn-primary criar',
                        'ng-click' => 'submitForm()'
                    ]) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
