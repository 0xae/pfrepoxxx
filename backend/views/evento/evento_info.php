<br>
<div class="row">
    <div class="col-md-12">
        <div class="destail_evento">
            <h1><?= $model->nome; ?></h1>
            <span>
                <div class="assetpf icon-date"></div>
                <i class="fa fa-calendar" style="margin-right: 10px;"></i>
                <?= date( 'd',strtotime($model->data) ) //dia?>
                <?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', strtotime($model->data) )) //mes?>
                de <?= date( 'Y', strtotime($model->data) ) //ano?>
            </span><br>
            <span>
            <div class="assetpf icon-local"></div>
            <i class="fa fa-map-marker" style="font-size: 30px; margin-right: 10px; margin-top: 5px;"></i> <?=$model->local; //Local?>,
                <?= $model->ilha //ilha?></span><br><br>
            <div class="descricao_text" style="width: 50%;color:#fff;">
                <p><?= $model->descricao?></p>
            </div>
        </div>
    </div>
</div>
