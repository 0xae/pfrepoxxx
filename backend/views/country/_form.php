<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="container-fluid pagebusiness create-country">
    <div class="row">
        <div class="col-md-12 titulosection">
            <div class="proximo_evento">
                <h4>
                    <div class="borderlefttitlo"></div><span>New Country</span>
                </h4>
                <button type="submit" class="btn btn-default criar" style="float: right;">Create</button>
            </div>
        </div>
    </div>

    <div class="col-md-12 contentbox">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="business-create">
                    <div class="business-form">
                        <form class="col-md-6">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" class="form-control" id="name" placeholder="Name">
                          </div>
                          <div class="form-group">
                            <label for="codigo">Código</label>
                            <input type="codigo" class="form-control" id="codigo" placeholder="Código">
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
