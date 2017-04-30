<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use kartik\select2\Select2;
?>

<div class="progresspopup stepthird">
    <div class="lineprogresso"></div>
    <ul>
        <li>1</li>
        <li class="stepmiddleprogress">2</li>
        <li class="active">3</li>
    </ul>					
</div>

<?= $form->field($newProdutor, 'nome')->label('Nome do responsavel'); ?>

<?= $form->field($newProdutor, 'apelido')->label('Apelido do responsavel'); ?>

<?= $form->field($newProdutor, 'telefone')->label('Telefone do responsable'); ?>

<div class="modal-footer">
    <button type="button" data-step="step3" data-toggle="tab" data-target="#step2" class="btn pf-next-step btn-default">Anterior</button>
    <button type="submit" data-step="step3" id="submit_producer" class="criar btn pf-next-step btn-primary btn-next">Finalizar</button>
</div>
