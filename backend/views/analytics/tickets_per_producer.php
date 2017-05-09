<div class="col-md-12" style="padding: 10px;">
    <div class="col-md-4">
    </div>
    <div class=" push-right" style="float: right; margin-top:8px; margin-right:20px">
        <div class="yellow-box"></div>
        Likes & Comments
    </div>  
</div>

<div class="col-md-12" style="padding:0px;margin:0px;">
<table class="table table-striped fb-stats">
    <thead>
        <tr class="active fb-table-header">
            <th class="fb-header">Producer</th>
            <th class="fb-header" style="text-align: center;">Tickets sold this week</th>
            <th class="fb-header" style="text-align: center">Tickets sold last week</th>
            <th class="fb-header" style="text-align: center">Engagements this week</th>
            <th class="fb-header" style="text-align: center">Revenue</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ticketsPerProducer as $p): ?>
            <tr>
                <td style="padding-left: 70px;width: 450px;">
                    <img src="<?= $p['producer_logo']; ?>" style="width:44px; height:44px" />
                    <h4 style="display:inline">
                        <a href="#" style="font-weight: bolder; margin-left: 10px">
                            <?= $p['producer_name']; ?>
                        </a>
                    </h4>
                </td>
                <td class="fb-col">
                    <center>
                    <?= $p['tickets_sold']; ?>
                    </center>
                </td>
                <td class="fb-col">
                    <center>
                        <span style="color: #42b72a;">
                            <strong>
                            <span class="glyphicon glyphicon-triangle-top"></span>
                                <?= $p['tickets_sold']; ?>%
                            </strong>
                        </span>
                    </center>
                </td>
                <td class="fb-col">
                    <div class="col-md-2">
                        <?= $p['tickets_sold']; ?>
                    </div>

                    <div class="progress progress-stats" style="">
                      <div class="progress-bar" role="progressbar" 
                          aria-valuenow="60" aria-valuemin="1" 
                          aria-valuemax="100" 
                          style="background-color: rgb(255, 202, 135);width: <?= max(min($p['tickets_sold'], 100),1) ?>%;">
                      </div>
                    </div>
                </td>

                <td class="fb-col" style="width: 200px">
                    <center>
                    <span class="money"><?= $p['liquid_revenue']; ?></span>$00
                    </center>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
