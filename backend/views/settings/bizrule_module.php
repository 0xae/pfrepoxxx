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
				<h4><div class="borderlefttitlo"></div><span>Business Rule</span></h4>
                <div class="pageventbtngroup">
                    <a href="./index.php?r=rule/create" class="criar btn btn-primary">
                        New Business Rule
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
							<th># Id</th>
							<th>Name</th>
							<th>Pre&ccedil;o</th>
							<th>Stock</th>
							<th>Percentagem </th>
							<th></th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach ($rules as $r): ?>
                            <tr id="biz_<?= $r->id; ?>">
                                <td><?= $r->id; ?></td>
                                <td><?= $r->nome_regra; ?></td>
                                <td>
                                    <?= $r->preco_min; ?> - <?= $r->preco_max; ?>
                                </td>
                                <td>
                                    <?= $r->stockMin; ?> - <?= $r->stockMax; ?>
                                </td>
                                <td><?= $r->percentagem_bilhete; ?>%</td>
                                <td>
                                    <a href="./index.php?r=rule/update&id=<?= $r->id ?>">
                                        <span class="label label-primary">EDIT</span>
                                    </a>
                                    <a style="color: #999" href="javascript:void(0)">
                                        <span ng-click="deleteBizRule(<?= $r->id ?>)" class="label label-danger">DELETE</span>
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
