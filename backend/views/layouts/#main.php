<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\sidenav\SideNav;

//AppAsset::register($this);
DashboardAsset::register($this);
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

<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<?php if(!Yii::$app->user->isGuest){?>
                

<div class="wrapper">
    <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo" style="position: fixed;">
         <img src="img/logo_passafree_white.png" alt="">
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-fixed-top" role="navigation"><!-- navbar-static-top -->
          <!-- Sidebar toggle button-->
          <!--a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a-->

          <div class="navbar-custom-menu">
            <ul class="list-unstyled">
                <?php 
                  
                  if(!Yii::$app->user->isGuest){
                    echo Html::beginForm(['site/logout'], 'post');
                    echo Html::submitButton('Sair', ['class' => 'btn btn-primary bt sair']);
                    echo Html::endForm(); 
                  }
                  ?>
             
            </ul>
          </div>

        </nav>
    </header>

      <!-- fim de header -->
    <aside class="main-sidebar" style="position: fixed; box-shadow:1px 5px 2px rgba(0, 0, 0, 0.1);">
      <section class="sidebar">
        <li class="perfil">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="img/logo.jpg" class="user-image" alt="User Image" style="width: 100%;">
          </a>
        </li>
        <li class="nome_user text-center">
          <span> 
              <?php 
                if(!Yii::$app->user->isGuest) 
                  echo Yii::$app->user->identity->username; 
              ?>
            </span><br>
        </li>
        <br>
        <!-- sidebar: style can be found in sidebar.less -->
        
          <!-- Sidebar user panel -->
          <ul class="sidebar-menu text-center">
            <li class="active treeview">
              <a href="index.php"><span>Home</span></a>
            </li>

            <li class="treeview">
              <a href="index.php?r=marca"><span>painel</span></a>
            </li>
            
            <li class="treeview">
              <a href="index.php?r=user-produtor"><span>Histórico</span></a>
            </li>

            <li class="treeview">
              <a href="#"><span>painel</span>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

  <?php
}

 ?>
<div class="<?php if(!Yii::$app->user->isGuest) echo 'content-wrapper'; ?> ">

    <section class="content box_cont">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>
</div><!-- fim de wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


