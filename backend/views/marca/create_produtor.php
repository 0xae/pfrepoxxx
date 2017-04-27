<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use kartik\select2\Select2;
?>

<div class="modal fade popupcriarbilhete " id="modal_criar_produtor" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <?php $form = ActiveForm::begin(["action"=>'index.php?r=marca/create-produtor']); ?>
                <div class="modal-header"><h4 class="modal-title">Criar Produtor</h4></div>
                <div class="modal-body">
                    <?= $form->field($newProdutor, 'marca_idmarca')
                             ->hiddenInput(['value' => $marca->idmarca])
                             ->label(false); ?>
                    <?= $form->field($newProdutor, 'foto')->widget(FileInput::classname(), ['options' => ['accept'=>'image/*']]);  ?>
                    <?= $form->field($newProdutor, 'nome'); ?>
                    <label>Sobrenome</label> 
                    <?= $form->field($newProdutor, 'apelido')->label(false); ?>
                    <?= $form->field($newProdutor, 'public_email'); ?>
                    <?= $form->field($newProdutor, 'telefone'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="criar btn btn-primary">Próximo</button>
                </div>
            <?php ActiveForm::end(); ?>
		</div>
	</div>
</div>

