<?php


use yii\helpers\Html;

	$this->title = 'Backend Passa Free';
?>


<div class="row">
    <div class="col-lg-3 col-xs-6">
      
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>150</h3>
          <p>Downloads APP</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      
      <div class="small-box bg-green">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>
          <p>Show Live</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
     
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>44</h3>
          <p>Utilizadores Registados</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      
      <div class="small-box bg-red">
        <div class="inner">
          <h3>65</h3>
          <p>Visitas</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

	<div class="row">

<?php
foreach (range(1,3) as $ordem)
{
?>     
		<div class="col-md-4">
			<div class="padding-20 padding-top-10">
			    <div class="clearfix">
			      <div class="grey-800 pull-left padding-vertical-10">
			        <h4 style="color: #1e256d; font-size: 20px; font-weight: 700; margin-bottom: -5px;">Utilizadores</h4>
			        <small>Descrição</small>
			      </div>
			      <span class="pull-right">
			        <i class="icon fa fa-user" style="color: #f47920; font-size: 28px; margin-top: 10px;"></i>
			      </span>
			    </div><br>
			    <div class="margin-bottom-20 grey-500">
			        <ul class="list-unstyled dados">
			            <li style="background: #a5a8c5; width: 50%; height: auto; padding: 10px; border-bottom-left-radius: 2px; border-top-left-radius: 2px;">
			                <span style="font-weight: 700; font-size: 28px; color: #fff;">
			                  309                        </span>
			                <p style="color: #fff; font-size: 14px; margin-bottom: -1px;">Total Utilizadores</p>
			            </li>
			            <li style="background: #f1f1f1; width: 49%; height: auto; padding: 10px; border-bottom-right-radius: 2px; border-top-right-radius: 2px;">
			                <span style="font-weight: 700; font-size: 28px; color: #1e256d;">
			                  3381                        </span>
			                <p style="color: #1e256d; font-size: 14px; margin-bottom: -1px;">Total Login</p>
			            </li>
			        </ul>
			    </div>
			      <div class="progress">
			        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
			          <span class="sr-only">70% Complete</span>
			        </div>
			      </div>
			    
			  </div>
		</div>
<?php
}
?> 

	</div>

			