<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use miloschuman\highcharts\HighchartsAsset; 
HighchartsAsset::register($this)
->withScripts(['highstock', 'modules/drilldown']);

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounting';
?>
<div class="container-fluid pagebusiness accountngpage">
	<?php /*?>///<?php */?>
	<div class="row nomebusinessbt">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<div class="nomebusiness">
					<div class="circulobusiness"></div>
					<div>Nome de Business</div>
				</div>
				<div class="labeltipobilhete">Alterar</div>
			</div>
		</div>
	</div>
	<?php /*?>TITULO, BT<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Accounting</span></h4>
			</div>
		</div>
	</div>
	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php /*?>FILTRO<?php */?>
				<div class="col-md-12 filtropanel">
					<form class="form-inline">
						<div class="form-group">
							<?php /*?>//<?php */?>
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">First Period<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
								</ul>
							</div>
							<?php /*?>///<?php */?>
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Second Period<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
								</ul>
							</div>
						</div>
						<button type="submit" class="criar btn btn-primary">Apply</button>
					</form>
				</div>
				<?php /*?>//<?php */?>
				<div class="accountingbox">
					<?php /*?>TABELA<?php */?>
					<div class="col-md-6">
						<table class="table table-striped">
						<tbody>
							<tr>
								<td>
									<div>Opening Balance</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
							<tr>
								<td>
									<div>Revenue</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
							<tr>
								<td class="childtd">
									<div>Encoding Fees</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
							<tr>
								<td class="childtd">
									<div>Chargebacks</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
							<tr>
								<td>
									<div>Publishing</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
							<tr>
								<td class="childtd">
									<div>Full Track</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
							<tr>
								<td class="childtd">
									<div>Ringtones</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
							<tr>
								<td>
									<div>Adjustments</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
							<tr>
								<td>
									<div>Payment</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
							<tr>
								<td>
									<div>Outstand Balance</div>
									<div>ECV10.000.OO</div>
								</td>
							</tr>
						</tbody>
					</table>						
					</div>
					<?php /*?>GRAFICO<?php */?>
					<div class="col-md-6">
						<div class="graficoacounting"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php /*?>TITULO, BT<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Digital Revenue Breakdown</span></h4>
			</div>
		</div>
	</div>
	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
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
		</div>
	</div>
</DIV>