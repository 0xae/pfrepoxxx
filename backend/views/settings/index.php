<?php

use yii\helpers\Html;

$this->title = 'Configuracoes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-md-3" >
    <a href="index.php?r=user/index" class="thumbnail" style="min-height: 100px;min-width:100px;padding:12px;">
       <div style="margin-top:15px; float:left; min-width: 100px;">
         <i class="glyphicon glyphicon-user" style="font-size:34px" aria-hidden="true"></i>
       Utilizadores
       </div>
    </a>
  </div>

  <div class="col-md-3" >
    <a href="index.php?r=country/index" class="thumbnail" style="min-height: 100px;min-width:100px;padding:12px;">
       <div style="margin-top:15px; float:left; min-width: 100px;">
         <i class="glyphicon glyphicon-globe" style="font-size:34px" aria-hidden="true"></i>
       Country
       </div>
    </a>
  </div>

  <div class="col-md-3" >
    <a href="index.php?r=role/index" class="thumbnail" style="min-height: 100px;min-width:100px;padding:12px;">
       <div style="margin-top:15px; float:left; min-width: 100px;">
         <i class="glyphicon glyphicon-lock" style="font-size:34px" aria-hidden="true"></i>
       Permiss&otilde;es
       </div>
    </a>
  </div>

</div>
