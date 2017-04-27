<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Business */

?>

<div class="business-update">
    <?= $this->render('_form', [
        'model' => $model,
        '_dataUsers' => $_dataUsers,
        '_dataCountries' => $_dataCountries,
    ]) ?>
</div>
