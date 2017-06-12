<?php
use yii\helpers\Html;
use backend\models\User;

$this->title = 'Dashboard';
$user = Yii::$app->user;
$authUser = User::getAppUser();

?>

<div class="container-fluid pagebusiness overview-page">
    <?php /* echo $this->render('business_modal', []); */ ?>
    <?php echo $this->render('staff_dashboard', []); ?>
</div>

