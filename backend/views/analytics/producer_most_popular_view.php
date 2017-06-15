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
                <h4>Total reaction per producer</h4>
            </center>
            <div ng-if="no_populars_data" style="margin-bottom:-18em;margin-top:10em;">
                <no-data></no-data>
            </div>
            <div id="most_popular" style="width: 100%"></div>
        </div>

        <div class="col-md-12">
            <?php echo $this->render('producer_most_popular_tbl_view'); ?>
        </div>
    </div>
</div>
