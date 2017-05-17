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

DashboardAsset::register($this);
$user = Yii::$app->user;
$session = Yii::$app->session;
$userProfile = $user->identity;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html ng-app='passafree' lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<style type="text/css">
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.loading { position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 9999; background: url(static/img/loading.gif) center no-repeat #fff; }
</style>
<?php
$user = Yii::$app->user;
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

 <?php /*?>MOBILE MESSAGE<?php */?>
  <div class="hidecontent">
	  <span class="glyphicon glyphicon-warning-sign"></span>
	  <h2>INDISPONÍVEL NESTA RESOLUÇÃO</h2>
  </div>
  
  <div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href=<?= \yii\helpers\Url::to(['index'])?> class="logo" style="position: fixed;">
         <img src="static/img/logo_passafree_white.png" alt="">
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-fixed-top" role="navigation">
               <form class="col-md-4">
                    <div>
                        <span><i class="glyphicon glyphicon-search"></i></span>
                        <input type="text" class="form-control" placeholder="pesquisar marcas, eventos em Cabo Verde">
                    </div>
               </form>
                <!--
                   <div class="pageventbtngroup">
                        <a class="criar btn btn-primary" href="index.php?r=business/create"> New Business </a>
                    </div>
                -->
              <div class="navbar-custom-menu">
                    <ul class="list-unstyled">
                    </ul>
              </div>
        </nav>
    </header>

    <!-- fim de header -->
    <aside class="main-sidebar" ng-controller="UserController" style="position: fixed; box-shadow:1px 5px 2px rgba(0, 0, 0, 0.1); overflow-y: scroll; height:100%; scrollbar-base-color: #C0C0C0;scrollbar-base-color: #C0C0C0;scrollbar-3dlight-color: #C0C0C0;scrollbar-highlight-color: #C0C0C0;scrollbar-track-color: #EBEBEB;scrollbar-arrow-color: blackscrollbar-shadow-color: #C0C0C0;scrollbar-dark-shadow-color: #C0C0C0;">
      <section class="sidebar">
        <li class="perfil">
            <img src="static/img/logo.jpg" class="user-image" alt="User Image" style="width: 100%;">
        </li>
        <li class="nome_user text-center">
			<div class="nomeuser">
              <?php echo $user->identity->username; ?>
            </div>
            <?php if ($user->can('business')): ?>
                <small> <?= $session->get('business_name'); ?> </small>
            <?php else: ?>
                <small> </small> 
            <?php endif; ?>
            <a class="btn btn-default edit_acount text-center" href=<?= \yii\helpers\Url::to(['site/update'])?>>
                <span>Editar Conta</span> 
                <i class="fa fa-pencil"></i>
            </a>
        </li>
        <ul class="list-unstyled notification">
          <li><a href="#"><i class="glyphicon glyphicon-globe"></i></a></li>
          <?php if ($user->can('business')): ?>
                <li>
                    <span class="badge" ng-if="newMessages" style="position: absolute;margin: -8px 0 0 -13px;z-index:10;background: #f00;">
                        {{ newMessages }}
                    </span>
                    <a href="./index.php?r=chat/unread" ng-if="newMessages"> <i class="glyphicon glyphicon-comment"></i> </a>
                    <a href="./index.php?r=chat" ng-if="!newMessages"> <i class="glyphicon glyphicon-comment"></i> </a>
                </li>
          <?php endif; ?>
          <li class="dropdown sair">
            <a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
              <form action=<?= \yii\helpers\Url::to(['site/logout'])?> method="post">
              	<button type="submit" class="btn btn-primary">Sair</button>
              </form>
            </ul>
          </li>
        </ul>
          <!-- Sidebar user panel -->
          <ul class="sidebar-menu text-center">
            <li class="<?php if (Yii::$app->controller->id == 'site'){ echo 'active'; } ?> treeview">
                  <a href="index.php"><span>Overview</span></a>
            </li>

            <?php if ($user->can('admin') || $user->can('passafree_staff')): ?>
                <li class="<?php if (Yii::$app->controller->id == 'business'){ echo 'active'; } ?> treeview">
                      <a href="index.php?r=business">
                        <span>Business</span> <!--i class="fa fa-angle-left pull-right"></i-->
                      </a>
                </li>
            <?php elseif ($user->can('business') && $session->get('business')): ?>
                <li class="<?php if (Yii::$app->controller->id == 'business'){ echo 'active'; } ?> treeview">
                    <a href="index.php?r=business/update&id=<?= $session->get('business'); ?>">
                        <span>My Business</span> <!--i class="fa fa-angle-left pull-right"></i-->
                      </a>
                </li>
            <?php endif; ?>

            <li class="<?php if (Yii::$app->controller->id == 'marca'){ echo 'active'; } ?> treeview">
                  <?php if (($isAdmin=$user->can('admin')) || (($isBiz=$user->can('business')) && $session->has('business'))): ?>
                      <a href="index.php?r=marca">
                        <?php if ($isAdmin): ?>
                            <span>Producer</span> <!--i class="fa fa-angle-left pull-right"></i-->
                        <?php elseif ($isBiz): ?>
                            <span>My Producers</span> <!--i class="fa fa-angle-left pull-right"></i-->
                        <?php endif; ?>
                      </a>
                  <?php endif; ?>
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

            <?php if (Yii::$app->user->can('admin')): ?>
                    <li class="<?php if (Yii::$app->controller->id == 'settings'){ echo 'active'; } ?> treeview">
                      <a href="index.php?r=settings/index">
                        <span>Settings</span> <!--i class="fa fa-angle-left pull-right"></i-->
                      </a>
                    </li>
            <?php endif; ?>
            
            <?php if (Yii::$app->user->can('admin')): ?>
            <li class="<?php if (Yii::$app->controller->id == 'settings'){ echo 'active'; } ?> treeview">
                <a href="index.php?r=settings/location">
                <span>Location</span> <!--i class="fa fa-angle-left pull-right"></i-->
                </a>
            </li>
            <?php endif; ?>
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
