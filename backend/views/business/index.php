<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Businesses';
?>

<div class="container-fluid pagebusiness page_bussiness">
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Business</span></h4>
                <?php if (Yii::$app->user->can('admin') || Yii::$app->user->can('passafree_staff')): ?>
                    <div class="pageventbtngroup">
                        <a class="criar btn btn-primary" href="index.php?r=business/create"> New Business </a>
                    </div>
                <?php endif; ?>
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
                                <img class="img-responsive" src="../passafree_uploads/<?= $d->picture ?>" alt="" title="">
                            </div>
                            <div class="col-md-12 descbussinessbox">
                            	<span><?php echo $d->name; ?></span>
                                <span><?php 
                                        $c=$d->getCountry();
                                        if ($c) { echo $c->name; } 
                                ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

	</div>
</div>
