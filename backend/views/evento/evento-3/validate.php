<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Evento */
use yii\widgets\LinkPager;
$this->title = 'Validar Bilhete';
//$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php include_once(__DIR__.'/../site/create_popup.php') ?>
<div class="container-fluid">
    <div class="row validate_mask Mask">
		<a class="btn btn-default cancelar" href="<?=\yii\helpers\Url::to(['view','id'=>$_GET['idevento']])?>">Voltar</a>
    </div>
</div>
<div class="pagina_geral">
<div class="container-fluid validade_box">
    <?php if($users || Yii::$app->mycomponent->existUtilizador($_GET['idevento'])):?>
    <!--inicio de eventos proximos-->
	<div class="row">
		<div class="col-md-12 titulosection" style="margin-bottom: 20px;">

			<h4 style="margin: 0px; padding: 0px 14px;"><div class="borderlefttitlo"></div><span style="margin-left: 20px; font-size: 20px; color: #009447; font-weight: 700; font-family: 'DINBold'; text-transform: uppercase;">Pesquisar</span></h4>

			<!-- <div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Pesquisar</span></h4>
			</div> -->
		</div>
	</div>

<?php $form = \yii\widgets\ActiveForm::begin(); ?>
    <div class="input-group serach_user" >
  		<input type="text" class="form-control"  name="pesq" placeholder="nome, email, data de nascimento" aria-describedby="basic-addon2">
	  	<span class="input-group-addon">
	  		<button type="submit" value="" id="basic-addon2" class="input-group-addon"><i class="fa fa-search"></i></button>
	  	</span>
	</div>
<?php \yii\widgets\ActiveForm::end(); ?>
	<div class="row clienteinner">
		<?php // \yii\widgets\Pjax::begin()?>
			<?php if($users){
			foreach ($users as $us):?>

					<div class="col-md-4 text-center users" nome="<?= $us->nome?>" email="<?= $us->email?>"
						 dataNascimento="<?= $us->data_nascimento?>"  bi="12345">
						<div class="fundo_user_bilh">
							<div class="user_bi">
							<a href="<?= \yii\helpers\Url::to(['uservalidate','iduser'=>$us->idutilizador,'idevento'=>$_GET['idevento']])?>">
								<?php if($us->foto && strpos($us->foto, "uploads")!==false){?>
                                    <img src="../../../<?=Yii::$app->request->baseUrl.'/'.$us->foto ?>" class="img-responsive" alt=""> 
                                <?php } else{ ?>
                                    <img src="<?= Yii::$app->request->baseUrl ?>/img/userbi.jpg" class="img-responsive" alt=""> 
                                <?php }?>
								</a>
							</div>
							<a href="<?= \yii\helpers\Url::to(['uservalidate','iduser'=>$us->idutilizador,'idevento'=>$_GET['idevento']])?>"><h2><?= $us->nome?></h2>
							</a>
							<small><?= $us->email?></small>
							<span><i class="fa fa-ticket"></i><?= Yii::$app->mycomponent->getQuantidadeBilhete($us->idutilizador,$_GET['idevento'])?></span>
						</div>


					</div>

			<?php endforeach;}?>
			<div class="paginatiogerel">
				<?php echo LinkPager::widget([
					'pagination' => $pag,
				]);
			?>
			</div>
		<?php // \yii\widgets\Pjax::end();?>
        <?php endif;?>
        <?php if(!$users && !Yii::$app->mycomponent->existUtilizador($_GET['idevento'])):?>
            <h4>Nenhum utilizador comprou ainda os bilhetes desse evento!</h4>
        <?php endif;?>
	</div>
</div>
</div>


