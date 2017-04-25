<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Business */

$this->title = 'Create Business';
/*
$this->params['breadcrumbs'][] = ['label' => 'Businesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 */
?>

<div class="business-create">
    <?= $this->render('_form', [
        'model' => $model,
        'producerForm' => $producerForm,
        'producers' => [],
        '_dataCountries' => $_dataCountries,
        '_dataUsers' => $_dataUsers,
        '_dataProducers' => $_dataProducers
    ]) ?>

</div>
