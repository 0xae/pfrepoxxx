<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use miloschuman\highcharts\HighchartsAsset; 
HighchartsAsset::register($this)
->withScripts(['highstock', 'modules/drilldown']);
?>
<div class="row">

<div class="col-md-12 col-push-left">
    <div class="col-md-5" style="margin-top: 18px;">
        <div class="media">
              <div class="media-left">
                    <a href="#">
                      <img src="img/logo.png" style="width:90px;display:inline" alt="..." class="img-thumbnail media-object" />
                    </a>
              </div>
              <div class="media-body">
                    <h4 style="margin-top: 5px; margin-bottom: -2px;" class="media-heading">Passa Free</h4>
                    <h3 style="display: inline"><small>passa.free@gmail.com</small></h3><br/>
              </div>
        </div>
    </div>

    <div class="col-md-7" class="pull-right">
        <div class="pull-right">
            <h3>Current Period </h3>
            <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span id="date_range_label"> July 02 - Agust 01 2016 </span> <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="width: 500px">
                    <li>
                        <div class="row" style="padding: 9px">
                            <div class="col-md-8">
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
                                        'id' => 'start_date',
                                        'name' => 'start_date',
                                        'name2' => 'end_date',
                                        'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
                                        'options' => [
                                            'class' => 'show'
                                        ],
                                        'options2' => [
                                            'id' => 'end_date'
                                        ],
                                        'layout' => $layout3,
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ]);
                                ?>
                                <br/>
                                <button onclick="triggerButton()" type="button" id="makeFilter" class="btn btn-sm btn-success">Go</button>
                            </div>
                        </div>
                    </li>
                  </ul>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 ">
    <div class="panel panel-default" style="margin-top: 16px">
          <div class="panel-heading">
                <input type="date" class="form-control" pattern="yyyy-mm-dd" placeholder="2017-04-21" />
          </div>
          <div class="panel-body">
                <div class="col-md-12">
                    <h3>Passa Free <small id="passafree_profit">0,000$00</small></h3>
                </div>
                <div class="col-md-6">
                    <small>
                    <table class="table" id="biz1">
                        <thead>
                            <th>Business</th>
                            <th>Total</th>
                            <th>Responsable</th>
                            <th>Passa Free</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </small>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    <small>
                    <table class="table" id="biz2">
                        <thead>
                            <th>Produtor </th>
                            <th>Evento </th>
                            <th>Data </th>
                            <th>Vendidos</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </small>
                </div>
                <div class="col-md-6">
                    <center>
                        <h4>Revenue per event</h4>
                    </center>
                    <div class="biz-chart" id="bizh3"></div>
                </div>
                <div class="col-md-6">
                    <center>
                        <h4>Revenue per producer/event</h4>
                    </center>
                    <div class="biz-chart" id="bizh4"></div>
                </div>
          </div>
    </div>
</div>

</div>
 
