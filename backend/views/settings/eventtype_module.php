<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use backend\models\Tipoevento;
$faqList = [];
$model = new Tipoevento();
?>

<div class="container-fluid pagebusiness pageanalitics">
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Event Type</span></h4>
                <div class="pageventbtngroup">
                    <a href="#newtype" data-toggle="modal" class="criar btn btn-primary">
                        New Event Type
                    </a>
                </div>
			</div>
		</div>
	</div>

	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr class="active">
							<th># ID</th>
							<th>Name</th>
							<th>Description</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach ($eventType as $t): ?>
                            <tr id="evt_<?= $t->idtipoevento; ?>">
                                <td><?= $t->idtipoevento ?></td>
                                <td><?= $t->nome ?></td>
                                <td><?= $t->descricao ?></td>
                                <td>
                                    <a href="./index.php?r=tipoevento/update&id=<?= $t->idtipoevento ?>">
                                        <span class="label label-primary">EDIT</span>
                                    </a>
                                    <a style="color: #999" href="javascript:void(0)">
                                        <span ng-click="deleteEventType(<?= $t->idtipoevento; ?>)" class="label label-danger">DELETE</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!--inicio poupup adicionar biletes-->
<div class="modal fade popupcriarbilhete popuplocalizacao" id="newtype">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Event Type</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action'=>'./index.php?r=tipoevento/create']); ?>

                <?= $form->field($model, 'nome')->label('Name'); ?>
                <?= $form->field($model, 'descricao')->textarea(['rows' => 6,'class'=>'pf-text-editor'])
                    ->label('Description')
                ?>
                <?= $form->field($model, 'estado')->hiddenInput(['value' => 1])->label(false); ?>

                <div class="form-group" style="float: left">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary criar']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

