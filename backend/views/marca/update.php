<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Marca */

$this->title = ' ' . $model->nome;
?>
<div class="marca-update">
    <?php /*
    <?php if ($newProdutor->idprodutor): ?>
        <button type="button" class="btn btn-sm btn-primary btn-lg" data-toggle="modal" data-target="#modal_criar_produtor">
          Editar Produtor
        </button>
    <?php else: ?>
        <button type="button" class="btn btn-sm btn-primary btn-lg" data-toggle="modal" data-target="#modal_criar_user">
          Associar responsavel
        </button>
    <?php endif; ?>
    */ ?>

    <?php echo $this->render('_form1', ['model' => $model, '_dataBusiness' => $_dataBusiness]) ?>

    <div>
        <input id="producer_id" type="hidden" value="<?php echo $newProdutor->idprodutor; ?>" />
        <input id="producer_state" type="hidden" value="<?php echo $newProdutor->estado; ?>" />
        <?php echo $this->render('create_userprodutor.php', ['newUser' => $newUser, 'marca' => $model]); ?>
        <?php echo $this->render('create_produtor.php', ['newProdutor' => $newProdutor, 'marca' => $model]); ?>
    </div>
</div>
