<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Evento */

$this->title = 'Criar Evento';
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-create">

    <h2 style="color:#565656;"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        '_dataIlhas' => $_dataIlhas,
        '_dataFiltros' => $_dataFiltros,
        '_dataTipoevento' => $_dataTipoevento,
    ]) ?>

</div>
