<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Business */

$this->title = 'Business';
?>

<?= $this->render('_form', [
    'model' => $model,
    'paymentChannels' => $paymentChannels,
    '_dataCountries' => $_dataCountries,
    '_dataUsers' => $_dataUsers,
    '_dataProducers' => $_dataProducers
]) ?>
