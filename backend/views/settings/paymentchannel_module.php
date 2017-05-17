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
                    <a href="#new_paymentchannel" data-toggle="modal" class="criar btn btn-primary">
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
                        <?php foreach ($paymentChannels as $c): ?>
                            <tr>
                                <td><?= $c->id ?></td>
                                <td><?= $c->name ?></td>
                                <td><?= $c->link ?></td>
                                <td>
                                    <a href="./index.php?r=payment-channel/update&id=<?=$c->id?>"  style="color: #999" >
                                        <span class="glyphicon glyphicon-pencil text-default"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade popupcriarbilhete popuplocalizacao" id="new_paymentchannel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo $this->render('paymentchannel_modal', []); ?>
        </div>
    </div>
</div>

<div class="modal fade popupcriarbilhete popuplocalizacao" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
