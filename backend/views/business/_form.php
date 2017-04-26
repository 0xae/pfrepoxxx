<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Business */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-form">
    <?php /*?><div class="" style="margin-top: 18px;">
        <div class="media">
              <div class="media-left">
                    <a href="#">
                    <img src="<?= ($model->picture) ? $model->picture : 'img/img.svg' ?>" style="width:99px;display:inline" alt="..." class="img-thumbnail media-object" />
                    </a>
              </div>
              <div class="media-body">
              <h4 style="     margin-top: 5px; margin-bottom: -2px;" class="media-heading"><?= $model->name ?></h4>
              <h3 style="display: inline;">
                <small>
                     <?= $model->support_email; ?>
                </small>
              </h3><br/>
              <h3 style="display: inline; font-size:22px;">
                    <small>
                        <span class="glyphicon glyphicon-globe"></span> 
                    </small>
              </h3><br/>
              <span style="margin-top:4px" class="label label-primary"> 
              <?php
                    $label = '<span class="glyphicon glyphicon-usd"></span> Accounting';
                    echo Html::a($label, ['accounting/view-business', 'id'=>$model->id], ['class' => '', 'style'=>'color: #fff']) 
              ?>
              </span>
              <span id="business_id" data-value="<?= $model->id; ?>"></span>
              </div>
        </div>
    </div><?php */?>

    <div role="tabpanel" style="padding:20px 20px 10px 20px">
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

                <div class="col-md-12">
                    <div class="biz-footer">
                    <?php echo Html::submitButton(
                            $model->isNewRecord ? 'Guardar' : 'Actualizar', 
                            ['class' =>  'criar btn btn-success', 'id'=> 'submit_business']
                        );
                    ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>

        <div role="tabpanel" class="biz-pane tab-pane" id="access">
            <?php
                echo $this->render('add_producer', [
                    '_dataProducers'=>$_dataProducers,
                    'producers'=>$producers,
                    'producerForm'=>$producerForm
                ]); 
            ?>
        </div>
      <!-- panel -->
      </div>
    </div>
</div>
