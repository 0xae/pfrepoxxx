<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
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

                <!--
				<div class="pageventbtngroup">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalcriarmarca">Guardar</a>
				</div>
                -->
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
                                            <?php 
                                                echo $form->field($model, 'file')
                                                          ->widget(
                                                                    FileInput::classname(), 
                                                                    ['options' => ['accept'=>'image/*']]
                                                                );  
                                            ?>
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
                                                ['class' =>  'criar btn btn-primary', 'id'=> 'submit_business']
                                            );
                                        ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>
								</div>

								<div role="tabpanel" class="biz-pane tab-pane" id="access">
                                    <div class="row contentbox">                                                
                                        <?php if (isset($producers)): ?>
                                            <?php foreach ($producers as $p): ?>
                                                <div class="col-md-4">
                                                    <a href="index.php?r=marca/update&id=<?= $p->idmarca; ?>">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="col-md-4 imgbussinessbox">
                                                                <img class="img-responsive" src="<?= $p->logo ?>" alt="" title="">
                                                                </div>
                                                                <div class="col-md-8 descbussinessbox">
                                                                    <div><?= $p->nome; ?></div>
                                                                    <span><?= $p->slogan ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                        	<div class="col-md-12"><div class="alert alert-info" style="margin:20px 0 0 0">Sem produtores</div></div>
                                        <?php endif; ?>
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





