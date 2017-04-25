<?php

/* @var $this \yii\web\View */
/* @var $content string */


use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\sidenav\SideNav;
use kartik\date\DatePicker;
use backend\models\Produtor;

//AppAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">


<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
</head>

<body class="skin-blue ">
<?php $this->beginBody() ?>

<?php if(!Yii::$app->user->isGuest){?>
                

<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href=<?= \yii\helpers\Url::to(['index'])?> class="logo" style="position: fixed;">
         <img src="<?= Yii::$app->request->baseUrl ?>/img/logo_passafree_white.png" alt="">
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-fixed-top" role="navigation"><!-- navbar-static-top -->
          <!-- Sidebar toggle button-->
          <!--a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a-->
            <ul class="list-unstyled">              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="criar_evento text-center" id="btncriaEventos">
                <a href="#modal-id" id="criaEventos" data-toggle="modal">Criar Evento</a>
              </li>
                <?php 
                  
                  /*if(!Yii::$app->user->isGuest){
                    echo Html::beginForm(['site/logout'], 'post');
                    echo Html::submitButton('Sair', ['class' => 'btn btn-primary bt sair']);
                    echo Html::endForm(); 
                  }*/
                  ?>
             
            </ul>

        </nav>
    </header>

      <!-- fim de header -->
    <aside class="main-sidebar" style="position: fixed; box-shadow:1px 5px 2px rgba(0, 0, 0, 0.1);">
      <section class="sidebar">
        <div class="perfil">
        
            <?php 
                if(!Yii::$app->user->isGuest) 
                {
                    $prod = Produtor::find()->where(['idprodutor'=>Yii::$app->user->identity->id])->one();
                    
                    if( $prod && file_exists($prod->foto)){
                        $fotoUser = $prod->foto;
                    }
                    else{ 
                      $fotoUser="img/userbi.jpg";
                    }
                }
              ?>
        
                <img src="../../../<?=Yii::$app->request->baseUrl.'/'.$fotoUser ?>" class="user-image" alt="User Image" style="width: 100%;"> 
                  
        </div>
        <li class="nome_user text-center">
			<div class="nomeuser"> 
			  <?php 
				if(!Yii::$app->user->isGuest) 
				{
					$prod=Produtor::find()->where(['idprodutor'=>Yii::$app->user->identity->id])->one();
					if($prod &&  $prod->nome!='')
						echo $prod->nome; 
					else echo Yii::$app->user->identity->email;


				}

			  ?>
			</div>
            <small>1221 Seguidores</small>
            <a class="btn btn-default edit_acount text-center" href=<?= \yii\helpers\Url::to(['site/update'])?>>
            	<span>Editar Conta</span><i class="fa fa-pencil"></i>
            </a>
        </li>
        <ul class="list-unstyled notification">
          <li><a href="#"><i class="fa fa-globe"></i></a></li>
          <li><a href="#"><i class="fa fa-comments"></i></a></li>
          <li class="dropdown sair">
            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-cog"></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
              <form action=<?= \yii\helpers\Url::to(['site/logout'])?> method="post">
              <input name="_csrf" value="OE9BLWtBeGdVOSp/DBsBEgslL0YAcAleaBwtYT4ZNh1bAxFeL3MiBA==" type="hidden">
              <button type="submit" class="btn btn-primary">Sair</button>
              </form>
            </ul>
          </li>
        </ul>
        <!-- sidebar: style can be found in sidebar.less -->
        

<?php $pag = isset($_GET['r']) ?>

          <!-- Sidebar user panel -->
          <ul class="sidebar-menu text-center">
            <li class="<?php if($pag == ""){ echo 'active'; } ?> treeview">
              <a href=<?= \yii\helpers\Url::to(['index'])?>><span>Painel</span></a>
            </li>

            <li class="treeview">
             <!--  <a href="index.php?r=marca"><span>painel</span></a> -->
            </li>
            
            <li class=" <?php if($pag == "history"){ echo 'active'; } ?> treeview">
              <a href=<?= \yii\helpers\Url::to(['evento/history'])?>> <span>Histórico</span></a>
            </li>

            <li class="treeview">
            <!--  <a href="#"><span>painel</span> </a>-->
              
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

  <?php
}

 ?>
  <div class="<?php if(!Yii::$app->user->isGuest) echo 'content-wrapper'; ?> ">

      <!--section class="content box_cont"></section-->
          <?= Alert::widget() ?>
          <?= $content ?>
      
  </div>
</div><!-- fim de wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


    </div><!-- fim de container -->

<?php

$scrip=<<<JS

$('#criaEventos').click(function() {

   $('#titulo-modal').text('Criar Eventos');
$("#modal").modal('show')
            .find(".modal-body")
            .load($(this).attr('href'));
})
JS;


$this->registerJs($scrip);
?>
