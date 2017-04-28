<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = 'Business';
?>

<div class="container-fluid pagebusiness">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
                    <?php if ($model->id): ?>
                        <div class="borderlefttitlo"></div><span>Business</span>
                        <div class="nomebusinesscreate">
                                <div class="borderlefttitlo"></div>
                            <span><?= $model->name ?></span>
                        </div>
                    <?php else: ?>
                        <div class="borderlefttitlo"></div><span>New Business</span>
                    <?php endif; ?>
				</h4>

				<div class="pageventbtngroup">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalcriarmarca">Guardar</a>
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












<?php /*?>STEP 1<?php */?>
<div class="modal fade popupcriarbilhete " id="modalcriarmarca" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header"><h4 class="modal-title">Criar Marca</h4></div>
			<div class="modal-body">
				<?php /*?>PROGRESSO<?php */?>
				<div class="progresspopup">
					<div class="lineprogresso"></div>
					<ul>
						<li class="active">1</li>
						<li class="stepmiddleprogress">2</li>
						<li>3</li>
					</ul>					
				</div>
				<?php /*?>///<?php */?>
				<form>
					<div class="col-md-6">
						<div class="form-group">
							<label>Nome</label>
							<input type="text" class="form-control" placeholder="Select country">
						</div>
						<div class="form-group">
							<label>Slogan</label>
							<input class="form-control" placeholder="">
						</div>
						<div class="form-group">
							<label>Descição</label>
							<textarea type="text" class="form-control" placeholder="Select carrier"></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Logo</label>
							<div class="imguploadpopup">
								<div class="imguploadpopupinner">+</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="labeltipobilhete btn btn-default">Cancelar</button>
				<button type="button" class="criar btn btn-primary">Próximo</button>
			</div>
		</div>
	</div>
</div>
