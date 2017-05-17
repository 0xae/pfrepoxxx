<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
$this->title = 'Business';
$responsableOptions = [
    'placeholder' => 'Responsable ...',
];
$countryOpts = [
];

if ($model->id) { 
    $responsableOptions['disabled'] = true;
    $countryOpts['disabled'] = true;
}
?>

<div class="container-fluid business_page pagebusiness">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
                    <?php if ($model->id): ?>
                        <div class="borderlefttitlo"></div><span>Business</span>
                        <div class="nomebusinesscreate">
                            <div class="borderlefttitlo"></div>
                            <span><?= $model->name ?></span>
                        </div>
                    <?php else: ?>
                        <div class="borderlefttitlo"></div><span>New Business</span>
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
							<li role="presentation" class="active"><a href="#info" aria-controls="home" role="tab" data-toggle="tab">Informa&ccedil;&otilde;es Gerais</a></li>
							<li role="presentation"><a href="#privacy" aria-controls="privacy" role="tab" data-toggle="tab">Privacy Policy</a></li>
                            <?php if (isset($producers) && !empty($producers)): ?>
							<li role="presentation"><a href="#access" aria-controls="profile" role="tab" data-toggle="tab">Producers</a></li>
                            <?php endif; ?>
						  </ul>
						  <!-- Tab panes -->
						  <div class="tab-content">
								<div role="tabpanel" class="biz-pane tab-pane active" id="info">
                                <?php $form = ActiveForm::begin(['id' => 'business_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                            <?php
                                                echo '<label class="control-label">Country</label>';
                                                echo Select2::widget([
                                                    'model' => $model,
                                                    'attribute' => 'country_id',
                                                    'data' => $_dataCountries,
                                                    'options' => $countryOpts,
                                                    'pluginOptions' => ['allowClear' => false],
                                                ]);
                                                echo '<br/>';
                                            ?>

                                            <?php
                                                echo $form->field($model, 'payment_channel')->widget(Select2::classname(), [
                                                    'data' => $paymentChannels,
                                                    'options' => ['multiple' => false],
                                                ]);
                                            ?>
                                            <?= $form->field($model, 'cashout')->dropDownList([
                                                    'mensal' => 'Mensal',
                                                    'semestral' => 'Semestral',
                                                    'trimestral' => 'Trimestral',
                                                    'anual' => 'Anual'
                                                ]); ?>
        
                                            <?= $form->field($model, 'privacy')->hiddenInput([
                                                'id' => 'privacy_input',
                                                'maxlength' => true
                                            ])->label(false); ?>

                                            <?= $form->field($model, 'privacy_content')->hiddenInput([
                                                'id' => 'privacy_content_input',
                                                'maxlength' => true,
                                            ])->label(false); ?>
                                            
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

                                        <div class="col-md-6">
                                            <?php
                                                echo '<label class="control-label">Responsable</label>';
                                                echo Select2::widget([
                                                    'model' => $model,
                                                    'attribute' => 'responsable',
                                                    'data' => $_dataUsers,
                                                    'options' => $responsableOptions,
                                                    'pluginOptions' => ['allowClear' => false],
                                                ]);
                                                echo '<br/>';
                                            ?>
                                            <?= $form->field($model, 'responsable_percent')->textInput(['maxlength' => true, 'placeholder'=>'ex: 15']) ?>
                                            <?= $form->field($model, 'support_name')->textInput(['maxlength' => true]) ?>
                                            <?= $form->field($model, 'support_email')->textInput(['maxlength' => true]) ?>
                                            <?= $form->field($model, 'support_phone')->textInput(['maxlength' => true]) ?>
                                        </div>
                                    </div>

                                    <div class="biz-footer">
                                         <?php echo Html::submitButton(
                                            $model->isNewRecord ? 'Guardar' : 'Save', 
                                                 ['class' =>  'criar btn btn-primary', 'id'=> 'submit_business']
                                              );
                                         ?>
                                     </div>
                                <?php ActiveForm::end(); ?>
								</div>

								<div role="tabpanel" class="biz-pane tab-pane" id="privacy" style="padding:20px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group field-business-privacy required">
                                                <textarea id="business-privacy-descr" value="" class="form-control text-editor" rows="10" placeholder="Description"><?php echo $model->privacy_content; ?></textarea>
                                                <div class="help-block"></div>
                                            </div>
                                            <?php if (!$model->isNewRecord): ?>
                                            <label>
                                                <a target="_blank" 
                                                   href="./index.php?r=business/privacy&id=<?=$model->id?>">
                                                    Click here
                                                </a> to view the raw privacy policy.
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

								<div role="tabpanel" class="biz-pane tab-pane" id="access">
                                    <div class="row contentbox">                                                
                                        <?php if (isset($producers)): ?>
                                            <?php foreach ($producers as $p): ?>
                                                <div class="col-md-4">
                                                    <a href="index.php?r=marca/update&id=<?= $p->idmarca; ?>">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="col-md-4 imgbussinessbox">
                                                                <img class="img-responsive" src="../passafree_uploads/<?= $p->logo ?>" alt="" title="">
                                                                </div>
                                                                <div class="col-md-8 descbussinessbox">
                                                                    <div><?= $p->nome; ?></div>
                                                                    <span><?= $p->slogan ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                        	<div class="col-md-12"><div class="alert alert-info" style="margin:20px 0 0 0">No producers.</div></div>
                                        <?php endif; ?>
                                    </div>
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
        height: 300px;
        position: relative;
        clear: right;
        /*margin-top: 0px;*/
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

