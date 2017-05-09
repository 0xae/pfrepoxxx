<div class="col-md-12" style="padding: 10px;">
    <div class="col-md-4">
        <!--
        <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                Today
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
              </ul>
        </div>
        -->
    </div>
    <div class=" push-right" style="float: right; margin-top:8px; margin-right:20px">
        <div class="red-box"></div>
        Likes & Comments
    </div>  
</div>

<div class="col-md-12" style="padding:0px;margin:0px;">
<table class="table table-striped">
    <thead>
        <tr class="active fb-table-header">
            <th class="fb-header" >Producer</th>
            <th class="fb-header" style="text-align: center;">Events this week</th>
            <th class="fb-header" style="text-align: center;">Events last week</th>
            <th class="fb-header" style="text-align: center;">Engagements this week</th>
            <th class="fb-header" style="text-align: center;">Engagements this week</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventsPerProducer as $p): $reactions = ((int) $p['evento_likes']) + ((int) $p['evento_comments']); ?>
            <tr>
                <td style="padding-left: 70px;width: 450px;">
                    <img src="<?= $p['marca_picture']; ?>" style="width:44px; height:44px" />
                    <h4 style="display:inline">
                        <a href="#" style="font-weight: bolder; margin-left: 10px">
                            <?= $p['marca_nome']; ?>
                        </a>
                    </h4>
                </td>
                <td class="fb-col">
                    <center>
                    <?= $p['total_eventos']; ?>
                    </center>
                </td>
                <td class="fb-col">
                    <center>
                        <span style="color: #42b72a;">
                            <strong>
                            <span class="glyphicon glyphicon-triangle-top"></span>
                            <?= $p['total_eventos']; ?>%
                            </strong>
                        </span>
                    </center>
                </td>
                <td class="fb-col">
                    <div class="col-md-2">
                        <?= $reactions ?>
                    </div>

                    <div class="progress progress-stats" style="">
                      <div class="progress-bar" role="progressbar" 
                          aria-valuenow="60" aria-valuemin="1" 
                          aria-valuemax="100" 
                          style="width: <?= max(min($reactions, 100),1) ?>%;">
                      </div>
                    </div>
                </td>
                <td class="fb-col">
                    <center>
                        <table border="0">
                            <tr>
                                <td> <?= $p['evento_likes']; ?> </td>
                                <td>
                                    <div class="progress progress-stats" style="">
                                      <div class="progress-bar" role="progressbar" 
                                          aria-valuenow="60" aria-valuemin="1" 
                                          aria-valuemax="100" 
                                          style="width: <?= max(min($p['evento_likes'], 100),1) ?>%;">
                                      </div>
                                    </div>
                                 </td>
                            </tr>

                            <tr>
                                <td> <?= $p['evento_comments']; ?> </td>
                                <td>
                                    <div class="progress progress-stats" style="">
                                      <div class="progress-bar" role="progressbar" 
                                          aria-valuenow="60" aria-valuemin="1" 
                                          aria-valuemax="100" 
                                          style="width: <?= max(min($p['evento_comments'], 100),1) ?>%;">
                                      </div>
                                    </div>
                                 </td>
                            </tr>
                        </table>
                    </center>
                </td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
