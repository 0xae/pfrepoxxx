<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
if ($model->estado == null) {
    $model->estado=1;
}
?>

<div class="container-fluid pagebusiness">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
                    <?php if ($model->idtipoevento): ?>
                        <div class="borderlefttitlo"></div><span>Event Type #<?= $model->idtipoevento ?></span>
                    <?php endif; ?>
				</h4>
			</div>
		</div>
	</div>

	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="business-create">
					<div class="business-form">
						<div role="tabpanel" style="padding:20px">
						  <!-- Nav tabs -->
						  <ul class="nav nav-tabs" role="tablist">
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
								<div role="tabpanel" class="biz-pane tab-pane active" id="info">
                                    <?php $form = ActiveForm::begin(); ?>

                                    <?= $form->field($model, 'nome')->label('Name'); ?>
                                    <?= $form->field($model, 'descricao')->textarea(['rows' => 6,'class'=>'pf-text-editor'])
                                        ->label('Description')
                                    ?>
                                    <?= $form->field($model, 'estado')->hiddenInput(['value' => 1])->label(false); ?>

                                    <div class="form-group" style="float: left">
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary criar']) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>
								</div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
