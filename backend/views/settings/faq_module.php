<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use backend\models\Faq;
$faqList = [];
$model = new Faq();
?>

<div class="container-fluid pagebusiness pageanalitics">
	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
			</div>
		</div>
	</div>
	<?php /*?>TITULO, BT<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span></span></h4>
                <div class="pageventbtngroup">
                    <a href="#newfaq" data-toggle="modal" class="criar btn btn-primary">
                        New FAQ
                    </a>
                </div>
			</div>
		</div>
	</div>
	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr class="active">
							<th># ID</th>
							<th>Question</th>
							<th>Answer</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach ($faqs as $f): ?>
                            <tr>
                                <td><?= $f->id ?></td>
                                <td><?= $f->pergunta ?></td>
                                <td><?= substr($f->resposta,0,50) . '...'; ?></td>
                                <td>
                                    <a href="./index.php?r=faq/update&id=<?= $f->id ?>">
                                        <span class="label label-primary">EDIT</span>
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
<div class="modal fade popupcriarbilhete popuplocalizacao" id="newfaq">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New FAQ item</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action'=>'./index.php?r=faq/create']); ?>

                <?= $form->field($model, 'pergunta')->textarea(['rows' => 2]) ?>

                <?= $form->field($model, 'resposta')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'estado')->hiddenInput(['value' => 1])->label(false); ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

