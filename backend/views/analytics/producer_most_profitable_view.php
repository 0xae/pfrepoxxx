<?php
$user = \Yii::$app->user;
$session = \Yii::$app->session;
?>
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
                    <h4>Most profitable for <strong>passafree</strong></h4>
            </center>
            <div ng-if="no_profit_data" style="margin-bottom:-18em;margin-top:10em;">
                <no-data></no-data>
            </div>
            <div id="most_profitable" style="width: 100%"></div>
        </div>
        <div class="col-md-12">
            <?php echo $this->render('producer_most_profitable_tbl_view'); ?>
        </div>
    </div>
</div>

