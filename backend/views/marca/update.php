<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Marca */

$this->title = ' ' . $model->nome;
?>
<div class="marca-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_form', ['model' => $model, '_dataBusiness' => $_dataBusiness]) ?>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_criar_user">
      Criar User
    </button>
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_criar_produtor">
      Criar Produtor
    </button>

    <?php echo $this->render('create_userprodutor.php', ['newUser' => $newUser]); ?>
    <?php echo $this->render('create_produtor.php', []); ?>
</div>
