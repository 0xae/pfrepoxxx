<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use kartik\select2\Select2;
    $user = Yii::$app->user;
    $session = Yii::$app->session;
?>

<div class="progresspopup">
    <div class="lineprogresso"></div>
    <ul>
        <li class="active">1</li>
        <li class="stepmiddleprogress">2</li>
        <li>3</li>
    </ul>					
</div>

<div class="row">

<div class="col-md-6">
    <?php
        if ($user->can('admin') || $user->can('passafree_staff')) {
            echo $form->field($newMarca, 'business_id')->widget(Select2::className(), [
                'data' => $data = $_dataBusiness,
                'options' => ['multiple'=>false],
            ])->label('Business');
        } else {
            echo $form->field($newMarca, 'business_id')
              ->hiddenInput(['value' => $session->get('business')])
              ->label(false);
        }
    ?>
    <div class="form-group">
        <?php echo $form->field($newMarca, 'nome')->textInput(['maxlength' => true])->label('Nome') ?>
    </div>
    <div class="form-group">
        <?php echo $form->field($newMarca, 'email')->textInput(['maxlength' => true])->label('Email') ?>
    </div>
    <div class="form-group">
        <?php echo $form->field($newMarca, 'slogan')->textInput(['maxlength' => true])->label('Slogan') ?>
    </div>
</div>

<div class="col-md-6 up-img_producer" style="overflow: hidden">
    <div class="form-group">
        <?php //upload image
        echo $form->field($newMarca, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*'])->label('Foto') ?>
        <div class="upload text-center">
            <img class="img-responsive" id="blah" src="#" alt="" />
            <div id="papelFundo">
                <div class="papelFundoinner">
                    <i class="fa fa-upload" id='upload'></i>
                    <span id="ecrevCriv">Carregar Imagem</span>
                </div>
            </div>
            <i class="fa fa-trash" id="trashd"></i>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="modal-footer" style="padding-bottom:0px; margin-bottom:-30px;">
        <button type="button" class="btn btn-sucesss " data-dismiss="modal">Close</button>
        <button type="button" data-toggle="tab" data-target="#step2" data-step="step1" class="criar btn btn-primary pf-next-step">Próximo</button>
    </div>
</div>

</div>
