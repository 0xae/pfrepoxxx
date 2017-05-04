<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use kartik\select2\Select2;
    use backend\models\Business;

    $data = Business::find()->all();
    $session = Yii::$app->session;
?>

<?php if ($session->has('business')): $bizId = $session->get('business'); ?>
    <div class="row nomebusinessbt">
        <div class="col-md-12 titulosection">
            <div class="proximo_evento">
                <div class="nomebusiness">
                    <input type="hidden" id="session_business" value="<?= $session->get('business'); ?>" />
                    <div class="circulobusiness"></div>
                    <div><?= $session->get('business_name'); ?></div>
                </div>
                <?php if (\Yii::$app->user->can('passafree_staff') || \Yii::$app->user->can('admin')): ?>
                    <a href="javascript:void(0)" style="color:#000;" data-toggle="modal" data-target="#choose_biz">
                        <div class="labeltipobilhete">CHANGE</div>
                    </a>
                <?php elseif ($bizId > 0): ?>
                    <a href="index.php?r=business/update&id=<?= $session->get('business'); ?>" style="color:#000;">
                        <div class="labeltipobilhete">EDIT</div>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="modal fade popupcriarbilhete " id="choose_biz" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">select a business</h4>
                </div>
                <!-- .modal-header -->

                <div class="modal-body">
                   	<div class="row">
						<div class="col-md-12 contentbox" style="padding: 0">
							<?php foreach ($data as $d): ?>
								<div class="col-md-6 boxconteinerbus">
									<a href="javascript:void(0);" class="biz-choice" data-id="<?= $d->id; ?>">
										<div class="panel panel-default">
											<div class="panel-body">
												<div class="col-md-4 imgbussinessbox">
													<img class="img-responsive" src="<?= $d->picture; ?>" alt="" title="">
												</div>
												<div class="col-md-8 descbussinessbox">
													<span><?php echo $d->name; ?></span>
													<span><?php echo $d->getCountry()->one()->name; ?></span>
												</div>
											</div>
										</div>
									</a>
								</div>
							<?php endforeach; ?>
						</div>
                    </div>
                </div>
                <!-- .modal-body -->
		</div>
	</div>
</div>

