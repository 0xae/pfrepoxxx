<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use miloschuman\highcharts\HighchartsAsset;

$this->title = 'Accounting';
$range = $model->getRange();
$producers = [];
$accounting = [];
$pieData = json_encode($pieData);

if (!empty($_data)) {
    $producers = $_data['business_producer_revenue'];
    if (!empty($_data['business_revenue'])) {
        $accounting = $_data['business_revenue'][0];
    }
}
?>

<style>
table td {
    border-right: 0px !important;
}
</style>

<?php
$s = "
console.log('$pieData');
var data = JSON.parse('$pieData');
LoadPieChart('graficoacounting', 'Revenue Per Producer', data);
";
$this->registerJs($s);
?>

<div class="container-fluid pagebusiness accountngpage" ng-controller="AccountingController">
    <?php echo \Yii::$app->view->renderFile('@app/views/site/business_modal.php', []); ?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Accounting</span></h4>
			</div>
		</div>
	</div>

	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-12 filtropanel">
					<form class="form-inline">
						<div class="form-group">
							<div class="btn-group">
                                <button type="button" class="btn btn-default " >
                                    <span id="start_date"><?= $range[0]; ?></span>
                                </button>
							</div>

							<div class="btn-group">
                                <button type="button" class="btn btn-default " >
                                    <span id="end_date"><?= $range[1]; ?></span>
                                </button>
							</div>
						</div>
					</form>
				</div>

				<div class="accountingbox">
					<div class="col-md-6">
                        <div style="width:100%;padding-bottom: 15px;padding-top:20px;" class="col-md-6">
                            <center>
                                <h3 style="margin: auto;margin-left:63px;">Revenue Per Producer</h3>
                            </center>
                        </div>
						<table class="table table-striped">
                            <tbody>
                                <?php foreach ($producers as $p): ?>
                                    <tr>
                                        <td class="childtd">
                                            <div><?= $p['producer_name']; ?></div>
                                            <div style="text-align:right">
                                                <span class="money"><?= $p['business_gross_revenue']; ?></span> 
                                                 ECV
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php if (!empty($accounting)): ?>
                                    <tr>
                                        <td class="childtd">
                                            <div><strong>Total</strong></div>
                                            <div style="text-align:right">
                                                <strong>
                                                    <span class="money"><?= $accounting['gross_revenue']; ?></span> 
                                                    ECV
                                                </strong>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div><?= $model->name; ?></div>
                                            <div style="text-align:right"><span class="money"><?= $accounting['liquid_revenue']; ?></span> ECV</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>Passa Free</div>
                                            <div style="text-align:right"><span class="money"><?= $accounting['passafree_revenue']; ?></span> ECV</div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>						

                        <?php if(empty($producers)): ?>
                            <div class="col-md-12" style="margin-top: 11em;">
                                 <no-data></no-data>
                            </div> 
                        <?php endif; ?>
					</div>

					<div style="border-left: 1px solid #ddd;padding-top:20px;" class="col-md-6">
                        <center>
                            <h3 style="margin: auto;margin-left:63px;">Revenue Distribution</h3>
                            <div id="graficoacounting" class="graficoacounting"></div>
    
                            <?php if ($pieData == '[]'): ?>
                            <div class="col-md-12" style="margin-top: -9em;">
                                 <no-data></no-data>
                            </div> 
                            <?php endif; ?>
                        </center>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!--
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
		</div>
	</div>
    -->
</div>
