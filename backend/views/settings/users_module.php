<div class="container-fluid pagebusiness pageanalitics"> <?php /*?>TABELA<?php */?>
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
				<h4><div class="borderlefttitlo"></div><span>User</span></h4>
                <div class="pageventbtngroup">
                    <a href="./index.php?r=user/create" class="criar btn btn-primary">
                        New User
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
							<th>Username</th>
							<th>Email</th>
							<th>Tipo</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td><?= $u->id ?></td>
                                <td><?= $u->username ?></td>
                                <td><?= $u->email ?></td>
                                <td>
                                    <?php 
                                        if ($u->tipo_user == '3') { 
                                            echo '<span class="label label-primary">Producer</span>';
                                        } else if ($u->tipo_user == '10') {
                                            echo '<span class="label label-warning">Business</span>';
                                        } else {
                                            echo '<span class="label label-default">system</span>';
                                        }
                                    ?>
                                </td>
                                <td>
                                    
                                        <a style="color: #999" href="./index.php?r=user/update&id=<?= $u->id ?>">
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
