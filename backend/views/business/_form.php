<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
$this->title = 'Business';
$user = Yii::$app->user;
$responsableOptions = [
    'placeholder' => 'Responsable ...',
];
$countryOpts = [
];

if ($model->id) { 
    $responsableOptions['disabled'] = true;
    $countryOpts['disabled'] = true;
}

$adminConf = [
    'disabled' => false
];

if (!$user->can('admin') && !$user->can('passafree_staff')) {
    $adminConf['disabled'] = true;
}

?>

<div class="container-fluid business_page pagebusiness" ng-controller="BizController">
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
							<li role="presentation"><a href="#privacy" aria-controls="privacy" role="tab" data-toggle="tab">Privacy Policy</a></li>
                            <?php if (isset($producers) && !empty($producers)): ?>
							<li role="presentation"><a href="#access" aria-controls="profile" role="tab" data-toggle="tab">Producers</a></li>
                            <?php endif; ?>
                            <?php if (!$model->isNewRecord): ?>
							<li role="presentation"><a href="#control" aria-controls="control" role="tab" data-toggle="tab">Access Control</a></li>
                            <?php endif; ?>
						  </ul>
						  <!-- Tab panes -->
						  <div class="tab-content">
								<div role="tabpanel" class="biz-pane tab-pane active" id="info">
                                <?php $form = ActiveForm::begin(['id' => 'business_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled'=>$adminConf['disabled']]) ?>
                                            <?php
                                                echo '<label class="control-label">Country</label>';
                                                echo Select2::widget([
                                                    'model' => $model,
                                                    'attribute' => 'country_id',
                                                    'data' => $_dataCountries,
                                                    'options' => $countryOpts,
                                                    'pluginOptions' => ['allowClear' => false],
                                                ]);
                                                echo '<br/>';
                                            ?>

                                            <?php
                                                echo $form->field($model, 'payment_channel')->widget(Select2::classname(), [
                                                    'data' => $paymentChannels,
                                                    'options' => ['multiple' => false, 'disabled' => $adminConf['disabled']],
                                                ]);
                                            ?>

                                            <?php 
                                                $field = $form->field($model, 'cashout');
                                                echo $field->dropDownList([
                                                        'mensal' => 'Mensal',
                                                        'semestral' => 'Semestral',
                                                        'trimestral' => 'Trimestral',
                                                        'anual' => 'Anual',
                                                    ], 
                                                    [
                                                        'disabled' => $adminConf['disabled']
                                                    ]
                                                ); 
                                            ?>
        
                                            <?= $form->field($model, 'privacy')->hiddenInput([
                                                'id' => 'privacy_input',
                                                'maxlength' => true
                                            ])->label(false); ?>

                                            <?= $form->field($model, 'privacy_content')->hiddenInput([
                                                'id' => 'privacy_content_input',
                                                'maxlength' => true,
                                            ])->label(false); ?>
                                            
                                            <?php echo $form->field($model, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*'])->label(false) ?>
                                            <div class="upload text-center">
                                                <img class="img-responsive" id="blah" src="<?= $model->file? $model->file: '#'?>" alt="" />
                                                <div id="papelFundo">
                                                    <div class="papelFundoinner">
                                                        <i class="fa fa-upload" id='upload'></i>
                                                        <span id="ecrevCriv">Upload Image</span>
                                                    </div>
                                                </div>

                                                <i class="fa fa-trash" id="trashd"></i>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <?php
                                                if ($user->can('passafree_staff') || $user->can('admin')):
                                                    echo '<label class="control-label">Responsable</label>';
                                                    echo Select2::widget([
                                                        'model' => $model,
                                                        'attribute' => 'responsable',
                                                        'data' => $_dataUsers,
                                                        'options' => $responsableOptions,
                                                        'pluginOptions' => ['allowClear' => false],
                                                    ]);
                                                    echo '<br/>';
                                                endif;
                                            ?>
                                            <?= $form->field($model, 'responsable_percent')->textInput(['maxlength' => true, 
                                                                                                        'disabled' => $adminConf['disabled'],
                                                                                                        'placeholder'=>'ex: 15'
                                                                                                      ]) ?>
                                            <?= $form->field($model, 'support_name')->textInput(['maxlength' => true]) ?>
                                            <?= $form->field($model, 'support_email')->textInput(['maxlength' => true]) ?>
                                            <?= $form->field($model, 'support_phone')->textInput(['maxlength' => true]) ?>
                                        </div>
                                    </div>

                                    <div class="biz-footer">
                                         <?php echo Html::submitButton(
                                            $model->isNewRecord ? 'Guardar' : 'Save', 
                                                 ['class' =>  'criar btn btn-primary', 'id'=> 'submit_business']
                                              );
                                         ?>
                                     </div>
                                <?php ActiveForm::end(); ?>
								</div>

								<div role="tabpanel" class="biz-pane tab-pane" id="privacy" style="padding:20px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group field-business-privacy required">
                                                <textarea id="business-privacy-descr" value="" class="form-control text-editor" rows="10" placeholder="Description"><?php echo $model->privacy_content; ?></textarea>
                                                <div class="help-block"></div>
                                            </div>
                                            <?php if (!$model->isNewRecord): ?>
                                            <label>
                                                <a target="_blank" 
                                                   href="./index.php?r=business/privacy&id=<?=$model->id?>">
                                                    Click here
                                                </a> to view the raw privacy policy.
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

								<div role="tabpanel" class="biz-pane tab-pane" id="control" style="padding:20px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1>Hello, world</h1>
                                        </div>
                                    </div>
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
                                                                <img class="img-responsive" src="../passafree_uploads/<?= $p->logo ?>" alt="" title="">
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
                                        	<div class="col-md-12"><div class="alert alert-info" style="margin:20px 0 0 0">No producers.</div></div>
                                        <?php endif; ?>
                                    </div>
								</div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

