<?php
$this->title = 'Analitics';
$user = Yii::$app->user;
?>

<div class="container-fluid pagebusiness  pageanalitics">
    <?php
        if ($user->can('admin') || $user->can('passafree_staff')) {
            echo \Yii::$app->view->renderFile('@app/views/site/business_modal.php', [
                'onChange' => "
                    function (newBusiness) {
                    }
                "
            ]);
        }
    ?>
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>User Analitics</span></h4>
			</div>
		</div>
	</div>

	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="accountingbox">
					<div role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#new" aria-controls="home" role="tab" data-toggle="tab">
                                Growth
                            </a></li>
                            <!--
                            <li role="presentation"><a href="#usage" aria-controls="profile" role="tab" data-toggle="tab">
                                Usage
                            </a></li>
                            -->
                            <li role="presentation"><a href="#interation" aria-controls="profile" role="tab" data-toggle="tab">
                                Interation
                            </a></li>
						</ul>

						<div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="new">
                                <div class="col-md-12">
                                    <!--
                                    <div class="btn-group" data-toggle="buttons">
                                          <label class="btn btn-sm btn-primary active">
                                                <input type="radio" name="options" id="option1" autocomplete="off" checked> This week
                                          </label>
                                          <label class="btn btn-sm btn-primary">
                                                <input type="radio" name="options" id="option2" autocomplete="off"> This month
                                          </label>
                                          <label class="btn btn-sm btn-primary">
                                                <input type="radio" name="options" id="option3" autocomplete="off"> This year
                                          </label>
                                          <label class="btn btn-sm btn-primary">
                                                <input type="radio" name="options" id="option3" autocomplete="off"> 
                                                <span class="glyphicon glyphicon-filter"></span>
                                          </label>
                                    </div>
                                    -->
                                    <div id="user_growth"></div>
                                </div>
							</div>

							<div role="tabpanel" style="width:100%" class="fade tab-pane" id="usage">
                                <div id="usage_growth" style="width:100%"></div>
							</div>

							<div role="tabpanel" class="fade tab-pane" id="interation">
                                <div id="interaction_growth"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Producer Analitics</span></h4>
			</div>
		</div>
	</div>

	<?php /*?>TABELA<?php */?>
	<div class="col-md-12 contentbox">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="accountingbox">
					<?php /*?>tab<?php */?>
					<div role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#maisfestas" aria-controls="home" role="tab" data-toggle="tab">
                                Most popular
                            </a></li>
							<li role="presentation"><a href="#maisvendidos" aria-controls="profile" role="tab" data-toggle="tab">
                                Top sellers  
                            </a></li>
                            <li role="presentation"><a href="#maisrendimento" aria-controls="profile" role="tab" data-toggle="tab">
                               Most profitable
                            </a></li>
						</ul>
						<div class="tab-content" style="padding:0px">
							<div role="tabpanel" style="padding:0px" class="tab-pane active" id="maisfestas">
                                <?php echo $this->render('events_per_producer', [
                                            'eventsPerProducer' => $eventsPerProducer
                                        ]); ?>
							</div>

							<div role="tabpanel" class="fade tab-pane" id="maisvendidos">
                                <?php echo $this->render('tickets_per_producer', [
                                            'ticketsPerProducer' => $ticketsPerProducer
                                        ]); ?>
							</div>

							<div role="tabpanel" class="fade tab-pane" id="maisrendimento">Mais Rendimento
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--
	<div class="row">
		<div class="col-md-12 titulosection">
			<div class="proximo_evento">
				<h4><div class="borderlefttitlo"></div><span>Digital Revenue Breakdown</span></h4>
			</div>
		</div>
	</div>

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
-->

</div>
