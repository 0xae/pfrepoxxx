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
						</ul>

						<div class="tab-content" style="padding:0px">
							<div role="tabpanel" class="tab-pane active" id="maisfestas">
                                <div class="row" style="padding:15px" >
                                    <div class="col-md-3" style="padding:25px;">
                                        <p style="display: inline">
                                            <div class="progress progress-stats-green" style="">
                                              <div class="progress-bar" role="progressbar" 
                                                  aria-valuenow="60" aria-valuemin="1" 
                                                  aria-valuemax="100" 
                                                  style="width: 10%;">
                                              </div>
                                            </div>
                                            Likes & Comments
                                        </p>
                                    </div>
                                    <div class="col-md-9">
                                        <center>
                                            <h4>Most popular producers</h4>
                                        </center>
                                        <div ng-if="no_populars_data" style="margin-bottom:-18em;margin-top:10em;">
                                            <no-data></no-data>
                                        </div>
                                        <div id="most_popular" style="width: 100%"></div>
                                    </div>
                                </div>
							</div>

							<div role="tabpanel" class="fade tab-pane" id="maisvendidos" style="">
                                <div class="row" style="padding:15px" >
                                    <div class="col-md-3" style="padding:25px;">
                                        <p style="display: inline">
                                            <div class="progress progress-stats-green" style="">
                                              <div class="progress-bar" role="progressbar" 
                                                  aria-valuenow="60" aria-valuemin="1" 
                                                  aria-valuemax="100" 
                                                  style="width: 10%;">
                                              </div>
                                            </div>
                                            Gross Revenue
                                        </p>
                                    </div>
                                    <div class="col-md-9">
                                        <center>
                                            <h4>Top selling producers</h4>
                                        </center>
                                        <div ng-if="no_sellers_data" style="margin-bottom:-18em;margin-top:10em;">
                                            <no-data></no-data>
                                        </div>
                                        <div id="top_sellers" style="width: 100%"></div>
                                    </div>
                                </div>
							</div>

                            <div role="tabpanel" class="fade tab-pane" id="maisrendimento">
                                <div class="row" style="padding:15px" >
                                    <div class="col-md-3" style="padding:25px;">
                                        <p style="display: inline">
                                            <div class="progress progress-stats-green" style="">
                                              <div class="progress-bar" role="progressbar" 
                                                  aria-valuenow="60" aria-valuemin="1" 
                                                  aria-valuemax="100" 
                                                  style="width: 10%;">
                                              </div>
                                            </div>
                                            <?php if ($user->can('admin') || $user->can('passafree_staff')): ?>
                                                <strong>Passafree</strong>'s Revenue
                                            <?php else: ?>
                                                <strong><?= $session->get('business_name') ?></strong> Revenue
                                            <?php endif ?>
                                        </p>
                                    </div>
                                    <div class="col-md-9">
                                        <center>
                                            <?php if ($user->can('admin') || $user->can('passafree_staff')): ?>
                                                <h4>Most profitable for <strong>passafree</strong></h4>
                                            <?php else: ?>
                                                <h4>Most profitable for <strong><?= $session->get('business_name') ?></strong></h4>
                                            <?php endif ?>
                                        </center>
                                        <div ng-if="no_profit_data" style="margin-bottom:-18em;margin-top:10em;">
                                            <no-data></no-data>
                                        </div>
                                        <div id="most_profitable" style="width: 100%"></div>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
