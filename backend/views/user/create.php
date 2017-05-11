<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

$this->title = 'Registrar Utilizador';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 
    echo $this->render('_form1', [
        'model' => $model,
        'userPermissions' => $userPermissions,
        '_dataPermissions' => $_dataPermissions,
        '_dataCountry' => $_dataCountry,
    ]);
?>


