<?php
$this->title = 'Analitics';
$user = Yii::$app->user;
?>

<div class="container-fluid pagebusiness  pageanalitics">
    <?php
        if ($user->can('admin') || $user->can('passafree_staff')) {
            echo \Yii::$app->view->renderFile('@app/views/site/business_modal.php', [
                'onChange' => "
                    function (newBusiness) {
                    }
                "
            ]);
        }
    ?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>User Analitics</span></h4>
                <div class="">
                    <div class="pageventbtngroup">
                        <a id="iiidLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon " id="sizing-addon3">
                                   <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                              <input class="form-control" type="text" id="daterange" name="daterange" value="01/01/2015 - 01/31/2015" />
                            </div>
                        </a>
                    </div>
                </div>
			</div>
		</div>
	</div>

	<div class="col-md-12 contentbo " ng-controller="UserAnalyticsController">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="accountingbox">
					<div role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#new" aria-controls="home" role="tab" data-toggle="tab">
                                Growth
                            </a></li>
                            <!--
                            <li role="presentation"><a href="#usage" aria-controls="profile" role="tab" data-toggle="tab">
                                Usage
                            </a></li>
                            -->
                            <li role="presentation"><a href="#interation" aria-controls="profile" role="tab" data-toggle="tab">
                                Interation
                            </a></li>
						</ul>

						<div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="new">
                                <div class="col-md-12">
                                    <div ng-if="empty_user_gt" style="margin-bottom:-18em;margin-top:10em;">
                                        <no-data></no-data>
                                    </div>
                                    <div id="user_growth" style="width: 100%"></div>
                                </div>
							</div>

                            <!--
							<div role="tabpanel" style="" class="fade tab-pane" id="usage">
                                <div class="col-md-12">
                                    <div id="usage_growth"></div>
                                </div>
							</div>
                            -->

							<div role="tabpanel" class="fade tab-pane" id="interation">
                                <div class="col-md-12">
                                    <div ng-if="empty_interaction_gt" style="margin-bottom:-18em;margin-top:10em;">
                                        <no-data></no-data>
                                    </div>
                                    <div id="interaction_growth" style="width: 100%"> </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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
					<?php /*?>tab<?php */?>
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
						</ul>

						<div class="tab-content" style="padding:0px">
							<div role="tabpanel" style="padding:10px" class="tab-pane active" id="maisfestas">
                                <div class="col-md-12">
                                    <div ng-if="no_populars_data" style="margin-bottom:-18em;margin-top:10em;">
                                        <no-data></no-data>
                                    </div>
                                    <div id="most_popular"></div>
                                </div>
                                <?php /*
                                        echo $this->render('events_per_producer', [
                                            'eventsPerProducer' => $eventsPerProducer
                                        ]); */
                                ?>
							</div>
							<div role="tabpanel" class="fade tab-pane" id="maisvendidos" style="padding: 10px">
                                <div class="col-md-12">
                                    <div ng-if="no_sellers_data" style="margin-bottom:-18em;margin-top:10em;">
                                        <no-data></no-data>
                                    </div>
                                    <div id="top_sellers" style="width: 100%"></div>
                                </div>
                                <?php /* echo $this->render('tickets_per_producer', [
                                            'ticketsPerProducer' => $ticketsPerProducer
                                        ]);*/ 
                                 ?>
							</div>
                            <div role="tabpanel" class="fade tab-pane" id="maisrendimento">
                                    <div ng-if="no_profit_data" style="margin-bottom:-18em;margin-top:10em;">
                                        <no-data></no-data>
                                    </div>
                                <div id="most_profitable" style="width: 90%"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
