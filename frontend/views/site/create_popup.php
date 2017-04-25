<?php 

use backend\models\Evento;
use backend\models\Tipoevento;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\time\TimePicker;
use kartik\select2\Select2;
use kartik\date\DatePicker;

 ?>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => ['evento/index'],]); ?>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-transform: uppercase; font-weight: 700;">Novo Evento</h4>
            </div>

            <?php echo $form->field($modelEvento, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*'])->label(false) ?>

            <div class="upload text-center" style="background: #f4f7fa; height: 210px; overflow: hidden;margin-top: -15px;">
                <img class="img-responsive" id="blah" src="#" alt="" />
                <div id="papelFundo">
                <br><br><br><br>
                <i class="fa fa-upload" id='upload'></i><br>
                <span id="ecrevCriv">Carregar Imagen</span>
                </div>
                <i class="fa fa-trash" style="background: #fff; border-radius: 4px;" id="trashd"></i>
  
            </div>

            <!---->
            <div class="modal-body">
                <h4 style="color: #009447; font-weight: 700; font-stretch: normal; font-style: normal; text-transform: uppercase;">
                    <i class="fa fa-minus" style="transform: rotate(-90deg);"></i> filtros</h4>

                    <!--inicio filtros-->
                    <div id="carousel-id" class="carousel slide filter" data-ride="carousel">
                        <!--ol class="carousel-indicators">
                            <li data-target="#carousel-id" data-slide-to="0" class=""></li>
                            <li data-target="#carousel-id" data-slide-to="1" class="active"></li>
                        </ol-->
                        <div class="carousel-inner">
                            <div class="item">
                                <div class="container">
                                    <div class="row">
                                    <?php if($_dataFiltros){?>
                                        <?php foreach ($_dataFiltros as $fil):?>
                                        <div style="background-color: <?= $fil?>" class="col-md-1 _filtroCr" value="<?= $fil?>" ><?php //echo $fil ?></div>
                                        <?php endforeach;}?>
                                    </div>
                                </div>
                            </div>
                            <div class="item active">
                                <div class="container">
                                    <div class="row">
                                        <?php if($_dataFiltros){?>
                                        <?php  foreach ($_dataFiltros as $fil):?>
                                                <div class="col-md-1 _filtroCr" style="background-color: <?= $fil?>" value="<?= $fil?>"><?php // echo $fil ?></div>
                                        <?php endforeach;}?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    <!--fim de filtros-->
                    <br>
                <h4 style="color: #009447; font-weight: 700; font-stretch: normal; font-style: normal; text-transform: uppercase;">
                    <i class="fa fa-minus" style="transform: rotate(-90deg);"></i> informações</h4>
                <div class="row">
                    <div class="col-md-6 infoput">

                        <?php echo $form->field($modelEvento, 'tipoevento_idtipoevento')->widget(Select2::className(), [
                            'data' => $data = $_dataTipoevento,
                            'options' => ['placeholder' => 'Escolha a tipo de evento...', 'multiple' => false],
                        ])->label(false);?>

                        <?= $form->field($modelEvento, 'nome')->textInput(['maxlength' => true, 'placeholder'=> 'Nome'])->label(false) ?>

                        <?= $form->field($modelEvento, 'local')->textInput(['maxlength' => true, 'placeholder'=> 'Local'])->label(false) ?>

                        <?php echo $form->field($modelEvento, 'ilha')->widget(Select2::className(), [
                            'data' => $data = $_dataIlhas,
                            'options' => ['placeholder' => 'Escolha a ilha...', 'multiple' => false],
                        ])->label(false);?>

                        <?= $form->field($modelEvento, 'data')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Enter date ...',
//                                'value'  => empty(($modelEvento->data))?'':date("d-m-Y",$modelEvento->data),
                                ],
//                            'value'  => "12-12-2016",
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                //'value'  => "12-12-2016",
                            ]
                        ])->label(false);?>

                        <?= $form->field($modelEvento, 'hora')->widget(
                        TimePicker::className(), [
                        'name' => 'start_time', 
                        'pluginOptions' => [
                            'showSeconds' => false,
                            //'autoclose'=>true,
                            'format' => 'hh:ii',
                            'showMeridian' => false,
                            //'minuteStep' => 1,
                            'secondStep' => 5,
                        ]
                        ])->label(false);?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($modelEvento, 'descricao')->textArea(['rows' => '12'])->label(false) ?>  
                    </div>
                </div>

                <?php echo $form->field($modelEvento, 'filtro')->textInput(['id'=>'formFilro'])->label(false)?>

            </div>
            <div class="modal-footer rodape">
                
                <?= Html::submitButton($modelEvento->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $modelEvento->isNewRecord ? 'btn btn-success criar' : 'btn btn-primary criar']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>




<script type="text/javascript">


        function readURL(input) {
          
            if (input.files && input.files[0]) {
                var reader = new FileReader();
              
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                    $('#upload').hide();
                    $('#papelFundo').show();
                    $('#ecrevCriv').hide();
                    $('#trashd').show();
                    $('#trashd').hover($('#trashd').css('cursor','pointer'));
                    $('#papelFundo').css('opacity',0.5);
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

    #blah{

        /*height: 210px;*/
        width: 100%;
        left: 0px;
        position: absolute;
        clip: rect(0px,600px,210px,0px);

    }
    #trashd{
        position: relative;
        top: -90px;

    }

    #papelFundo{
        opacity:0.5;
        -moz-opacity: 0.5;
        filter: alpha(opacity=5);
        width: 100%;
        height: 210px;
        position: relative;
        clear: right;
        /*margin-top: -15px;*/
    }
    
    ._filtroCr{
        border-radius: 4px;
        margin-right: 8px;
        margin-left: 8px;
        width:80px;
        height:30px;
    }
    
    
</style>
    <?php

    $scrip=<<<JS
    
        $('#trashd').hide();
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
          
        })
JS;

$this->registerJs($scrip);


?>

<style type="text/css" media="screen">


<?php /*
    if($models){
        foreach ($models as $key => $model) {
            
                    if($key == 0){
                        ?>
                             #event_cartaz{
                                position: relative;
                            }

                            #event_cartaz::before{
                              background-color: <?= $model->filtro ?>;
                              content: '';
                              display: block;
                              height: 100%;
                              position: absolute;
                              width: 100%;
                              opacity: 0.5;
                            }  

                         <?php
                    }
            ?>

                    #img_eventos<?= $key ?>{
                        position: relative;
                    }

                    #img_eventos<?= $key ?>::before{
                      background-color: <?= $model->filtro ?>;
                      content: '';
                      display: block;
                      height: 100%;
                      position: absolute;
                      width: 100%;
                      opacity: 0.5;
                    }  
            <?php
        }
    } /**/
?>


                   
   
</style>
