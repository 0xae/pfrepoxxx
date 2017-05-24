<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use kartik\select2\Select2;
?>

<div class="modal fade popuplocalizacao popupcriarbilhete " id="modal_criar_marca" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <?php $form = ActiveForm::begin(["action"=>'index.php?r=marca/create', 'enableAjaxValidation'=>true, 'enableClientValidation'=>true,'options'=>['enctype'=>'multipart/form-data']]); ?>
                <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <div class="modal-header">
                    <h4 class="modal-title">Criar Produtor</h4>
                </div>
                <div class="modal-body">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist" style="display:none">
                            <li role="presentation" class="active"><a href="#step1" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                            <li role="presentation"><a href="#step2" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                            <li role="presentation"><a href="#step3" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                          </ul>
                          <!-- Tab panes -->
                          <div class="tab-content">
                                <div role="tabpanel" class="tab-pane step1 active" id="step1">
                                    <?php echo $this->render('add_marca_step.php', ['form'=>$form, 'newMarca'=>$newMarca, '_dataBusiness'=>$_dataBusiness]); ?>
                                </div>
                                <div role="tabpanel" class="tab-pane step2" id="step2">
                                    <?php echo $this->render('add_marcauser_step.php', ['form'=>$form, 'newUser' => $newUser]) ; ?>
                                </div>
                                <div role="tabpanel" class="tab-pane step3" id="step3">
                                    <?php echo $this->render('add_marcaprodutor_step.php', ['form'=>$form, 'newProdutor'=>$newProdutor]); ?>
                                </div>
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            <?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
