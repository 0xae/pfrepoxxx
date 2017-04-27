<?php /*?>CSS<?php */?>
<style type="text/css">
	.content.box_cont
	{
		padding-left: 0;
		padding-right: 0;
	}
</style>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php /*?><div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'username',
            'email',
            'created_at:datetime',
            'updated_at:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div><?php */?>
<div class="container-fluid pagebusiness pageusers">
	<div role="tabpanel" style="padding:0; display: table;margin-top: 5px">
		<?php /*?>MENU<?php */?>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#usertab" aria-controls="home" role="tab" data-toggle="tab">Users</a>
			</li>
			<li role="presentation">
				<a href="#permissaotab" aria-controls="profile" role="tab" data-toggle="tab">Permissao</a>
			</li>
		</ul>
		<?php /*?>//<?php */?>
		<div class="tab-content">
			<?php /*?>Users<?php */?>
			<div role="tabpanel" class="biz-pane tab-pane active" id="usertab">
				<?php /*?>TITULO<?php */?>
				<div class="row">
					<div class="col-md-12 titulosection">
						<div class="proximo_evento">
							<h4><div class="borderlefttitlo"></div><span>Users</span></h4>
						</div>
					</div>
				</div>
				<?php /*?>//<?php */?>
				<div class="col-md-12 contentbox">
					<div class="col-md-3">
						<a href="#">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="col-md-12 imgbussinessbox">
										<img class="img-responsive" src="../../img/Unitel_img.jpg" alt="" title="">
									</div>
									<div class="col-md-12 descbussinessbox">
										<span>Francis Johnson</span>
										<span>Armenia</span>
									</div>
								</div>
							</div>
						</a>
					</div>
					<?php /*?>//<?php */?>
					<div class="col-md-3">
						<a href="index.php?r=business/create">
							<div class="panel panel-default addbusiness">
								<div class="panel-body">+</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<?php /*?>Permissao<?php */?>
			<div role="tabpanel" class="biz-pane tab-pane" id="permissaotab">
				<?php /*?>TITULO<?php */?>
				<div class="row">
					<div class="col-md-12 titulosection">
						<div class="proximo_evento">
							<h4><div class="borderlefttitlo"></div><span>Permissao</span></h4>
							<?php /*?>///<?php */?>
							<div class="pageventbtngroup">
								<button type="button" class="criar btn btn-primary" data-toggle="modal" data-target="#modalcriarmarca">Criar Permissao</button>
							</div>
						</div>
					</div>
				</div>
				<?php /*?>//<?php */?>
				<div class="col-md-12 contentbox">
					<div class="col-md-3">
						<a href="#">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="col-md-12 imgbussinessbox">
										<img class="img-responsive" src="../../img/Unitel_img.jpg" alt="" title="">
									</div>
									<div class="col-md-12 descbussinessbox">
										<span>Francis Johnson</span>
										<span>Armenia</span>
									</div>
								</div>
							</div>
						</a>
					</div>
					<?php /*?>//<?php */?>
					<div class="col-md-3">
						<a href="index.php?r=business/create">
							<div class="panel panel-default addbusiness">
								<div class="panel-body">+</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>