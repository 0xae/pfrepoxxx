<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use kartik\select2\Select2;
?>

<div class="modal fade popupcriarbilhete " id="modal_criar_user" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
        <?php $form = ActiveForm::begin(["action"=>'index.php?r=marca/create-user']); ?>
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">Criar User</h4></div>
                <div class="modal-body">
                    <?= $form->field($newUser, 'marca_id')
                             ->hiddenInput(['value'=>$marca->idmarca, 'maxlength' => true]) 
                             ->label(false);
                    ?>
                    <div class="form-group">
                        <?= $form->field($newUser, 'nome')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($newUser, 'username')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($newUser, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($newUser, 'password')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="criar btn btn-primary">Finalizar</button>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
	</div>
</div>

