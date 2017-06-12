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
        <div class="col-md-12">
            <?php echo $this->render('producer_most_profitable_tbl_view'); ?>
        </div>
    </div>
</div>

<div class="modal fade popupcriarbilhete popupupdate" id="_updatelocation">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nova Localização</h4>
            </div>
            <div class="modal-body">
                <label class="control-label" for="_nomeLocation">Nome</label>
                <input name="nome" type="text" id="_nomeLocation" class="form-control">

                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-sucesss" data-dismiss="modal">Close</button>
                        <button type="button" id="_BtnUpdateLocation" class="btn btn-lg btn-primary criar">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
