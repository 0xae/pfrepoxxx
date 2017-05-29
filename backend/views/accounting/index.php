<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use miloschuman\highcharts\HighchartsAsset; 

$this->title = 'Accounting';
$range = $model->getRange();
?>

<style>
table td {
    border-right: 0px !important;
}
</style>

<div class="container-fluid pagebusiness accountngpage">
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
							<?php /*?>//<?php */?>
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
						<table class="table table-striped">
						<tbody>
							<tr>
								<td> <div>Revenue per Producer</div> </td>
							</tr>

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

                            <?php foreach ($businessData as $b): ?>
                                <tr>
                                    <td class="childtd">
                                        <div><strong>Total</strong></div>
                                        <div style="text-align:right">
                                            <strong>
                                                <span class="money"><?= $b['gross_revenue']; ?></span> 
                                                ECV
                                            </strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>Passa Free</div>
                                        <div style="text-align:right"><span class="money"><?= $b['passafree_revenue']; ?></span> ECV</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div><?= $model->name; ?></div>
                                        <div style="text-align:right"><span class="money"><?= $b['liquid_revenue']; ?></span> ECV</div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
						</tbody>
					</table>						
					</div>

					<div style="border-left: 1px solid #ddd;" class="col-md-6">
						<div id="graficoacounting" class="graficoacounting"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Digital Revenue Breakdown</span></h4>
			</div>
		</div>
	</div>

	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
            <!--
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr class="active">
							<th>Subscriber</th>
							<th>Country</th>
							<th>Age</th>
							<th>Period</th>
							<th>Expira</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Mark</td>
							<td>Otto</td>
							<td>@mdo</td>
							<td>@mdo</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@fat</td>
							<td>@mdo</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<td>Larry</td>
							<td>the Bird</td> 
							<td>@twitter</td>
							<td>@mdo</td>
							<td>@mdo</td>
						</tr>
					</tbody>
				</table>
			</div>
            -->
		</div>
	</div>
</div>
