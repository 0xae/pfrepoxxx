<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserProdutor */

$this->title = 'Update User Produtor: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Produtors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-produtor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
