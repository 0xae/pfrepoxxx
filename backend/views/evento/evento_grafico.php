<?php
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

$bilhetesLabel = ArrayHelper::map($_dataBilhetes, 'idbilhete', 'nome_bilhete');
$k=0;
$this->registerJs("
    $(document).ready(function () {
        renderGraph('HC_7');
    });
");
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

            <div class="tab-content" style="padding: 10px">
                <?php foreach ($_dataBilhetes as $b): ?>
                    <div role="tabpanel" class="tab-pane fade <? if ($b->idbilhete==$k) echo 'active'; ?> in" id="graph_<?= $b->idbilhete ?>">
                        <div class="row">
                            <div class="col-md-5">
                                <?php
                                    $layout3 = '
                                    <span class="input-group-addon">From </span>
                                    {input1}
                                    <span class="input-group-addon">To </span>
                                    {input2}
                                    <span class="input-group-addon kv-date-remove">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </span>';
                                     
                                    echo DatePicker::widget([
                                        'type' => DatePicker::TYPE_RANGE,
                                        'id' => "HC_{$b->idbilhete}_start_date",
                                        'name' => 'start_date',
                                        'name2' => 'end_date',
                                        'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
                                        'options' => [
                                            'class' => 'show'
                                        ],
                                        'options2' => [
                                            'id' => "HC_{$b->idbilhete}_end_date"
                                        ],
                                        'layout' => $layout3,
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ]);
                                ?>
                            </div>
                            <div class="col-md-12">
                                <div id="HC_<?= $b->idbilhete ?>"></div>
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

