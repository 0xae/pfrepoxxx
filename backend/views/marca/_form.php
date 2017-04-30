<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;

$this->title = 'Form';
?>

<div class="container-fluid pagebusiness">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
                    <?php if ($model->idmarca): ?>
                        <div class="borderlefttitlo"></div><span>Marca</span>
                        <div class="nomebusinesscreate">
                            <div class="borderlefttitlo"></div>
                            <span><?= $model->nome; ?></span>
                        </div>
                    <?php else: ?>
                        <div class="borderlefttitlo"></div><span>New Marca</span>
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
                                <li role="presentation" class="active">
                                    <a href="#info" aria-controls="home" role="tab" data-toggle="tab">
                                        Informa&ccedil;&otilde;es Gerais
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#resp" aria-controls="resp" role="tab" data-toggle="tab">
                                        Responsavel
                                    </a>
                                </li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
								<div role="tabpanel" class="biz-pane tab-pane active" id="info">
                                    <?php $form = ActiveForm::begin(['id' => 'business_form']); ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                                                <?php echo $form->field($model, 'file')->widget(FileInput::classname(), ['options' => ['accept'=>'image/*']]);  ?>
                                                <?php
                                                    if (!$model->idmarca) {
                                                        echo $form->field($model, 'business_id')->widget(Select2::className(), [
                                                            'data' => $_dataBusiness,
                                                            'options' => ['placeholder' => 'Clique para selecionar...', 'multiple' => false],
                                                        ])->label('Business');
                                                    }
                                                ?>
                                                <?php echo $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

                                                <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                                                <?php echo $form->field($model, 'slogan')->textInput(['maxlength' => true]) ?>
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
                                    <!-- .tab-pane -->
								</div>
    
								<div role="tabpanel" class="biz-pane tab-pane" id="resp">
                                        <h1>User</h1>
                                       <p> <?php echo $newUser->username; ?>  </p>
                                       <p> <?php echo $newUser->email; ?> </p>

                                        <h1>Produtor</h1> 
                                       <p> <?php echo $newProdutor->nome; ?>  </p>
                                       <p> <?php echo $newProdutor->public_email; ?> </p>
                                </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

