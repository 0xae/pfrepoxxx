<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
?>

<?= $this->render('_form1', [
    'model' => $model,
    'userPermissions' => $userPermissions,
    '_dataPermissions' => $_dataPermissions
]) ?>
