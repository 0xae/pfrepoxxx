<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\LoginAsset;
use frontend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;

//AppAsset::register($this);
LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<?php if(!Yii::$app->user->isGuest){?>   

  <?php } ?>
    <div class="<?php if(!Yii::$app->user->isGuest) echo 'content-wrapper'; ?> ">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


