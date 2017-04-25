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
    <link rel="stylesheet" href="css/font-awesome.min.css">


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
        <a href=<?= \yii\helpers\Url::to(['index'])?> class="logo" style="position: fixed;">
         <img src="<?= Yii::$app->request->baseUrl ?>/img/logo_passafree_white.png" alt="">
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-fixed-top" role="navigation">

          <div class="navbar-custom-menu">
            <ul class="list-unstyled">
              <li style="padding-right: 30px;">
                <form action="/passa_free/admin/index.php?r=site%2Flogout" method="post">
                  <input name="_csrf" value="S1F0czA2M0QiFTBEdF9DCzFhQTF2W0ARAxc4R1Z1Qg8xBSIVYFNwIA==" type="hidden">
                  <button type="submit" class="btn btn-primary bt sair">
                  <i class="fa fa-sign-out" aria-hidden="true"></i> Sair</button>
                </form>
              </li>
              <li style="padding-right: 30px;">
                <a href="#"></a>
              </li>
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
            </span>
        </li>
        <br> 
          <!-- Sidebar user panel -->
          <ul class="sidebar-menu text-center">
            <li class="active treeview">
              <a href="index.php"><span>Home</span></a>
            </li>

            <li class="treeview">
              <a href="index.php?r=marca">
                <span>Marca</span> <!--i class="fa fa-angle-left pull-right"></i-->
              </a>
            </li>
            
            <li class="treeview">
              <a href="index.php?r=user-produtor">
                <span>Produtor</span> <!--i class="fa fa-angle-left pull-right"></i-->
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <span>Evento</span>
              </a>
            </li>

            <li class="treeview">
              <a href="index.php?r=user">
                <span>User</span> <!--i class="fa fa-angle-left pull-right"></i-->
              </a>
            </li>
            
            <li class="treeview">
              <a href="index.php?r=role">
                <span>Permissões</span> <!--i class="fa fa-angle-left pull-right"></i-->
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
        <?php /*= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) */?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>
</div><!-- fim de wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


