<?php
use yii\helpers\Html;
$this->title = 'Update Payment Channel: ' . ' ' . $model->name;
?>

<?= $this->render('_form', ['model' => $model, 'cards' => $cards]) ?>

