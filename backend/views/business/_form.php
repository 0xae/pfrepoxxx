<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = 'Business';
?>

<div class="container-fluid pagebusiness">
	<div class="row nomebusinessbt">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<div class="nomebusiness">
					<div class="circulobusiness"></div>
					<div>Nome de Business</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
					<div class="borderlefttitlo"></div><span>New Business</span>
					<div class="nomebusinesscreate">
                        <?php if ($model->id): ?>
                            <div class="borderlefttitlo"></div>
                        <?php endif; ?>
                        <span><?= $model->name ?></span>
					</div>
				</h4>

				<div class="pageventbtngroup">
					<button type="button" id="submit_business" class="criar btn bt-primary">Guardar</a>
				</div>
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
                        <li role="presentation"><a href="#access" aria-controls="profile" role="tab" data-toggle="tab">Produtores</a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="biz-pane tab-pane active" id="info">
                            <?php $form = ActiveForm::begin(['id' => 'business_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                        <?php
                                            echo '<label class="control-label">Pa&iacute;s</label>';
                                            echo Select2::widget([
                                                'model' => $model,
                                                'attribute' => 'country_id',
                                                'data' => $_dataCountries,
                                                'options' => ['placeholder' => 'Selecione o pais ...'],
                                                'pluginOptions' => ['allowClear' => false],
                                            ]);
                                            echo '<br/>';
                                        ?>

                                        <?= $form->field($model, 'payment_channel')->textInput(['maxlength' => true]) ?>
                                        <?= $form->field($model, 'cashout')->textInput(['maxlength' => true]) ?>
                                        <?= $form->field($model, 'privacy')->textInput(['maxlength' => true]) ?>
                                        <?php /*?><?= $form->field($model, 'Image')->textarea(['maxlength' => true]) ?><?php */?>
                                    </div>

                                    <div class="col-md-6">
                                        <?php
                                            echo '<label class="control-label">Responsavel</label>';
                                            echo Select2::widget([
                                                'model' => $model,
                                                'attribute' => 'responsable',
                                                'data' => $_dataUsers,
                                                'options' => ['placeholder' => 'Selecione o responsavel ...'],
                                                'pluginOptions' => ['allowClear' => false],
                                            ]);
                                            echo '<br/>';
                                        ?>
                                        <?= $form->field($model, 'responsable_percent')->textInput(['maxlength' => true, 'placeholder'=>'ex: 15']) ?>
                                        <?= $form->field($model, 'support_name')->textInput(['maxlength' => true]) ?>
                                        <?= $form->field($model, 'support_email')->textInput(['maxlength' => true]) ?>
                                        <?= $form->field($model, 'support_phone')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="biz-footer">
									<?php echo Html::submitButton(
											$model->isNewRecord ? 'Guardar' : 'Actualizar', 
											['class' =>  'criar btn btn-success', 'id'=> 'submit_business']
										);
									?>
								</div>

                            <?php ActiveForm::end(); ?>
                        </div>

                        <div role="tabpanel" class="biz-pane tab-pane" id="access">
                            <div class="row contentbox">
								<div class="col-md-4">
									<a href="#">
										<div class="panel panel-default">
											<div class="panel-body">
												<div class="col-md-4 imgbussinessbox">
													<img class="img-responsive" src="../../img/Unitel_img.jpg" alt="" title="">
												</div>
												<div class="col-md-8 descbussinessbox">
													<div>Nome Produtor</div>
													<span>Texto produtor</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
                        </div>
                      <!-- panel -->
                      </div>
                    </div>
                </div>
				</div>
			</div>
		</div>
	</div>
</div>
