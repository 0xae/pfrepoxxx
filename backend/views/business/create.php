<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Business */

$this->title = 'Business';
?>

<div class="container-fluid pagebusiness">
	<div class="row nomebusinessbt">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<div class="nomebusiness">
					<div class="circulobusiness"></div>
					<div>Nome de Business</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4>
					<div class="borderlefttitlo"></div><span>Bussiness</span>
					<div class="nomebusinesscreate">
						<div class="borderlefttitlo"></div>
						<span>Francis Johnsom, Cabo Verde</span>
					</div>
				</h4>

				<div class="pageventbtngroup">
					<button type="button" class="criar btn btn-primary" data-toggle="modal" data-target="#modalcriarmarca">Criar Marca</button>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="business-create">
					<?= $this->render('_form', [
						'model' => $model,
						'producerForm' => $producerForm,
						'producers' => [],
						'_dataCountries' => $_dataCountries,
						'_dataUsers' => $_dataUsers,
						'_dataProducers' => $_dataProducers
					]) ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php /*?>CRIAR MARCA<?php */?>
<?php /*?>STEP 1<?php */?>
<div class="modal fade popupcriarbilhete " id="modalcriarmarca" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header"><h4 class="modal-title">Criar Marca</h4></div>
			<div class="modal-body">
				<?php /*?>PROGRESSO<?php */?>
				<div class="progresspopup">
					<div class="lineprogresso"></div>
					<ul>
						<li class="active">1</li>
						<li class="stepmiddleprogress">2</li>
						<li>3</li>
					</ul>					
				</div>
				<?php /*?>///<?php */?>
				<form>
					<div class="col-md-6">
						<div class="form-group">
							<label>Nome</label>
							<input type="text" class="form-control" placeholder="Select country">
						</div>
						<div class="form-group">
							<label>Slogan</label>
							<input class="form-control" placeholder="">
						</div>
						<div class="form-group">
							<label>Descição</label>
							<textarea type="text" class="form-control" placeholder="Select carrier"></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Logo</label>
							<div class="imguploadpopup">
								<div class="imguploadpopupinner">+</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="labeltipobilhete btn btn-default">Cancelar</button>
				<button type="button" class="criar btn btn-primary">Próximo</button>
			</div>
		</div>
	</div>
</div>


<?php /*?>STEP 2<?php */?>
<div class="modal fade popupcriarbilhete " id="modalcriarmarca" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header"><h4 class="modal-title">Criar Marca</h4></div>
			<div class="modal-body">
				<?php /*?>PROGRESSO<?php */?>
				<div class="progresspopup stepsecond">
					<ul>
						<li class="active">1</li>
						<div class="lineprogresso donefirst"></div>
						<li class="active stepmiddleprogress">2</li>
						<div class="lineprogresso inativeline"></div>
						<li>3</li>
					</ul>					
				</div>
				<?php /*?>//<?php */?>
				<form>
					<div class="form-group">
						<label>Localização/Sede</label>
						<input type="text" class="form-control" placeholder="Select country">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" placeholder="Select country">
					</div>
					<div class="form-group">
						<label>Número de teleone</label>
						<input type="text" class="form-control" placeholder="Select country">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="labeltipobilhete btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="criar btn btn-primary">Próximo</button>
			</div>
		</div>
	</div>
</div>
<?php /*?>STEP 3<?php */?>
<div class="modal fade popupcriarbilhete" id="modalcriarmarca3" tabindex="-1" role="dialog" aria-labelledby="modalcriarmarca3">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header"><h4 class="modal-title">Criar Marca</h4></div>
			<div class="modal-body">
				<?php /*?>PROGRESSO<?php */?>
				<div class="progresspopup stepthird">
					<div class="lineprogresso"></div>
					<ul>
						<li>1</li>
						<li class="stepmiddleprogress">2</li>
						<li class="active">3</li>
					</ul>					
				</div>
				<form>
					<div>
						<div class="form-group col-md-6">
							<label>Nome</label>
							<input type="text" class="form-control" placeholder="Select country">
						</div>
						<div class="form-group col-md-6">
							<label>Username</label>
							<input type="text" class="form-control" placeholder="Select country">
						</div>
					</div>
					<div class="form-group col-md-12">
						<label>Email</label>
						<input type="email" class="form-control" placeholder="">
					</div>
					<div>
						<div class="form-group col-md-6">
							<label>Palavra-passe</label>
							<input type="password" class="form-control" placeholder="Select country">
						</div>
						<div class="form-group col-md-6">
							<label>Confirmar Palavra-passe</label>
							<input type="password" class="form-control" placeholder="Select country">
						</div>
					</div>
				</form>
				<div class="modal-footer" style="padding: 0">
					<button type="button" class="labeltipobilhete btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="criar btn btn-primary">Finalizar</button>
				</div>
			</div>
		</div>
	</div>
</div>