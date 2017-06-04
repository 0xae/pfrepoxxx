<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<div class="container-fluid pagebusiness create-rule">
    <div class="row">
        <div class="col-md-12 titulosection">
            <div class="proximo_evento">
                <h4>
                    <?php if ($model->id): ?>
                        <div class="borderlefttitlo"></div><span><?= $model->nome_regra ?></span>
                    <?php else: ?>
                        <div class="borderlefttitlo"></div><span>New Business Rule</span>
                    <?php endif; ?>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-12 contentbox">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="business-create" style="padding: 30px; padding-top: 0px">
                    <div class="business-form">
                        <?php $form = ActiveForm::begin(); ?>
                          <div class="form-group">
                            <?= $form->field($model, 'nome_regra')->textInput(['maxlength' => true])
                                     ->label("Name") ?>
                          </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <?= $form->field($model, 'preco_min')->textInput()
                                        ->label("Min Price") ?>
                                </div>
                                <div class="col-md-6 form-group">
                                    <?= $form->field($model, 'preco_max')->textInput()
                                        ->label("Max Price") ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <?= $form->field($model, 'stockMin')->textInput() ?>
                                </div>
                                <div class="col-md-6 form-group">
                                    <?= $form->field($model, 'stockMax')->textInput() ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <?= $form->field($model, 'percentagem_bilhete')->textInput()
                                            ->label("Ticket Percent")
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?= Html::submitButton('SAVE', ['class' => 'btn btn-success criar', 'style'=>'float:right']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
