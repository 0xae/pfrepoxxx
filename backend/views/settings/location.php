<?php
use backend\models\Evento;
use yii\helpers\Url;
use backend\models\Tipoevento;

$this->title = 'Localização';
?>
    
<div class="container-fluid historicoevento localizacao">
   <!--inicio de eventos proximos-->

	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Localização</span></h4>
			</div>
		</div>
	</div>

    <div class="row">
        <div class="col-md-6 next">
            <a href="#location" class="btn btn-success" id="criaEventos" data-toggle="modal">Criar Localização</a>
        </div>
    </div><br>

    <div class="row">
        <div class="col-md-12">
              <div id="_location">
              <?php
                  if($modelsLocation){
                      echo '<div class="row">';
                      foreach ($modelsLocation as $key => $location) {
                          echo "<a idlocation='".$location['idlocation']."' nome='".$location['nome']."' class='_update col-md-4'>";
                              echo $location['nome'];
                          echo '</a>';
                      }
                      echo '</div>';
                  }
              ?>
            </div>
        </div>
    </div>
    <div class="row">

	    <?php
	    	if($modelsLocation){
	    		echo \yii\widgets\LinkPager::widget(['pagination' => $pages,]);
	    	}
	     ?>
    </div>

</div>

<div class="modal fade popupcriarbilhete popupupdate" id="_updatelocation">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nova Localização</h4>
            </div>
            <div class="modal-body">

                <label class="control-label" for="_nomeLocation">Nome</label>
                 <input name="nome" type="text" id="_nomeLocation" class="form-control">

                <div class="modal-footer">
                    <div class="form-group">
                    <button type="button" class="btn btn-sucesss" data-dismiss="modal">Close</button>
                    <button type="button" id="_BtnUpdateLocation" class="btn btn-lg btn-primary criar">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->render('modal_location', [
    'Location' => $Location
]) ?>

<?php

 $urlUpdate=Yii::$app->getUrlManager()->createUrl('settings/updatelocation');

$scrip= <<< JS


    $(document).on('click','._update',function(event){
        event.preventDefault();
        event.stopImmediatePropagation();
        idlocation=$(this).attr('idlocation');
        $("#_nomeLocation").val($(this).attr('nome'));
        $('#_updatelocation').modal("show");

        $('#_BtnUpdateLocation').click(function(e){
            $(this).attr('disabled','true');
            e.preventDefault();
            e.stopImmediatePropagation();
            nome=$('#_nomeLocation').val()+'';
            $.post('$urlUpdate',{idlocation:idlocation,nome:nome},function(data){
                if(data=="1"){
                    $('#_location').load(document.URL+" #_location");
                    $('#_updatelocation').modal("hide");
                    $.pjax.reload({container:'#drop_local_ajax', timeout: 5000});
                }
                $('#_BtnUpdateLocation').removeAttr('disabled');
            });
        })
    });


JS;
$this->registerJs($scrip);
?>
