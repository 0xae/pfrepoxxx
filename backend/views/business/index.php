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

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'created_at:datetime',
        'updated_at:datetime',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>

