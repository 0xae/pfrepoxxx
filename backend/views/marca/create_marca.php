<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Marca */
/* @var $form yii\wi
    * dgets\ActiveForm */
?>

<div class="modal fade popupcriarbilhete " id="modal_criar_marca" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Criar Marca</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo $form->field($model, 'file')->widget(FileInput::classname(), ['options' => ['accept'=>'image/*']]);  ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($model, 'slogan')->textInput(['maxlength' => true]) ?>
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

