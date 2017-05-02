<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Marca */

$this->title = ' ' . $model->nome;
?>
<div class="marca-update">

<?php
    echo $this->render('_form', [
        'model' => $model,
        'newUser' => $newUser,
        'newProdutor' => $newProdutor,
        '_dataBusiness' => $_dataBusiness
    ]);
?>
    
</div>
