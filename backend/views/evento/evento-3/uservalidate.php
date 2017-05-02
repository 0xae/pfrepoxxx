modalpopup<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Evento */

$this->title = 'user validate';
//$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php include_once(__DIR__.'/../site/create_popup.php') ?>


<div class="container-fluid">
    <div class="row  validate_mask Mask">
		<a class="btn btn-default cancelar" href=<?= \yii\helpers\Url::to(['validate','idevento'=>$evento->idevento])?>>Voltar</a>
    </div>
</div><!-- <br> -->
<div class="pagina_geral">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="user_validate">

			<?php if($users->foto && strpos($users->foto, "uploads")!==false){?>
						<img src="../../../<?=Yii::$app->request->baseUrl.'/'.$users->foto?>" class="img-responsive" alt=""> 
			<?php } else{ ?>
						<img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt=""> 
			<?php }?>
			</div>
		</div>
		<div class="col-md-9 user_contatos">
			<h2 ><?= $users->nome ?></h2>
			<span><?=$users->email ?></span><br>


					<span style="color: #009447; font-size: 15px;"> 
					<?= date( 'd',(strtotime($users->data_nascimento)) ) //dia?>
					<?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', (strtotime($users->data_nascimento)) )) //mes?>
					de <?= date( 'Y', (strtotime($users->data_nascimento))) //ano?>
					</span>
		</div>
	</div>
	
	<div class="row">
		<?php \yii\widgets\Pjax::begin(['id'=>'bilhetes'])?>
		<div class="comentarios">
			<div id="carousel-id" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner uservalbackground">
					<div class="item active">
						<div class="box_coment" style="padding: 20px;">
							<div class="row">
								<?php if($CBs):?>
									<?php for ($i=0;$i<3 && $i<count($CBs);$i++){?>
										<div class="col-md-4" style="margin-bottom: 30px;">
											<div class="validate_bi">
												<div class="user_code">
											   		<span>
													   <?php if($users->foto && strpos($users->foto, "uploads")!==false){?>
															<img src="../../../<?=Yii::$app->request->baseUrl.'/'.$users->foto?>" class="img-responsive" alt=""> 
														<?php } else{ ?>
															<img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt="">
															<?php }?>
														<div><?= $users->nome ?>(nao especificado)</div>
													</span>
													<span style="border: 1px solid #00a94b; border-radius: 5px; padding: 2px 6px; color: #00a94b; float: right;"><?= Yii::$app->mycomponent->getNomeBilhete($CBs[$i]['idcompra_bilhete'])?>
														<i class="fa fa-ticket"></i>
													</span>
												</div>
												<div class="codigoqrcode">
													<span>1937377</span>
													<img src="../../img/code.png" class="img-responsive" alt="">
													<?php /*?><img src="../../../<?= Yii::$app->request->baseUrl ?>/<?=  $CBs[$i]['qr_code'] ?>" class="img-responsive" alt=""><?php */?>
												</div>

												<?php if(!Yii::$app->mycomponent->bilheteValidado($CBs[$i]['idcompra_bilhete'])):?>
												<div class="text-center" style="background: #009447; padding: 5px;border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
													<a data-toggle="modal" href='#modal_validate' style="color: #fff; font-weight: 700; text-transform: uppercase;" onclick='validar("<?= $CBs[$i]['codigo_QR'] ?>","<?= $CBs[$i]['idcompra_bilhete'] ?>", "<?= Yii::$app->mycomponent->getNomeBilhete($CBs[$i]['idcompra_bilhete'])?>")'>Validar</a>
												</div>
												<?php endif?>
												<?php if(Yii::$app->mycomponent->bilheteValidado($CBs[$i]['idcompra_bilhete'])):?>
													<div class="text-center"><span>Validado</span></div>
												<?php endif?>

											</div>
										</div>
									<?php }?>
									<?php endif;?>

								</div>
							</div>
						</div>
						<?php /*if($i<count($CBs)):?>
								<?php $coun=$i; while($coun<=count($CBs)){?>
								<div class="item">
									<?php for ($o=$coun;$o<($coun+3) && $o<count($CBs);$o++ ){;?>
										<div class="col-md-4" style="margin-bottom: 30px;">
											<div class="validate_bi">
												<div class="user_code">
												   <?php if($users->foto && strpos($users->foto, "uploads")!==false){?>
														<img src="../../../<?=Yii::$app->request->baseUrl.'/'.$users->foto?>" class="img-responsive" alt=""> 
													<?php } else{ ?>
														<img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt=""> 
														<?php }?>

													<span style="float: left;"><?= $users->nome ?>(nao especificado)</span>
													<span style="border: 1px solid #00a94b; border-radius: 5px; padding: 2px 6px; color: #00a94b; float: right;"><?= Yii::$app->mycomponent->getNomeBilhete($CBs[$o]['idcompra_bilhete'])?>
														<i class="fa fa-ticket"></i>
													</span>
												</div>
												<div class="codigoqrcode"><img src="/passa_free_/img/code.png"/><?php /*?><?= $CBs['codigo_QR'] ?><?php */

												/*

												?></div>
												<img src="<?= Yii::$app->request->baseUrl ?>/<?=  $CBs[$o]['qr_code'] ?>" class="img-responsive" alt="">
												<?php if(!Yii::$app->mycomponent->bilheteValidado($CBs[$o]['idcompra_bilhete'])):?>
												<div class="text-center" style="background: #009447; padding: 5px;border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
													<a data-toggle="modal" href='#modal_validate' style="color: #fff; font-weight: 700; text-transform: uppercase;" onclick='validar("<?= $CBs[$o]['codigo_QR'] ?>","<?= $CBs[$o]['idcompra_bilhete'] ?>", "<?= Yii::$app->mycomponent->getNomeBilhete($CBs[$o]['idcompra_bilhete'])?>")'>Validar</a>
												</div>
												<?php endif?>
												<?php if(Yii::$app->mycomponent->bilheteValidado($CBs[$o]['idcompra_bilhete'])):?>
													<div class="text-center" style="background: #009447; padding: 5px;border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
														<span  style="color: #fff; font-weight: 700; text-transform: uppercase;">Validado</span>
													</div>
												<?php endif?>

											</div>
										</div>
									<?php } $coun+=$o?>
									</div>
									<?php }?>
									<?php endif; /**/?>




								<?php /*?><a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
								<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a><?php */?>
					</div>
			</div>
				</div>
			</div>	
		</div>
	</div>
	<?php \yii\widgets\Pjax::end()?>
</div>


<div class="modal fade modalpopup" id="modal_validate" style="padding-top: 12%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="col-md-6">
					<?php $form = \yii\widgets\ActiveForm::begin(['action' =>\yii\helpers\Url::to(['evento/confirmar']),'id'=>'form',
						]); ?>
						<h4>
							<span>1937377</span>
							<?php /*?><span id="codeB" ></span><?php */?>
							<span class="labeltipobilhete" id="nomeBilh">VIP <i class="fa fa-ticket"></i>
							</span>
						</h4>
						<input type="hidden" name="idbilhete" id="idbilhete">
						<input type="text" name="pin" id="input" class="form-control" placeholder="inserir o seu pin">
						<div class="rodape">
							<button type="button" class="btn btn-default cancelar" data-dismiss="modal">Cancelar</button>

							<button type="submit" class="btn btn-primary criar"  id="confirmar">Confirmar</button>
						</div>
					<?php \yii\widgets\ActiveForm::end(); ?>
				</div>
				<div class="col-md-6 uservalidarfoto">
					<?php if($users->foto && strpos($users->foto, "uploads")!==false){?>
						<img src="../../../<?=$users->foto ?>" class="img-responsive" alt="Image"> 
					<?php } else{ ?>
						<img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt="Image"> 
						<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function validar(code,id,nome) {

		var codemodal=document.getElementById("codeB");
		codemodal.innerText=code;
		document.getElementById("idbilhete").value=id;
		document.getElementById("nomeBilh").innerText=nome;

	}



</script>

<?php $script = <<< JS

	$("#form").on('beforeSubmit',function(e) {
	

  var form=$(this);
  $.post(
      form.attr('action'),
      form.serialize()
  )

  .done(function(result) {

    if(result==1){

        $(form).trigger('reset');
        $.pjax.reload({container:'#bilhetes' });
        alert('sucesso');
        $('.modal').modal('hide');
    }

    else{
       alert('INsucesso');


    }
  }).fail(function() {

      console.log('server error');
  });

return false;
});

JS;
$this->registerJs($script);
?>
