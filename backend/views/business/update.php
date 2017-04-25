<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Business */

?>

<div class="business-update">
    <?= $this->render('_form', [
        'model' => $model,
        'producerForm' => $producerForm,
        'producers' => $producers,
        '_dataUsers' => $_dataUsers,
        '_dataCountries' => $_dataCountries,
        '_dataProducers' => $_dataProducers,
    ]) ?>
</div>
