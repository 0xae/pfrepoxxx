<?php
$paymentChanels = [];
?>

<div class="container-fluid pagebusiness pageanalitics">
	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
			</div>
		</div>
	</div>
	<?php /*?>TITULO, BT<?php */?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Payment Channels</span></h4>
                <div class="pageventbtngroup">
                    <a href="./index.php?r=country/create" class="criar btn btn-primary">
                        New Payment Channel
                    </a>
                </div>
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
							<th># ID</th>
							<th>Name</th>
							<th>Link</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach ($paymentChanels as $c): ?>
                            <tr>
                                <td><?= $c->id ?></td>
                                <td><?= $c->name ?></td>
                                <td><?= $c->link ?></td>
                                <td>
                                    <a href="./index.php?r=country/update&id=<?= $c->id ?>">
                                        <span class="label label-primary">EDIT</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</DIV>
