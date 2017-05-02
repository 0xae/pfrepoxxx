<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

use kartik\time\TimePicker;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\Url;
use backend\models\Evento;
use backend\models\Tipoevento;

/* @var $this yii\web\View */
/* @var $model backend\models\Evento */

//$this->title = 'Update Evento: ' . ' ' . $model->idevento;
//$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idevento, 'url' => ['view', 'id' => $model->idevento]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<!-- <div class="evento-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?php /*echo $this->render('_formEvento', [
        'modelEvento' => $model,
        '_dataIlhas' => $_dataIlhas,
        '_dataFiltros' => $_dataFiltros,
        '_dataTipoevento' => $_dataTipoevento,
    ]) */?>

</div> -->

    <div class="modal fade popupcriarbilhete" id="editar_evento">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php /*?><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button><?php */?>
                <h4 class="modal-title">Editar evento</h4>
            </div>
            <!--div class="modal-body"-->
              <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


            <?php echo $form->field($_modelEvento, 'file')->fileInput(['onchange'=>'readURLEditar(this)','id'=>"fileEditar",'accept' => 'image/*'])->label(false)?>


            <div class="upload text-center">
                <img class="img-responsive" id="blahEditar" src="<?= $_modelEvento->cartaz?>" alt="" />
                <div id="papelFundoEditar">
                	<i class="fa fa-upload" id="fa-upload"></i><br>
                	<span id="imageCar">Carregar Imagen</span>
                </div>
                <i class="fa fa-trash pagal" id='fa-trash'></i>
                
            </div>



            <!---->
            <div class="modal-body" style="padding-bottom: 0">
               	<div class="row">
					<div class="col-md-12 titulosection">
						<div class="proximo_evento">
							<h4><div class="borderlefttitlo"></div><span>Filtros</span></h4>
						</div>
					</div>
				</div>
				<!--inicio filtros-->
				<div id="carousel-id" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner uservalbackground">
						<div class="item active">
							<div class="container">
								<div class="row">
									<?php foreach ($_dataFiltros as $fil):?>
										<div class="col-md-1 filtroEd" value="<?= $fil?>"><?php //= $fil?></div>
									<?php endforeach;?>
								</div>
							</div>
						</div>
					</div>
					<a class="left carousel-control" href="#carousel-id" data-slide="prev">&lsaquo;</a>
					<a class="right carousel-control" href="#carousel-id" data-slide="next">&rsaquo;</a>
				</div>
				<!--fim de filtros-->
				
				<div class="row">
					<div class="col-md-12 titulosection">
						<div class="proximo_evento">
							<h4><div class="borderlefttitlo"></div><span>Informações</span></h4>
						</div>
					</div>
				</div>
				
                <div class="row">
                   	<div class="col-md-12">
						<div class="col-md-6 infoput" style="padding:0 10px 0 0">
							<?php echo $form->field($_modelEvento, 'tipoevento_idtipoevento')->widget(Select2::className(), [
								'data' => $data = $_dataTipoevento,
								'options' => ['placeholder' => 'Escolha a tipo de evento...', 'multiple' => false],
							])->label(false);?>

							<?= $form->field($_modelEvento, 'nome')->textInput(['maxlength' => true, 'placeholder'=> 'Nome'])->label(false) ?>

							<?= $form->field($_modelEvento, 'local')->textInput(['maxlength' => true, 'placeholder'=> 'Local'])->label(false) ?>

							<?php echo $form->field($_modelEvento, 'ilha')->widget(Select2::className(), [
								'data' => $data = $_dataIlhas,
								'options' => ['placeholder' => 'Escolha a ilha...', 'multiple' => false],
							])->label(false);?>

							<?= $form->field($_modelEvento, 'data')->widget(DatePicker::classname(), [
								'options' => ['placeholder' => 'Enter date ...',
	//                                'value'  => empty(($_modelEvento->data))?'':date("d-m-Y",$_modelEvento->data),
									],
	//                            'value'  => "12-12-2016",
								'pluginOptions' => [
									'format' => 'yyyy-mm-dd',
									'todayHighlight' => true,
									//'value'  => "12-12-2016",
								]
							])->label(false);?>

							<?= $form->field($_modelEvento, 'hora')->widget(
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

						<div class="col-md-6" style="padding:0 0 0 10px">
							<?= $form->field($_modelEvento, 'descricao')->textArea(['rows' => '8'])->label(false) ?>  
						</div>
					</div>
                </div>

                <?php echo $form->field($_modelEvento, 'filtro')->textInput(['id'=>'filtroEditar'])->label(false)?>

            </div>
            <div class="modal-footer rodape">
                <button type="button" class="btn btn-default cancelar" data-dismiss="modal">Cancelar</button>
                <?= Html::submitButton($_modelEvento->isNewRecord ? 'Criar' : 'Guardar', ['class' => $_modelEvento->isNewRecord ? 'btn btn-success criar' : 'btn btn-primary criar']) ?>
            </div>
        <!--/div-->
    </div>
</div>
<?php ActiveForm::end(); ?>
            </div>
        </div>
      </div>
    </div>
    
    <script type="text/javascript">

        function readURLEditar(inputEditar) {
            if (inputEditar.files && inputEditar.files[0]) {
                var readerEditar = new FileReader();

                readerEditar.onload = function (e) {
                    $('#blahEditar').attr('src', e.target.result);
                    $('#papelFundoEditar').css('opacity',0)
                    $('#fa-upload').hide();
                    $('#papelFundoEditar').show();
                    $('#imageCar').hide();
                    $('#fa-trash').show();
                    $('#fa-trash').hover($('#fa-trash').css('cursor','pointer'));

                }

                readerEditar.readAsDataURL(inputEditar.files[0]);
            }

        }


        var filtroConjc=document.getElementsByClassName('filtroEd');
        var i=0;
        for(i=0;i<filtroConjc.length;i++){

            filtroConjc[i].style.background=filtroConjc[i].getAttribute('value');
        }
    </script>
<style>

    #blahEditar{

        width: 100%;
        left: 0px;
        position: absolute;
        clip: rect(0px,600px,300px,0px);

    }

    #papelFundoEditar{
        opacity:0.5;
        -moz-opacity: 0.5;
        filter: alpha(opacity=5);
        width: 100%;
        height:300px;
        position: relative;
        /*clear: right;*/
        background: <?=$_modelEvento->filtro?>;
        /*margin-top: -15px;*/
    }
    .filtroEd{
        border-radius: 4px;
        margin-right: 8px;
        margin-left: 8px;
        padding: 8px;
}


</style>
    <?php

    $scrip=<<<JS
        $('#fa-trash').show();
        
        $('#fileEditar').hide();
        $('#fa-upload').hide();
        $('#imageCar').hide();
        $('#filtroEditar').hide();
        
        
         $('#papelFundoEditar').click(function() {
            if( $('#blahEditar').attr('src')=='#'){
                $('#fileEditar').click();
          
          }
         }
        );
        
        if( $('#blahEditar').attr('src')=='#'){
            $('#papelFundoEditar').hover($('#papelFundoEditar').css('cursor','pointer'));
            $('#fa-trash').hover($('#fa-trash').css('cursor','auto'));
        }else{
                 $('#papelFundoEditar').hover($('#papelFundoEditar').css('cursor','auto'));
                 $('#fa-trash').hover($('#fa-trash').css('cursor','pointer'));
            }
        
        $('.filtroEd').hover(function() {
            if( $('#blahEditar').attr('src')!='#')
            $('#papelFundoEditar').css('background',$(this).attr('value'));
            $('#filtroEditar').val($(this).attr('value'));
             $('#papelFundoEditar').css('opacity',0.5);
           
          
        });

       
        $('.fa-trash').click(function() {
            $('#fileEditar').val('');
            $('#fa-upload').show();
            $('#imageCar').show();
            $('#blahEditar').attr('src','#');
            $('#fileEditar').val('');
            $('#fa-trash').hide();
            $('#papelFundoEditar').css('opacity',1);
            $('#papelFundoEditar').css('background','#f4f7fa');
            $('#formFilroEditar').val('');
            $('#papelFundoEditar').hover($('#papelFundoEditar').css('cursor','pointer'));
          
        })

JS;

$this->registerJs($scrip);


?>
