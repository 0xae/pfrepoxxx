<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<div class="container-fluid pagebusiness create-rule">
    <div class="row">
        <div class="col-md-12 titulosection">
            <div class="proximo_evento">
                <h4>
                    <div class="borderlefttitlo"></div><span>New Rule</span>
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

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="preco_min">Preço Mínimo</label>
                                    <input type="preco_min" class="form-control" id="preco_min" placeholder="Preço Mínimo">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="preco_max">Preço Máximo</label>
                                    <input type="preco_max" class="form-control" id="preco_max" placeholder="Preço Máximo">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="stockMin">Stock Mínimo</label>
                                    <input type="stockMin" class="form-control" id="stockMin" placeholder="Stock Mínimo">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="stockMax">Stock Máximo</label>
                                    <input type="stockMax" class="form-control" id="stockMax" placeholder="Stock Máximo">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="percentagem_bilhete">Percentagem Bilhete</label>
                                <input type="percentagem_bilhete" class="form-control" id="percentagem_bilhete" placeholder="Percentagem bilhete">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>











<div class="rule-form">
    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'nome_regra')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'preco_min')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'preco_max')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'stockMin')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'stockMax')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'percentagem_bilhete')->textInput() ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>

