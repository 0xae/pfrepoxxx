<style type="text/css">
	.content.box_cont {
		padding-left: 0;
		padding-right: 0;
	}
</style>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->nome;
?>
<div class="container-fluid pagebusiness pageusers">
	<div role="tabpanel" style="padding:0; display: table;margin-top: 5px; width: 100%">
        
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#eventotab" aria-controls="home" role="tab" data-toggle="tab">Eventos</a>
                </li>
                <li role="presentation">
                    <a href="#informacaotab" aria-controls="profile" role="tab" data-toggle="tab">Informação</a>
                </li>
            </ul>
        

		<div class="tab-content" style="padding: 0">
			<div role="tabpanel" class="tab-pane active" id="eventotab">
                <?php echo $this->render('evento/evento_destaque', ['destaque' => $destaque]); ?>
                <div class="row">
                    <div class="col-md-12 titulosection">
                        <div class="proximo_evento" style="padding: 0 15px">
                            <h4>
                                <div class="borderlefttitlo"></div>
                                <?php if (empty($nextEvents)): ?>
                                    <span>Sem eventos.</span>
                                <?php else: ?>
                                    <span>Pr&oacute;ximos Eventos</span>
                                <?php endif; ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <?php echo $this->render('evento/evento_lista.php', ['nextEvents' => $nextEvents]); ?>
            </div>
			
			<div role="tabpanel" class="tab-pane" id="informacaotab">
                <?php echo $this->render('evento/evento_informacao_tab.php', []); ?>
			</div>
		</div>
	</div>
</div>
