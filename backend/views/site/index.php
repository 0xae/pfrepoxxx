<?php
use yii\helpers\Html;

$this->title = 'Dashboard';
$user = Yii::$app->user;

?>

<div class="container-fluid pagebusiness">
    <?php /* echo $this->render('business_modal', []); */ ?>
    <?php echo $this->render('staff_dashboard', []); ?>
</div>

