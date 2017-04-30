<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Marca */

$this->title = ' ' . $model->nome;
?>
<div class="marca-update">
    <?php echo $this->render('_form1', ['model' => $model, '_dataBusiness' => $_dataBusiness]) ?>
    <h1>User</h1>
   <p> <?php echo $newUser->username; ?>  </p>
   <p> <?php echo $newUser->email; ?> </p>

    <h1>Produtor</h1> 
   <p> <?php echo $newProdutor->nome; ?>  </p>
   <p> <?php echo $newProdutor->public_email; ?> </p>
    
</div>
