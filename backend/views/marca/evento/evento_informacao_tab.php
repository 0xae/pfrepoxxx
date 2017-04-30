<div class="col-md-12 proximo">
    <a href="#<?php /*?><?= Url::to($_model->idevento)?><?php */?>">
        <div class="evento_proximo" style="margin:0">
            <div class="filtro"></div>
                <div id="event_cartaz" class="event_cartaz">
                    <img class="img-responsive" src="uploads/evento/x22Ps-2U0zMCJvucY8GCY00uPocAtvon.jpg<?php /*?><?= $_model->cartaz; ?><?php */?>">
            </div>
            <div class="info_cartaz">
                <div class="row">
                    <div class="col-md-6 detalhes_geral">
                        <h1>Nome evento<?php /*?><?= $_model->nome; ?><?php */?></h1>
                        <span>
                            <i class="fa fa-calendar"></i> 
                            <span> 30 Abril de 2017
                                <?php /*?><?= date( 'd',strtotime($_model->data) ) //dia?>
                                <?= Yii::$app->mycomponent->MesExtencoNome(date( 'm', strtotime($_model->data) )) //mes?>
                                de, <?= date( 'Y', strtotime($_model->data) ) //ano?><?php */?>
                            </span>
                        </span>
                        <span>
                            <i class="fa fa-map-marker"></i>
                            <span>Tarrafall, Santiago<?php /*?><?=$_model->local; //Local?>, <?= $_model->ilha //ilha?><?php */?></span>
                        </span>
                        <div>
                            <button class="btn btn-default"><a href="#<?php /*?><?= Url::to($_model->idevento)?><?php */?>">Ver Detalhes</a></button>
                        </div>
                    </div>

                    <div class="col-md-3 text-center"><br><br>
                        <div class="fundo_circle">
                            <div class="c100 p50">
                                <span>25%</span>
                                <span class="value">de 1500</span>
                                <div class="slice">
                                    <div class="bar"></div>
                                    <div class="fill"></div>
                                </div>
                            </div>
                            <span>Entrada</span>
                        </div>
                    </div>

                    <div class="col-md-3 text-center"><br><br>
                        <div class="fundo_circle">
                            <div class="c100 p50">
                                <span>75%</span>
                                <span class="value">de 30000</span>
                                <div class="slice">
                                    <div class="bar"></div>
                                    <div class="fill"></div>
                                </div>
                            </div>
                            <span>Stock</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
