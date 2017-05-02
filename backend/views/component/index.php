<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action'=>'index.php?r=component/upload', 'options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <button type="submit">Submit</button>
<?php ActiveForm::end() ?>
