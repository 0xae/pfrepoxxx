<?php /*?>TITULO<?php */?>

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
				<h4><div class="borderlefttitlo"></div><span>Permission</span></h4>
            <div class="pageventbtngroup">
                    <a href="./index.php?r=role/create" class="criar btn btn-primary">
                        New Permission
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
							<th># Name</th>
							<th>Description</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach ($permissions as $p): ?>
                            <tr>
                                <td><?= $p->name ?></td>
                                <td><?= $p->description ?></td>
                                <td>
                                    <a href="./index.php?r=role/update&id=<?= $p->name ?>">
                                        <span class="label label-primary">EDIT</span>
                                        <span class="label label-danger">DELETE</span>
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
