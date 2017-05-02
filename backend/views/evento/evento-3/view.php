<?php
use yii\helpers\Url;
use backend\models\Evento;
use backend\models\Tipoevento;

/* @var $this yii\web\View */
/* @var $model backend\models\Evento */

$this->title = $model->nome;
//$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<script src="https://code.highcharts.com/highcharts.js" type="text/javascript"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>

    function publicarEvento(id, estado)
    {
       // alert(id); alert(estado);

       if(estado == 0){

        var $message = "Desejas publicar esta Evento?";
        var $render = "evento";

    }else if(estado == 1){

        var $message = "Desejas despublicar esta Evento?";
        var $render = "evento/";

    }


    var res = confirm($message);
    if (res == true) {

      var link = 'evento/publicar';

      $.ajax({
        url: link,
        type: 'post',
        data: {'id' : id },
        success: function (response) {
            //$.pjax.reload({container:'#eventoContainer'});
            $.pjax.reload({container:'#eventoContainer', timeout: 5000});
        }
    });
  }
}

function apagar(id){
    var $message = "Desejas excluir este Evento?";

    var res = confirm($message);
    if (res == true) {

    $.ajax({
        url: 'evento/apagar',
        type: 'post',
        data: {'id' : id },
        success: function (response) {
            //$.pjax.reload({container:'#gestaoconteudo'});
            
//             window.location.href='site/index';
            $.pjax.reload({container:'#eventoContainer', timeout: 5000});;
        }
    });
    }
}

function apagarBilhete(id,evento){

    var $message = "Desejas excluir este Bilhete?";

    var res = confirm($message);
    if (res == true) {

    $.ajax({
        url: 'evento/apagarbilhete',
        type: 'post',
        data: {'id' : id },
        success: function (response) {
            $.pjax.reload({container:'#eventoContainer', timeout: 5000});;
        }
    });
    }

}

function publicadoBilhete(id,evento,estado){

    if(estado == 0){

        var $message = "Desejas publicar este Bilhete?";
        var $render = "evento";

    }else if(estado == 1){

        var $message = "Desejas despublicar este Bilhete?";
        var $render = "evento/";

    }


    var res = confirm($message);
    if (res == true) {

    $.ajax({
        url: 'evento/publicarbilhete',
        type: 'post',
        data: {'id' : id },
        success: function (response) {
             $.pjax.reload({container:'#eventoContainer', timeout: 5000});;

//                window.location.href=evento;

        }
    });
    }

}

</script>

<?php include_once(__DIR__.'/../site/create_popup.php') ?>

<?php \yii\widgets\Pjax::begin(['id'=>'eventoContainer']); ?>



<div class="container-fluid Mask topbtevento">
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-default cancelar" href=<?php echo Url::to(['index'])?>>Voltar</a>
        </div>
        <div class="col-md-6 text-right escudo">
            <h2 id="Totalfaturado"><?= $model->estado==1?Yii::$app->mycomponent->Totalfaturado($model->idevento):0 ?>$00</h2>
        </div>
    </div>
</div>



<?php /*?>INFORMACOES DE BILHETE<?php */?>
    <div class="container-fluid pageevento" id="bilhetess">
		<?php /*?>TITULO, BT<?php */?>
		<div class="row">
			<div class="col-md-12 titulosection">
				<div class="proximo_evento" style="margin-bottom: 10px !important;">
					<h4><div class="borderlefttitlo"></div><span>Bussiness</span></h4>
					<?php /*?>BT<?php */?>
					<div class="pageventbtngroup">
						<a data-toggle="modal" href="#addnew" class="criar"><i class="fa fa-ticket"></i> Criar</a>
						<a href="<?= Url::to(['validate','idevento'=>$_GET['id']])?>" class="validar"><i class="fa fa-check"></i>Validar</a>
						<?php
							/*esdado noticia*/
							if($model->publicado == 0){
								echo $publicar = '<a href="#" class="publicar" onclick="publicarEvento('.$model->idevento.','.$model->publicado.')" alt="Publicar Evento" data-toggle="tooltip" data-placement="top" title="Publicar Evento"><i class="fa fa-check-circle"></i> Publicar</a> ';
								echo $apagar = '<a href="#" class="delete" onclick="apagar('.$model->idevento.')" alt="Apagar Evento" data-toggle="tooltip" data-placement="top" title="Apagar Evento"><i class="fa fa-delete"></i> Apagar</a> ';

							}elseif ($model->publicado == 1) {
								echo $publicar = '<a href="#" class="dispublicar" onclick="publicarEvento('.$model->idevento.','.$model->publicado.')"><i class="fa fa-minus-circle"></i> Despublicar</a>';
							}
						?>
						<a href="#editar_evento" class="edit" data-toggle="modal"><i class="fa fa-pencil"></i> Editar</a>
						<?php if($model->estado==1):?>
							<a  id="btnEstado" class="delete" idEvento="<?=$_GET['id']?>" estado="activado"><i class="fa fa-times-circle"></i> Cancelar</a>
						<?php endif ?>
						<?php if($model->estado==-1):?>
							<a  id="btnEstado" idEvento="<?=$_GET['id']?>" estado="cancelado" class="actvar"><i class="fa fa-check"></i> Activar</a>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>

        <?php if($modelBilhete && $model->estado==1):?>
        <div class="row">
            <div class="col-md-12 titulosection">
                <div class="detail_bilhete">
                    <div role="tabpanel">
<!--                        (Nav tabs )->comentario-->
                        <ul class="nav nav-tabs bilhte" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#geral" aria-controls="home" role="tab" data-toggle="tab">Geral</a>
                            </li>
                            <?php foreach ($modelBilhete as $bilhets):?>

                                <li role="presentation">
                                    <a href="#<?=$bilhets->idbilhete?>" aria-controls="tab" role="tab" data-toggle="tab"><?=$bilhets->nome_bilhete?></a>
                                </li>
                            <?php endforeach;?>
                        </ul>

<!--     (Tab panes )->comentario-->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="geral">

                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 style="color: #313541; font-weight: 700;">Descrição</h2>
                                        <p style="font-size: 17px;color: #313541;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        <h2 style="color: #313541; font-weight: 700;">Preço</h2>
                                        <h1 style="color: #009447; font-weight: 700; margin-top: -10px;">500ECV</h1>
                                    </div>

                                    <div class="col-md-3 text-center"><!-- <br> --><br><br>
                                        <div class="fundo_circle">
                                            <div class="c100 p50">
                                                <span>68% <br>1500</span>
                                                <div class="slice">
                                                    <div class="bar"></div>
                                                    <div class="fill"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Entrada</span>
                                    </div>

                                    <div class="col-md-3 text-center"><!-- <br> --><br><br>
                                        <div class="fundo_circle">
                                            <div class="c100 p50">
                                                <span>68%<br><small>5000</small></span>
                                                <div class="slice">
                                                    <div class="bar"></div>
                                                    <div class="fill"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Stock</span>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($modelBilhete as $bilhets):?>
                                <div role="tabpanel" class="tab-pane fade nometick" id="<?=$bilhets->idbilhete?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <?php
                                            /*esdado noticia*/
                                        if($bilhets->publicado == 0){
                                                echo  '<a href="#" class="publicar" onclick="publicadoBilhete('.$bilhets->idbilhete.','.$model->idevento.','.$bilhets->publicado.')" alt="Publicar Bilhete" data-toggle="tooltip" data-placement="top" title="Publicar Bilhete"><i class="fa fa-check-circle"></i> Publicar</a> ';
                                                
                                                echo $apagar = '<a href="#" class="delete" onclick="apagarBilhete('.$bilhets->idbilhete.','.$model->idevento.')" alt="Apagar Bilhete" data-toggle="tooltip" data-placement="top" title="Apagar Bilhete"><i class="fa fa-delete"></i> Apagar</a> ';

                                            }elseif ($bilhets->publicado == 1) {
                                                    echo '<a href="#" class="dispublicar" onclick="publicadoBilhete('.$bilhets->idbilhete.','.$model->idevento.','.$bilhets->publicado.')"><i class="fa fa-minus-circle"></i> Despublicar</a>';
                                                    
                                                    echo $apagar = '<button href="#" class="delete" onclick="apagarBilhete('.$bilhets->idbilhete.','.$model->idevento.')" alt="Apagar Bilhete" data-toggle="tooltip" data-placement="top" title="Apagar Bilhete" disabled><i class="fa fa-delete"></i> Apagar</button> ';
                                            }
                                                

                                            ?>
                                            <h2 style="color: #313541; font-weight: 700;">Descrição</h2>
                                            <p style="color: #313541; text-align: justify;"><?=$bilhets->descricao_bilhete?></p>
                                            <h2 style="color: #313541; font-weight: 700;">Preço</h2>
                                            <h1 style="color: #009447; font-weight: 700; margin-top: -10px;"><?=$bilhets->preco?> ECV</h1>
                                        </div>

                                        <div class="col-md-3 text-center"><br><br><br>
                                            <div class="fundo_circle">
                                                <div class="c100 p<?=Yii::$app->mycomponent->PercentagemPorBilheteEntrada($bilhets->idbilhete)?>">
                                                    <span><?=Yii::$app->mycomponent->PercentagemPorBilheteEntrada($bilhets->idbilhete)?>%
                                                    <br><?=$bilhets->comprado?></span>
                                                    <div class="slice">
                                                        <div class="bar"></div>
                                                        <div class="fill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Entrada</span>
                                        </div>

                                        <div class="col-md-3 text-center"><br><br><br>
                                            <div class="fundo_circle">
                                                <div class="c100 p<?= Yii::$app->mycomponent->PercentagemPorBilheteStock($bilhets->idbilhete)  ?>">
                                                    <span><?= Yii::$app->mycomponent->PercentagemPorBilheteStock($bilhets->idbilhete)  ?>%
                                                        <br><?=$bilhets->stock?></span>
                                                    <div class="slice">
                                                        <div class="bar"></div>
                                                        <div class="fill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Stock</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>
    
    <?php \yii\widgets\Pjax::end(); ?>


<?php /*?>GRAFICO<?php */?>
<?= $this->render('view_grafico', [
    'model' => $model,
    'modelBilhete' => $modelBilhete,
]) ?>


<?php /*?>INFORMACOES DO EVENTO<?php */?>
<?= $this->render('view_infoevento', [
    'model' => $model,
]) ?>


<?php /* COMENTARIOS */?>
<?= $this->render('view_comentarios', [
    'model' => $model,
    'comentario' => $comentario,
]) ?>
<br><!-- <br> -->

<?php //Aniversariantes ?>
<?= $this->render('view_aniversariantes', [
    'model' => $model,
]) ?>


<?php //Popup Update Evento ?>
<?= $this->render('update', [
    '_modelEvento' => $_modelEvento,
    '_dataFiltros'=>$_dataFiltros,
    '_dataTipoevento'=>$_dataTipoevento,
    '_dataIlhas'=>$_dataIlhas
]) ?>


<?php //Popup Create Bilhete ?>
<?= $this->render('_formBilhete', [
    'bilhetemodel' => $bilhetemodel,
    'idbilhete'=>''
]) ?>



<?php
 $idEvento=$_GET['id'];
 $urlGetBilhteGeral=Yii::$app->getUrlManager()->createUrl('evento/bilhetegeral');
 $urlGetBilhete=Yii::$app->getUrlManager()->createUrl('evento/eventobilhete');
 
    $scrip=<<<JS

    $('#btnEstado').click(function() {

        estado=$(this).attr('estado');
        idEvento=$(this).attr('idEvento');

        if(estado=='activado'){

            $.ajax({
                    url:'evento/cancelar',
                    type:'get',
                    data:{id:idEvento},
                    success:function(data){
                        if(data==1){
                             $('#btnEstado').attr('estado','cancelado');

                             $('#Totalfaturado').text('0$00');
                             $('#btnEstado').html('<i class="fa fa-check"></i> Activar');
                             $('#bilhetess').load(idEvento+' #bilhetess',{id:idEvento});
                             $('#CiarValidarBilhete').hide();
                              $('#btnEstado').removeClass('delete');
                             $('#btnEstado').addClass('actvar');
                        }
                        else{
                            alert('Nao pode ser Cancelado');
                        }
                    }
            });
        }
        else{

            $.ajax({
                    url:'evento/activar',
                    type:'get',
                    data:{id:idEvento},
                    success:function(data){
                        if(data >= 0){
                             $('#btnEstado').attr('estado','activado');
                             $('#Totalfaturado').text(data+'$00');
                             $('#btnEstado').html('<i class="fa fa-times-circle"></i> Cancelar');
                              $('#bilhetess').load(idEvento+' #bilhetess',{id:idEvento});
                             $('#CiarValidarBilhete').show();
                             $('#btnEstado').removeClass('actvar');
                              $('#btnEstado').addClass('delete');

                        }
                        else if(data==-2){
                            alert('Nao existe bilhete!');
                        }
                        else{
                             alert('Nao pode ser Activado!');
                        }
                    }
            });
        }

    });
    
    function loadDiv(id){
    
        $("#"+ id).load(document.URL+" "+id);
    }

JS;
/*
        var auto_refresh = setInterval(
            function() {
            idEvento=$('#btnEstado').attr('idEvento');
                $('#bilhetess').load(idEvento+ ' #bilhetess',{id:idEvento}).fadeIn("slow");
                $('#comentario').load(idEvento+ ' #comentario',{id:idEvento}).fadeIn("slow");
                $('#aniversarios').load(idEvento+ ' #aniversarios',{id:idEvento}).fadeIn("slow");
            }, 20000);
/**/
    


    $css=<<<CS
        .actvar{
            background: #ecf0f1!important;
	        border: 0px!important;
	        color: #009447 !important;
	        padding: 5px 15px!important;
	        border-radius: 4px;
	        font-size: 14px;
	        text-transform: uppercase;
        }
    .actvar,.delete{
            cursor:pointer;
        }
CS;


$this->registerJs($scrip);
$this->registerCss($css);


?>
<style type="text/css">
    .dispublicar{
    background: #dd4b39!important;
    border: 0px!important;
    color: #fff!important;
    padding: 5px 15px!important;
    border-radius: 4px;
    font-size: 14px;
    text-transform: uppercase;
}
.publicar{
    background: #313541!important;
    border: 0px!important;
    color: #fff!important;
    padding: 5px 15px!important;
    border-radius: 4px;
    font-size: 14px;
    text-transform: uppercase;
}
.tab-content .nometick{
    padding: 30px;
}
</style>



