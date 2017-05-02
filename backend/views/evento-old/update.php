<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Evento */

$this->title = ' ' . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->nome]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="evento-update">

    <h2 style="color:#565656;"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        '_dataIlhas' => $_dataIlhas,
        '_dataFiltros' => $_dataFiltros,
        '_dataTipoevento' => $_dataTipoevento,
    ]) ?>

</div>
