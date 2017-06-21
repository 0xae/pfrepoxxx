<?php
$this->title = 'Analitics';
$user = Yii::$app->user;
$start = 0 ;
$end = 0 ;
if ($model->id) { 
    $range = $model->getRange();
    $start = $range[0];
    $end = $range[1];
}
?>

<input type="hidden" id="cashout_start" value="<?= $start; ?>">
<input type="hidden" id="cashout_end" value="<?= $end; ?>">

<div class="container-fluid pagebusiness  pageanalitics">
    <?php echo \Yii::$app->view->renderFile('@app/views/site/business_modal.php', []); ?>
    <?php echo $this->render('user_view', ['model' => $model, 'country'=>$country]); ?>
    <?php echo $this->render('producer_view', ['model' => $model, 'country'=>$country]); ?>
</div>


