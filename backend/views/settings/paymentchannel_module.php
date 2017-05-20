<style>
h4.active div.borderlefttitlo {
    background-color: #009447 !important;
}

h4.active span {
    color: #009447 !important;
}
</style>

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
                <a href="#channels" style="color: inherit"  aria-controls="channels" role="tab" data-toggle="tab">
                    <h4 ng-class="{'active':paymentView == 'channels'}" ng-click="setPaymentView('channels')">
                        <div style="background-color: gainsboro;" class="borderlefttitlo"></div>
                        <span style="color: gainsboro">
                            Channels
                        </span>
                    </h4>
                </a>
                <a href="#cards" style="color: inherit" aria-controls="cards" role="tab" data-toggle="tab">
                    <h4 ng-class="{'active':paymentView == 'cards'}" ng-click="setPaymentView('cards')">
                        <div style="background-color: gainsboro;" class="borderlefttitlo"></div>
                        <span style="color: gainsboro">
                            Cards
                        </span>
                    </h4>
                </a>
                <div class="pageventbtngroup">
                    <div class="btn-group">
                      <button type="button" class="criar btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        New <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#new_paymentchannel" data-toggle="modal" class="">
                                <span class="glyphicon glyphicon-random"></span>
                                Payment Channel
                            </a>
                        </li>
                        <li>
                            <a href="#new_paymentcard" data-toggle="modal" class="">
                                <span class="glyphicon glyphicon-credit-card"></span>
                                Payment Card
                            </a>
                        </li>
                      </ul>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
                <div role="tabpanel" style="padding:0px">
                  <!-- Tab panes -->
                  <div class="tab-content" style="padding:0px">
                    <div role="tabpanel" class="tab-pane active" id="channels">
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

                    <div role="tabpanel" class="tab-pane" id="cards">
                        <table class="table table-striped">
                            <thead>
                                <tr class="active">
                                    <th># ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($paymentCards as $c): ?>
                                    <tr>
                                        <td><?= $c->id ?></td>
                                        <td><?= $c->name ?></td>
                                        <td><?= $c->description ?></td>
                                        <td>
                                            <a href="./index.php?r=payment-card/update&id=<?=$c->id?>"  style="color: #999" >
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
		</div>
	</div>
</div>

<?php echo $this->render('paymentchannel_modal', []); ?>
<?php echo $this->render('paymentcard_modal', []); ?>
