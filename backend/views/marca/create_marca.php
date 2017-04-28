<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use kartik\select2\Select2;
?>

<div class="modal fade popupcriarbilhete " id="modal_criar_marca" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <?php $form = ActiveForm::begin(["action"=>'index.php?r=marca/create', 'options'=>['enctype'=>'multipart/form-data']]); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Criar Marca</h4>
                </div>
                <div class="modal-body">
                    <div class="progresspopup">
                        <div class="lineprogresso"></div>
                        <ul>
                            <li class="active">1</li>
                            <li class="stepmiddleprogress">2</li>
                            <li>3</li>
                        </ul>					
                    </div>
                    <div class="col-md-12">
                        <?php
                            echo $form->field($newMarca, 'business_id')->widget(Select2::className(), [
                                'data' => $data = $_dataBusiness,
                                'options' => ['placeholder' => 'Clique para selecionar...', 'multiple' => false],
                            ])->label('Business');
                        ?>
                        <div class="form-group">
                            <?php echo $form->field($newMarca, 'file')->widget(FileInput::classname(), ['options' => ['accept'=>'image/*']]);  ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($newMarca, 'nome')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($newMarca, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($newMarca, 'slogan')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="criar btn btn-primary">Próximo</button>
                </div>
            <?php ActiveForm::end(); ?>
		</div>
	</div>
</div>



