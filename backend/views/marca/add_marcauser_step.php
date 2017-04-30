<div class="progresspopup stepsecond">
    <ul>
        <li class="active">1</li>
        <div class="lineprogresso donefirst"></div>
        <li class="active stepmiddleprogress">2</li>
        <div class="lineprogresso inativeline"></div>
        <li>3</li>
    </ul>					
</div>

<div class="form-group">
    <?= $form->field($newUser, 'username', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>
</div>

<div class="form-group">
    <?= $form->field($newUser, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>
</div>

<div class="form-group">
    <?= $form->field($newUser, 'password')->passwordInput(['maxlength' => true]) ?>
</div>


<div class="modal-footer">
    <button type="button" data-toggle="tab" data-step="step2"  data-target="#step1" class="btn btn-default pf-next-step">Anterior</button>
    <button type="button" data-toggle="tab" data-step="step2" data-target="#step3" class="criar btn btn-primary pf-next-step">Próximo</button>
</div>
