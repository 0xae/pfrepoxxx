<div class="col-md-6 next" style="margin-bottom: 30px">
    <a href="#">
        <div class="fundo_next_event">
            <div class="filtro_eventos" style="background: #0f0<?php /*?><?= $model->filtro ?>; <?php */?>"></div>
            <div id="img_eventos" style="height:300px">
                <img class="img-responsive" src="uploads/evento/x22Ps-2U0zMCJvucY8GCY00uPocAtvon.jpg<?php /*?><?= $model->cartaz ?><?php */?>">
            </div>
            <div class="info_next_event">
                <div class="col-md-12">
                    <div class="col-md-1">
                        <div class="diaevento">30<?php /*?><?= date( 'd',strtotime($model->data) ) //dia?> <?php */?></div>
                        <div class="mesevento">Set<?php /*?><?= $model->GetMonth(date( 'm',strtotime($model->data) ))  ?> <?php */?></div>
                    </div>
                    <div class="col-md-11">
                        <span class="tipoevento">Footebol<?php /*?><?= $model->tipoeventoIdTipoevento->nome ?><?php */?></span>
                        <h3>Nome evento<?php /*?><?= $model->nome ?><?php */?></h3>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
