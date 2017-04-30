<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use kartik\select2\Select2;
?>

<div class="progresspopup">
    <div class="lineprogresso"></div>
    <ul>
        <li class="active">1</li>
        <li class="stepmiddleprogress">2</li>
        <li>3</li>
    </ul>					
</div>

<?php
    echo $form->field($newMarca, 'business_id')->widget(Select2::className(), [
        'data' => $data = $_dataBusiness,
        'options' => ['placeholder' => 'Clique para selecionar...', 'multiple' => false],
    ])->label('Business');
?>
<div class="form-group">
    <?php echo $form->field($newMarca, 'file')->widget(FileInput::classname(), ['options' => ['accept'=>'image/*']])->label('Foto');  ?>
</div>
<div class="form-group">
    <?php echo $form->field($newMarca, 'nome')->textInput(['maxlength' => true])->label('Nome') ?>
</div>
<div class="form-group">
    <?php echo $form->field($newMarca, 'email')->textInput(['maxlength' => true])->label('Email') ?>
</div>
<div class="form-group">
    <?php echo $form->field($newMarca, 'slogan')->textInput(['maxlength' => true])->label('Slogan') ?>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="button" data-toggle="tab" data-target="#step2" data-step="step1" class="criar btn btn-primary pf-next-step">Próximo</button>
</div>

