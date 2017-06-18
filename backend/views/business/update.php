<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Business */

?>

<div class="business-update">
    <?= $this->render('_form', [
        'model' => $model,
        'producers' => $producers,
        '_dataUsers' => $_dataUsers,
        'paymentChannels' => $paymentChannels,
        '_dataCountries' => $_dataCountries,
        '_dataPermissions' => $_dataPermissions,
        '_dataAccess' => $_dataAccess
    ]) ?>
</div>
