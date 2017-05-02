<?php

use yii\helpers\ArrayHelper;
$bilhetesLabel = ArrayHelper::map($_dataBilhetes, 'idbilhete', 'nome_bilhete');
$k=0;
?>

<div class="col-md-12 titulosection">
<div class="detail_bilhete">
<div role="tabpanel">
    <ul class="nav nav-tabs bilhte" role="tablist">
        <?php foreach ($bilhetesLabel as $id=>$label): ?>
        <li role="presentation" <? if (!$k){ $k=$id; echo 'class="active"'; }?>>
                <a href="#graph_<?= $id ?>" 
                   aria-controls="home" role="tab" 
                   data-toggle="tab" aria-expanded="false"><?= $label ?></a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content">
        <?php foreach ($_dataBilhetes as $b): ?>
            <div role="tabpanel" class="tab-pane fade <? if ($b->idbilhete==$k) echo 'active'; ?> in" id="graph_<?= $b->idbilhete ?>">
                <h1> <?= $b->nome_bilhete; ?> </h1>
            </div>
        <?php endforeach; ?>
    <!-- .tab-content -->
    </div>

<!-- role="tabpanel" -->
</div> 

<!-- .detail_bilhete -->
</div>

<!-- .titulosection -->
</div>
