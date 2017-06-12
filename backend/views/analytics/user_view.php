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
                            Reactions
                        </a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="new">
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
                                        Registrations per day
                                    </p>
                                </div>
                                <div class="col-md-9">
                                    <center>
                                        <h4>User growth in <?= $country->name; ?></h4>
                                    </center>
                                    <div ng-if="empty_user_gt" style="margin-bottom:-18em;margin-top:10em;">
                                        <no-data></no-data>
                                    </div>
                                    <div id="user_growth" style="width: 100%"></div>
                                </div>
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
                                        Likes & Comments per day
                                    </p>
                                </div>
                                <div class="col-md-9">
                                    <center>
                                        <h4>Reaction growth in <?= $country->name; ?></h4>
                                    </center>
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
</div>

