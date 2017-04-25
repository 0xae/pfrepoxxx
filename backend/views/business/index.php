<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Businesses';
?>

<h1><?= Html::encode($this->title) ?></h1>
<?php if (Yii::$app->user->can('admin')): ?>
    <p>
        <?= Html::a('Create Business', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php endif; ?>

<?php foreach($dataProvider as $b): ?>

<div class="col-md-4">
    <div style="box-shadow: 0px 0px 2px rgba(0,0,0,.1);">
    <img src="<?php echo ($b->picture) ? $b->picture : 'img/logo.png' ?>" style="width:100%;height:160px"/>
    <div class="thumbnail" style="border:0px">
      <div class="caption">
        <h3 style="margin-top:0px">
            <?= Html::a($b->name, ['update','id'=>$b->id], ['style' => 'color: #333', 'class' => '']) ?>
        </h3>
      </div>
    </div>
    </div>
</div>

<?php endforeach; ?>



