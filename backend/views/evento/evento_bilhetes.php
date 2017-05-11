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
            <li role="presentation" <?php if (!$k){ $k=$id; echo 'class="active"'; } ?>>
                    <a href="#bil_<?= $id ?>" 
                       aria-controls="home" role="tab" 
                       data-toggle="tab" aria-expanded="false"><?= $label ?></a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content">
        <?php foreach ($_dataBilhetes as $b): ?>
            <div role="tabpanel" class="tab-pane fade <?php if ($b->idbilhete==$k) echo 'active'; ?> in" id="bil_<?= $b->idbilhete ?>">
                <div class="row">
                    <div class="col-md-6">
                        <h2 style="color: #313541; font-weight: 700;">Descrição</h2>
                        <p style="font-size: 17px;color: #313541;"> <?= $b->descricao_bilhete; ?> </p>
                        <h2 style="color: #313541; font-weight: 700;">Business</h2>
                        <h1 style="color: #009447; font-weight: 700; margin-top: -10px;"><?= $b->business_percent; ?>%</h1>
                        <h2 style="color: #313541; font-weight: 700;">Preço</h2>
                        <h1 style="color: #009447; font-weight: 700; margin-top: -10px;"><?= $b->preco; ?>ECV</h1>
                    </div>

                    <div class="col-md-3 text-center"><!-- <br> --><br><br>
                        <div class="fundo_circle">
                            <div class="c100 p50">
                                <span>68% <br>1500</span>
                                <div class="slice">
                                    <div class="bar"></div>
                                    <div class="fill"></div>
                                </div>
                            </div>
                        </div>
                        <span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Entrada</span>
                    </div>

                    <div class="col-md-3 text-center"><!-- <br> --><br><br>
                        <div class="fundo_circle">
                            <div class="c100 p50">
                                <span>68%<br><small>5000</small></span>
                                <div class="slice">
                                    <div class="bar"></div>
                                    <div class="fill"></div>
                                </div>
                            </div>
                        </div>
                        <span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Stock</span>
                    </div>
                </div>
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
