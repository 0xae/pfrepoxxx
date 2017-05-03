<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'percentagem_bilhete',
            'preco_min',
            'preco_max',
            'nome_regra',
            // 'stockMin',
            // 'stockMax',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
