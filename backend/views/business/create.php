<?php
use yii\helpers\Html;
$this->title = 'Business';
?>

<?= $this->render('_form', [
    'model' => $model,
    'paymentChannels' => $paymentChannels,
    '_dataCountries' => $_dataCountries,
    '_dataUsers' => $_dataUsers,
    '_dataProducers' => $_dataProducers,
    '_dataPermissions' => []
]) ?>
