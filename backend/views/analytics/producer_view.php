<?php
$user = \Yii::$app->user;
$session = \Yii::$app->session;
?>
<div class="row">
    <div class="col-md-12 titulosection">
        <div class="proximo_evento">
            <h4><div class="borderlefttitlo"></div><span>Producer Analitics</span></h4>

            <div class="pageventbtngroup">
                <a id="iiidLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon " id="sizing-addon3">
                           <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                        <input class="form-control" type="text" id="producer_daterange" name="daterange" value="01/01/2015 - 01/31/2015" />
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 contentbox" ng-controller="ProducerAnalyticsController">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="accountingbox">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#maisfestas" aria-controls="home" role="tab" data-toggle="tab">
                            Most popular
                        </a></li>
                        <li role="presentation"><a href="#maisvendidos" aria-controls="profile" role="tab" data-toggle="tab">
                            Top sellers  
                        </a></li>
                        <li role="presentation"><a href="#maisrendimento" aria-controls="profile" role="tab" data-toggle="tab">
                           Most profitable
                        </a></li>
                        <li role="presentation"><a href="#revenuegrowth" aria-controls="profile" role="tab" data-toggle="tab">
                           Revenue Growth
                        </a></li>
                        <li role="presentation"><a href="#producergrowth" aria-controls="profile" role="tab" data-toggle="tab">
                           Producer Growth
                        </a></li>
                        <li role="presentation"><a href="#eventgrowth" aria-controls="profile" role="tab" data-toggle="tab">
                           Event Growth
                        </a></li>
                    </ul>

                    <div class="tab-content" style="padding:0px">
                        <?php echo $this->render('producer_most_popular_view'); ?>
                        <?php echo $this->render('producer_top_sellers_view'); ?>
                        <?php echo $this->render('producer_most_profitable_view'); ?>
                        <?php echo $this->render('producer_revenue_growth'); ?>
                        <?php echo $this->render('producer_growth'); ?>
                        <?php echo $this->render('producer_event_growth'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

