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
				<h4><div class="borderlefttitlo"></div><span>Country</span></h4>
            <div class="pageventbtngroup">
                <a href="./index.php?r=country/create" class="criar btn btn-primary">
                    New Country
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
							<th>Code</th>
							<th>Business</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach ($countries as $c): ?>
                            <tr id="ct_<?= $c->id; ?>">
                                <td><?= $c->id ?></td>
                                <td><?= $c->name ?></td>
                                <td><?= $c->code ?></td>
                                <td>
                                    <?= $c->getBusinessLabel(); ?>
                                </td>
                                <td>
                                    <a href="./index.php?r=country/update&id=<?= $c->id ?>">
                                        <span class="label label-primary">EDIT</span>
                                    </a>
                                    <a style="color: #999" href="javascript:void(0)">
                                        <span ng-click="deleteCountry(<?= $c->id ?>)" class="label label-danger">DELETE</span>
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
