<?php
use yii\helpers\Html;

$this->title = 'Dashboard';
$user = Yii::$app->user;

?>

<div class="container-fluid pagebusiness overview-page">
    <?php /* echo $this->render('business_modal', []); */ ?>
    <?php echo $this->render('staff_dashboard', []); ?>
</div>

