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
                <div class="modal-header"><h4 class="modal-title">Dados de Acesso</h4></div>
                <div class="modal-body">
				<div class="progresspopup stepsecond">
					<ul>
						<li class="active">1</li>
						<div class="lineprogresso donefirst"></div>
						<li class="active stepmiddleprogress">2</li>
						<div class="lineprogresso inativeline"></div>
						<li>3</li>
					</ul>					
				</div>
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
                        <?= $form->field($newUser, 'password')->passwordInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="criar btn btn-primary">Próximo</button>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
	</div>
</div>

