<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use kartik\select2\Select2;
?>

<div class="modal fade popupcriarbilhete " id="modal_criar_produtor" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <?php $form = ActiveForm::begin(["action"=>"index.php?r=marca/update-produtor&id={$newProdutor->idprodutor}"]); ?>
                <div class="modal-header"><h4 class="modal-title">Informa&ccedil;&otilde;es</h4></div>
                <div class="modal-body">
				<div class="progresspopup stepthird">
					<div class="lineprogresso"></div>
					<ul>
						<li>1</li>
						<li class="stepmiddleprogress">2</li>
						<li class="active">3</li>
					</ul>					
				</div>
                    <?= $form->field($newProdutor, 'marca_idmarca')
                             ->hiddenInput(['value' => $marca->idmarca])
                             ->label(false); ?>
                    <?= $form->field($newProdutor, 'nome')->label('Nome do responsavel'); ?>
                    <label>Sobrenome</label> 
                    <?= $form->field($newProdutor, 'apelido')->label('Apelido do responsavel'); ?>
                    <?= $form->field($newProdutor, 'telefone')->label('Telefone do responsable'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <?php if ($newProdutor->estado == NULL): ?>
                        <button type="submit" class="criar btn btn-primary">Finalizar</button>
                    <?php else: ?>
                        <button type="submit" class="criar btn btn-primary">Guardar</button>
                    <?php endif; ?>
                </div>
            <?php ActiveForm::end(); ?>
		</div>
	</div>
</div>

