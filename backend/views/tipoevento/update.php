<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tipoevento */

$this->title = 'Update Tipoevento: ' . ' ' . $model->idtipoevento;
$this->params['breadcrumbs'][] = ['label' => 'Tipoeventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtipoevento, 'url' => ['view', 'id' => $model->idtipoevento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipoevento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
