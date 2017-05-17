<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PaymentChannel */

$this->title = 'Update Payment Channel: ' . ' ' . $model->name;
?>

<?= $this->render('_form', ['model' => $model]) ?>

