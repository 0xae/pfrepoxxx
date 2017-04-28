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

AppAsset::register($this);
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
<style type="text/css">
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.loading {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url(img/loading.gif) center no-repeat #fff;
}
</style>
<?php
$script=<<<JS

$(window).load(function() {
  $(".loading").fadeOut("slow");;
});
JS;

$this->registerJS($script);
?>
<?php $this->head() ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="loading"></div>

<?php if(!Yii::$app->user->isGuest): ?>

  <div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href=<?= \yii\helpers\Url::to(['index'])?> class="logo" style="position: fixed;">
         <img src="<?= Yii::$app->request->baseUrl ?>/img/logo_passafree_white.png" alt="">
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-fixed-top" role="navigation">
               <form class="col-md-4">
                    <div>
                        <span><i class="glyphicon glyphicon-search"></i></span>
                        <input type="text" class="form-control" placeholder="pesquisar marcas, eventos em Cabo Verde">
                    </div>
               </form>
              <div class="navbar-custom-menu">
                    <ul class="list-unstyled">
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
                if(!Yii::$app->user->isGuest) {
                  echo Yii::$app->user->identity->username;
                }
              ?>
            </span>
        </li>
        <br>
          <!-- Sidebar user panel -->
          <ul class="sidebar-menu text-center">
            <li class="<?php if (Yii::$app->controller->id == 'site'){ echo 'active'; } ?> treeview">
              <a href="index.php"><span>Overview</span></a>
            </li>

            <li class="<?php if (Yii::$app->controller->id == 'business'){ echo 'active'; } ?> treeview">
              <a href="index.php?r=business">
                <span>Business</span> <!--i class="fa fa-angle-left pull-right"></i-->
              </a>
            </li>

            <li class="<?php if (Yii::$app->controller->id == 'marca'){ echo 'active'; } ?> treeview">
              <a href="index.php?r=marca">
                <span>Produtor</span> <!--i class="fa fa-angle-left pull-right"></i-->
              </a>
            </li>

            <li class="<?php if (Yii::$app->controller->id == 'accounting'){ echo 'active'; } ?> treeview">
              <a href="index.php?r=accounting">
                <span>Accounting</span> <!--i class="fa fa-angle-left pull-right"></i-->
              </a>
            </li>

            <li class="<?php if (Yii::$app->controller->id == 'analytics'){ echo 'active'; } ?> treeview">
              <a href="index.php?r=analytics">
                <span>Analytics</span> <!--i class="fa fa-angle-left pull-right"></i-->
              </a>
            </li>

            <li class="<?php if (Yii::$app->controller->id == 'settings'){ echo 'active'; } ?> treeview">
              <a href="index.php?r=user">
                <span>Settings</span> <!--i class="fa fa-angle-left pull-right"></i-->
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

<?php endif; ?>

<div class="<?php if(!Yii::$app->user->isGuest) echo 'content-wrapper'; ?> ">
    <section class="content box_cont">
        <?= $content ?>
    </section>
</div>
</div><!-- fim de wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php /*?>POPUP CRIAR USER<?php */?>
<div class="modal fade popupcriarbilhete" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Criar User</h4>
            </div>
			<div class="modal-body" style="padding-bottom: 0">
                <div class="row">
                    <div class="col-md-6 infoput" style="padding:0 10px">

                    </div>

                    <div class="col-md-6" style="padding:0 0 0 10px">

                    </div>
                </div>
            </div>
            <div class="modal-footer rodape">
                <button class="btn btn-success criar btn-primary criar">Criar</button>
            </div>
        </div>
    </div>
</div>
<?php /*?>POPUP STATEMENTS<?php */?>
<div class="modal fade popupcriarbilhete" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Criar User</h4>
            </div>
			<div class="modal-body" style="padding-bottom: 0">
                <div class="row">
                    <div class="col-md-6 infoput" style="padding:0 10px">

                    </div>

                    <div class="col-md-6" style="padding:0 0 0 10px">

                    </div>
                </div>
            </div>
            <div class="modal-footer rodape">
                <button class="btn btn-success criar btn-primary criar">Criar</button>
            </div>
        </div>
    </div>
</div>
