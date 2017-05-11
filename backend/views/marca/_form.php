<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;

$this->title = 'Form';
?>

<div class="container-fluid pagebusiness">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
                    <?php if ($model->idmarca): ?>
                        <div class="borderlefttitlo"></div><span>Produtor</span>
                        <div class="nomebusinesscreate">
                            <div class="borderlefttitlo"></div>
                            <span><?= $model->nome; ?></span>
                        </div>
                    <?php else: ?>
                        <div class="borderlefttitlo"></div><span>New Produtor</span>
                    <?php endif; ?>
				</h4>
			</div>
		</div>
	</div>

	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="business-create">
					<div class="business-form">
						<div role="tabpanel" style="padding:20px">
						  <!-- Nav tabs -->
						  <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#info" aria-controls="home" role="tab" data-toggle="tab">
                                        Informa&ccedil;&otilde;es Gerais
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#resp" aria-controls="resp" role="tab" data-toggle="tab">
                                        Responsavel
                                    </a>
                                </li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
								<div role="tabpanel" class="biz-pane tab-pane active" id="info">
                                    <?php $form = ActiveForm::begin(['id' => 'business_form', 'options'=>['enctype'=>'multipart/form-data']]); ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php
                                                    if (!$model->idmarca) {
                                                        echo $form->field($model, 'business_id')->widget(Select2::className(), [
                                                            'data' => $_dataBusiness,
                                                            'options' => ['placeholder' => 'Clique para selecionar...', 'multiple' => false],
                                                        ])->label('Business');
                                                    }
                                                ?>
                                                <?php echo $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
                                                <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                                <?php echo $form->field($model, 'slogan')->textInput(['maxlength' => true]) ?>
                                            </div>

                                            <div class="col-md-6">
                                                <?php //upload image
                                                    echo $form->field($model, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*'])->label(false) ?>
                                                    <div class="upload text-center">
                                                        <img class="img-responsive" id="blah" src="<?= $model->file? $model->file: '#'?>" alt="" />
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

                                        <div class="biz-footer">
                                            <?php echo Html::submitButton(
                                                    'Save',
                                                    ['class' =>  'criar btn btn-success', 'id'=> 'submit_business']
                                                );
                                            ?>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                    <!-- .tab-pane -->
								</div>
    
								<div role="tabpanel" class="biz-pane tab-pane" id="resp">
                                    <?php $formu = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo $formu->field($newProdutor, 'nome')->textInput(['maxlength' => true]) ?>
                                                <?php echo $formu->field($newProdutor, 'apelido')->textInput(['maxlength' => true]) ?>
                                                <?php echo $formu->field($newUser, 'email')->textInput(['maxlength' => true]) ?>
                                                <?php echo $formu->field($newUser, 'username')->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                        <div class="biz-footer">
                                            <?php echo Html::submitButton(
                                                    'Save',
                                                    ['class' =>  'criar btn btn-success', 'id'=> 'submit_business']
                                                );
                                            ?>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
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
        height: 300px;
        width: 95.3%;
        position: absolute;
        border-radius: 4px;
        object-fit: cover;
        object-position: 0 50%;
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
        height: 200px;
        position: relative;
        clear: right;
        margin-top: 0px;
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
        else{
                $('#upload').hide();
                $('#papelFundo').show();
                $('#ecrevCriv').hide();
                $('#trashd').show();
                $('#trashd').hover($('#trashd').css('cursor','pointer'));
                $('#papelFundo').css('opacity',0.5);
        
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


