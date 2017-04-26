<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>

<div class="add-producer-form" style="margin-top: 20px">

<?php $form = ActiveForm::begin(['id' => 'producer_form', 'class'=>'form-inline', 'action' => 'index.php?r=business/add-producer']); ?>
<div class="row">
    <div class="col-md-3">
        <?php /*?><label> Produtor</label><?php */?>
        <?php
            echo Select2::widget([
                'name' => 'producer_id',
                'model' => $producerForm,
                'attribute' => 'producer_id',
                'data' => $_dataProducers,
                'options' => ['placeholder' => 'Clique para selecionar'],
                'pluginOptions' => ['allowClear' => false],
            ]);
        ?>
    </div>

    <div class="col-md-3">
        <?php echo Html::submitButton('Adicionar', ['class' =>  'criar btn btn-success', 'id'=> 'submit_producer']); ?>
    </div>
</div> <!-- .row -->
<?php ActiveForm::end(); ?>

</div>

<div class="producer-listing">
	<div class="row">
		<?php foreach($producers as $p): ?>
			<div class="col-md-4">
				<div class="media biz-producer">
					  <div class="media-left">
							<a href="#">
							<img style="margin-top:10px;margin-left:10px;width: 66px;height: 48px;" 
								 class="media-object" 
								 src="img/logo.png" 
								 alt="Marca de <?= $p['marca_nome'] ?>" 
							/>
							</a>
					  </div>
					  <div class="media-body" style="padding: 5px">
							<p>
								<strong><?= $p['marca_nome'] ?></strong> <br/>
								<span><?= $p['produtor_nome']; ?></span> <br/> 
								<span style="font-weight: bold;color:gray;font-size:12px;"><?= $p['produtor_email']; ?></span>
							</p>
							<p>
								<span class="label label-danger pull-right" style="margin-right: 4px">
									<?= Html::a('Eliminar', ['remove-producer', 'id'=>$p['id']], ['class' => '', 'style'=>'color: #fff']) ?>
								</span>
							</p>
					  </div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
