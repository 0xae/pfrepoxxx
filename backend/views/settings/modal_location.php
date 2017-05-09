<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
?>

<!--inicio poupup adicionar biletes-->
<div class="modal fade popupcriarbilhete popuplocalizacao" id="location">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nova Localização</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'action' => ['settings/location'],
                    'options' => ['enctype' => 'multipart/form-data'],
                 ]); ?>

                 <?= $form->field($Location, 'nome')->textInput(['maxlength' => true]) ?>

                <div class="modal-footer">
                    <div class="form-group">
                    <button type="button" class="btn btn-sucesss" data-dismiss="modal">Close</button>
                        <?= Html::submitButton($Location->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $Location->isNewRecord ? 'btn btn-lg btn-primary criar' : 'btn btn-lg btn-primary criar']) ?>
                    </div>
                </div>

                 <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

