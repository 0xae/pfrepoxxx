<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Tipoevento */

$this->title = 'Criar Tipo Evento';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoevento-create">

    <h2 style="color:#565656;"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
