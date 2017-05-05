<?php
use yii\helpers\Html;

$this->title = 'Dashboard';
$user = Yii::$app->user;

?>

<div class="container-fluid pagebusiness">
    <?php /* echo $this->render('business_modal', []); */ ?>
    <?php if ($user->can('admin') || $user->can('passafree_staff')): ?>
        <?php echo $this->render('staff_dashboard', []); ?>
    <?php endif; ?>
</div>

