<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Businesses';
?>

<div class="container-fluid pagebusiness">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Bussiness</span></h4>
			</div>
		</div>
	</div>
	<div class="col-md-12 contentbox">
        <?php foreach ($data as $d): ?>
            <div class="col-md-3 boxconteinerbus">
            	<a href="index.php?r=business/update&id=<?= $d->id ?>">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12 imgbussinessbox">
                                <img class="img-responsive" src="../../img/Unitel_img.jpg" alt="" title="">
                            </div>
                            <div class="col-md-12 descbussinessbox">
                            	<span><?php echo $d->name; ?></span>
                                <span><?php echo $d->getCountry()->one()->name; ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

        <?php if (Yii::$app->user->can('admin') || Yii::$app->user->can('passafree_staff')): ?>
            <div class="col-md-3">
                <a href="index.php?r=business/create">
                    <div class="panel panel-default addbusiness">
                        <div class="panel-body plusicon">+</div>
                    </div>
                </a>
            </div>
        <?php endif; ?>
	</div>
</div>
