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

<div class="row">

<div class="col-md-6">
    <?php
        echo $form->field($newMarca, 'business_id')->widget(Select2::className(), [
            'data' => $data = $_dataBusiness,
            'options' => ['placeholder' => 'Clique para selecionar...', 'multiple' => false],
        ])->label('Business');
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" data-toggle="tab" data-target="#step2" data-step="step1" class="criar btn btn-primary pf-next-step">Próximo</button>
    </div>
</div>

</div>


<script type="text/javascript">


        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                    $('#upload').hide();
                    $('#papelFundo').show();
                    $('#blah').show();
                    $('#ecrevCriv').hide();
                    $('#trashd').show();
                    $('#trashd').hover($('#trashd').css('cursor','pointer'));
                    $('#papelFundo').css('opacity',0);
                }

                reader.readAsDataURL(input.files[0]);
            }

        }


        var filtroConj=document.getElementsByClassName('filtro');
        var i=0;
        for(i=0;i<filtroConj.length;i++){

            filtroConj[i].style.background=filtroConj[i].getAttribute('value');

        }
    </script>

<style>

 

    #blah {
    height: 255px;
    width: 90%;
    border-radius: 4px;
    object-fit: cover;
    object-position: 0% 50%;
    position: absolute;
}
    #trashd{
        position: relative;
/*         top: 10px; */
        bottom:20px

    }

    #papelFundo{
        opacity:0.5;
        -moz-opacity: 0.5;
        filter: alpha(opacity=5);
        width: 100%;
        height: 255px;
        position: relative;
        clear: right;
        margin-top: 0;
    }

    <?php /*?>._filtroCr{
        border-radius: 4px;
        margin-right: 8px;
        margin-left: 8px;
        width:80px;
        height:30px;
    }<?php */?>


</style>
    <?php

    $scrip=<<<JS
        if($('#blah').attr('src')=='#'){
        
            $('#trashd').hide();
            $('#papelFundo').hover($('#papelFundo').css('cursor','pointer'));
            $('#file').hide();
            $('#formFilro').hide();
            $('#papelFundo').css('opacity',1);
            $('#papelFundo').css('background','#f4f7fa');
        }
        

        $('#trashd').hide();
        $('#blah').hide();
        $('#papelFundo').hover($('#papelFundo').css('cursor','pointer'));
        $('#file').hide();
        $('#formFilro').hide();
        $('#papelFundo').css('opacity',1);
        $('#papelFundo').css('background','#f4f7fa');

         $('#papelFundo').click(function() {
            if( $('#blah').attr('src')=='#'){
            $('#file').click();

          }
         }
        );

        $('._filtroCr').hover(function() {
            if( $('#blah').attr('src')!='#')
            $('#papelFundo').css('background',$(this).attr('value'));
            $('#formFilro').val($(this).attr('value'));
            
        
        });

            if( $('#blah').attr('src')=='#'){
            $('#papelFundo').hover($('#papelFundo').css('cursor','pointer'));
        }
        else{

            $('#papelFundo').hover($('#papelFundo').css('cursor','crosshair'));
        }

        $('#trashd').click(function() {
            $('#file').val('');
            $('#upload').show();
            $('#ecrevCriv').show();
            $('#blah').attr('src','#');
            $('#file').val('');
            $('#trashd').hide();
            $('#papelFundo').css('opacity',1);
            $('#papelFundo').css('background','#f4f7fa');
            $('#formFilro').val('')
             $('#blah').hide();

        })
JS;

$this->registerJs($scrip);


?>
