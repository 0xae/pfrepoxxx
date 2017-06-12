<div class="col-md-12" style="padding: 10px;">
    <div class="col-md-4">
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
            <th class="fb-header" style="text-align: center;">Total Events</th>
            <th class="fb-header" style="text-align: center;">Likes</th>
            <th class="fb-header" style="text-align: center;">Comments</th>
            <th class="fb-header" style="text-align: center;">Reaction</th>
        </tr>
    </thead>
    <tbody>
        <?php // foreach ($producers as $p): $reactions = ((int) $p['evento_likes']) + ((int) $p['evento_comments']); ?>
            <tr ng-repeat="p in producers">
                <td style="padding-left: 70px;width: 400px;">
                    <img ng-src="../passafree_uploads/{{p.marca_picture}}" style="width:44px; height:44px" />
                    <h4 style="display:inline">
                        <a href="#" style="font-weight: bolder; margin-left: 5px">
                            {{ p.marca_nome }}
                        </a>
                    </h4>
                </td>
                <td class="fb-col">
                    <center>
                        <strong>
                        {{ p.total_eventos }}
                        </strong>
                    </center>
                </td>
                <td class="fb-col">
                    <center>
                        <div class="col-md-2">
                            {{p.evento_likes}}
                        </div>

                        <div class="progress progress-stats" style="">
                          <div class="progress-bar" role="progressbar" 
                              aria-valuenow="60" aria-valuemin="1" 
                              aria-valuemax="100" 
                              ng-style="{width: p.likes_percent+'%'}">
                          </div>
                        </div>
                    </center>
                </td>
                <td class="fb-col">
                    <center>
                        <div class="col-md-2">
                            {{p.evento_comments}}
                        </div>

                        <div class="progress progress-stats" style="">
                          <div class="progress-bar" role="progressbar" 
                              aria-valuenow="60" aria-valuemin="1" 
                              aria-valuemax="100" 
                              ng-style="{width: p.comments_percent+'%'}">
                          </div>
                        </div>
                    </center>
                </td>

                <td class="fb-col">
                    <center>
                        <div class="col-md-2">
                            {{ p.total_reaction }}
                        </div>

                        <div class="progress progress-stats" style="">
                          <div class="progress-bar" role="progressbar" 
                              aria-valuenow="60" aria-valuemin="1" 
                              aria-valuemax="100" 
                              ng-style="{width: p.reaction_percent+'%'}">
                          </div>
                        </div>
                    </center>
                </td>
                <!--
                    <td class="fb-col">
                        <center>
                            <table border="0">
                                <tr>
                                    <td> <?= @$p['evento_likes']; ?> </td>
                                    <td>
                                        <div class="progress progress-stats" style="">
                                          <div class="progress-bar" role="progressbar" 
                                              aria-valuenow="60" aria-valuemin="1" 
                                              aria-valuemax="100" 
                                              style="width: <?= max(min(@$p['evento_likes'], 100),1) ?>%;">
                                          </div>
                                        </div>
                                     </td>
                                </tr>

                                <tr>
                                    <td> <?= @$p['evento_comments']; ?> </td>
                                    <td>
                                        <div class="progress progress-stats" style="">
                                          <div class="progress-bar" role="progressbar" 
                                              aria-valuenow="60" aria-valuemin="1" 
                                              aria-valuemax="100" 
                                              style="width: <?= max(min(@$p['evento_comments'], 100),1) ?>%;">
                                          </div>
                                        </div>
                                     </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                -->
            </tr>
        <?php // endforeach; ?>
    </tbody>
</table>
</div>
