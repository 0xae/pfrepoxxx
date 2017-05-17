<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use backend\models\PaymentChannel;

$model->supported_cards = ArrayHelper::map($model->getCards(), 'name', 'name');
?>

<div class="container-fluid pagebusiness">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
                    <div class="borderlefttitlo"></div><span>Payment Channel</span>
                    <div class="nomebusinesscreate">
                        <div class="borderlefttitlo"></div>
                        <span><?= $model->name ?></span>
                    </div>
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
							<li role="presentation" class="active"><a href="#info" aria-controls="home" role="tab" data-toggle="tab">Info</a></li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
								<div role="tabpanel" class="biz-pane tab-pane active" id="info">
                                    <?php $form = ActiveForm::begin(); ?>

                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                    <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>
                                    <?php
                                        echo $form->field($model, 'supported_cards')->widget(Select2::classname(), [
                                            'options' => ['multiple' => true],
                                            'pluginOptions' => [
                                                'tags' => true,
                                                'tokenSeparators' => [' '],
                                                'maximumInputLength' => 10
                                            ],
                                        ])->label('Supported cards');
                                    ?>
                                    <div class="form-group">
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
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
