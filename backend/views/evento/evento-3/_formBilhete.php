<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use backend\models\Bilhete;
?>
    


<!--inicio poupup adicionar biletes-->
    <div class="modal fade popupcriarbilhete" id="addnew">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php /*?><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button><?php */?>
                <h4 class="modal-title">Novo Bilhete</h4>
            </div>
            <div class="modal-body">
    <?php 
        $action = "";
         if($idbilhete) {
            $bilhetemodel = Bilhete::findOne($idbilhete);
            $action = ['evento/updatebilhete', 'id'=>$idbilhete]; 
        }
    ?>

    <?php $form = ActiveForm::begin([
        'id' => $bilhetemodel->formName(),
        'options' => ['enctype' => 'multipart/form-data'],
        'action' =>$action
    ]); ?>
        
        <div class="col-md-6 infoput" style="padding: 0 10px 0 0">
            <?= $form->field($bilhetemodel, 'nome_bilhete')->textInput(['maxlength' => true,'placeholder' =>'Nome'])->label(false) ?>
            <?= $form->field($bilhetemodel, 'stock')->textInput(['maxlength' => true,'placeholder' =>'stock','type'=>'number' ,'min'=>'1'])->label(false) ?>
            <?= $form->field($bilhetemodel, 'preco')->textInput(['maxlength' => true,'placeholder' =>'preco','type'=>'number' ,'min'=>'1'])->label(false) ?>
        </div>

        <div class="col-md-6 infoput" style="padding:0 0 0 10px">
            <?= $form->field($bilhetemodel, 'descricao_bilhete')->textarea(['rows' => 5,'placeholder' =>'Discrisão'])->label(false) ?>
        </div>
    	
    	<div class="rodape">
			<button type="button" class="btn btn-default cancelar" data-dismiss="modal">Cancelar</button>
			<?= Html::submitButton($bilhetemodel->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $bilhetemodel->isNewRecord ? 'btn btn-success criar' : 'btn btn-primary criar']) ?>
		</div>
   
    <?php /*= $form->field($bilhetemodel, 'file')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    ]);  */?>

    <?php ActiveForm::end(); ?>
            </div>
        </div>
      </div>
    </div>
    
<?php 
    $script=<<<JS


        $('form#{$bilhetemodel->formName()}').on('beforeSubmit', function(e)
        {   
            var \$form = $(this);
                var _url = \$form.attr("action");
                var _method = \$form.attr("method");
                var _data = \$form.serialize();

                var formData = new FormData($('#Bilhete')[0]);

                $.ajax({
                    url: _url,
                    type: _method,
                    data: formData,
                    contentType: false,
                    processData: false,
                    
                    success: function (data) {
                        
                        console.log(data);
                        $(document).find('#addnew').modal('hide');
                        $.pjax.reload({container:'#eventoContainer', timeout: 5000});
                    },
                    error: function () {
                        alert("Something went wrong");
                    }
                });
            
            return false;
        });

JS;
$this->registerJs($script);
?>