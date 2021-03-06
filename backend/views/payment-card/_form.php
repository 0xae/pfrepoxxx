<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['class' => 'col-md-12','enctype' => 'multipart/form-data']]); ?>
<div class="container-fluid pagebusiness create-country">
    <div class="row">
        <div class="col-md-12 titulosection">
            <div class="proximo_evento">
                <h4>
                    <?php if ($model->id): ?>
                        <div class="borderlefttitlo"></div><span><?= $model->name ?></span>
                    <?php else: ?>
                        <div class="borderlefttitlo"></div><span>New Payment Card</span>
                    <?php endif; ?>
                </h4>
                <?= Html::submitButton('SAVE', ['class' => 'btn btn-success criar', 'style'=>'float:right']) ?>
            </div>
        </div>
    </div>

    <div class="col-md-12 contentbox">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="business-create" style="padding: 30px">
                    <div class="business-form">
                          <div class="col-md-2" style="height: 100px">
                              <?php
                                  echo $form->field($model, 'file')->fileInput([
                                      'onchange'=>'readURL(this)',
                                      'id'=>"file",
                                      'accept' => 'image/*'
                                  ])->label(false);
                              ?>
                              <div class="upload text-center">
                                  <img style="height:160px !important;" class="img-responsive" id="blah" src="<?= $model->file ? $model->file: '#'?>" alt="" />
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
                              <?php if ($model->logo): ?>
                                  <img style="height:66px; width:66px" 
                                       class="img-responsive" 
                                       src="../passafree_uploads/<?= $model->logo ?>" 
                                       alt="" 
                                    />
                              <?php endif ?>
                              <div class="form-group">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
                              </div>
                              <div class="form-group">
                                <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
                              </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
