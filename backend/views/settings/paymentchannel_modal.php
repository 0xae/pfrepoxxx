<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use backend\models\PaymentChannel;

$conf = [
    'enableClientValidation' => true,
    'action' => ['payment-channel/create']
];

$options = ['maxlength' => true];

if (!isset($model)) {
    $model = new PaymentChannel();
} else {
    $conf['action'] = ['payment-channel/update', 'id'=> $model->id];
    $conf['id'] = 'w1';
    $options['disabled'] = true;
}
$data = ArrayHelper::map($model->getCards(), 'name', 'name');
?>

<!-- modal title -->
<div class="modal-header">
<h4 class="modal-title"><?php if ($model->id) echo 'Update'; else echo 'Create'; ?> Payment Channel</h4>
</div>

<!-- modal body -->
<div class="modal-body">
    <?php $form = ActiveForm::begin($conf); ?>

    <?= $form->field($model, 'name')->textInput($options) ?>
    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

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

<!-- modal footer -->

<?php ActiveForm::end(); ?>

