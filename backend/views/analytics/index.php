<?php
$this->title = 'Analitics';
$user = Yii::$app->user;
?>

<div class="container-fluid pagebusiness  pageanalitics">
    <?php echo \Yii::$app->view->renderFile('@app/views/site/business_modal.php', []); ?>
    <?php echo $this->render('user_view', ['model' => $model, 'country'=>$country]); ?>
    <?php echo $this->render('producer_view', ['model' => $model, 'country'=>$country]); ?>
</div>
