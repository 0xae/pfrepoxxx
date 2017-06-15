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
                <h4>Gross Revenue Per Producer</h4>
            </center>
            <div ng-if="no_sellers_data" style="margin-bottom:-18em;margin-top:10em;">
                <no-data></no-data>
            </div>
                <div id="top_sellers" style="width: 100%"></div>
        </div>

        <div class="col-md-12">
            <?php echo $this->render('producer_top_sellers_tbl_view'); ?>
        </div>
    </div>
</div>

