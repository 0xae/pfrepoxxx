<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = 'Utilizador';
?>

<div class="container-fluid pagebusiness">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
                    <?php if ($model->id): ?>
                        <div class="borderlefttitlo"></div><span>User</span>
                        <div class="nomebusinesscreate">
                            <div class="borderlefttitlo"></div>
                            <span><?= $model->username ?></span>
                        </div>
                    <?php else: ?>
                        <div class="borderlefttitlo"></div><span>New User</span>
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
							<li role="presentation" class="active"><a href="#info" aria-controls="home" role="tab" data-toggle="tab">Informa&ccedil;&otilde;es Gerais</a></li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
								<div role="tabpanel" class="biz-pane tab-pane active" id="info">
                                    <?php $form = ActiveForm::begin(['id' => 'business_form']); ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
                                                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                                                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                                                <?php
                                                    echo '<label class="control-label">Permissoes</label>';
                                                    echo Select2::widget([
                                                        'name' => 'permissions',
                                                        'value' => $userPermissions,
                                                        'attribute' => 'permissions',
                                                        'data' => $_dataPermissions,
                                                        'options' => [
                                                            'multiple' => true
                                                        ]
                                                    ]);
                                                    echo '<br/>';
                                                ?>
                                            </div>

                                            <div class="col-md-6">
                                            </div>
                                        </div>

                                        <div class="biz-footer">
                                            <?php echo Html::submitButton(
                                                    'Save',
                                                    ['class' =>  'criar btn btn-success', 'id'=> 'submit_business']
                                                );
                                            ?>
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

