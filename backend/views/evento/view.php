<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<div class="" style="padding: 0px 55px;margin:0px;">
    <div class="container-fluid info_evento_evento">
        <h4><div class="borderlefttitlo"></div><span style="margin-left: 20px; font-size: 20px; color: #009447; font-weight: 700; font-family: 'DINBold'; text-transform: uppercase;">Info Evento</span></h4>
        <?php echo $this->render('evento_info', ['model' => $model]); ?>
    </div>

    <div class="container-fluid info_evento_evento">
        <h4><div class="borderlefttitlo"></div><span style="margin-left: 20px; font-size: 20px; color: #009447; font-weight: 700; font-family: 'DINBold'; text-transform: uppercase;">Info Bilhetes</span></h4>
        <?php echo $this->render('evento_bilhetes', ['_dataBilhetes' => $_dataBilhetes]); ?>
    </div>
</div>


