<?php /*?>TITULO<?php */?>
<div class="row">
    <div class="col-md-12 titulosection">
        <div class="proximo_evento">
            <h4><div class="borderlefttitlo"></div><span>Users</span></h4>
        </div>
    </div>
</div>
<div class="col-md-12 contentbox">
    <?php foreach ($users as $u): ?>
        <a href="./index.php?r=user/update&id=<?= $u->id; ?>">
            <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12 imgbussinessbox">
                                <img class="img-responsive" src="static/img/Unitel_img.jpg" alt="" title="">
                            </div>
                            <div class="col-md-12 descbussinessbox">
                                <span><?= $u->username; ?></span>
                                <span><?= $u->email; ?></span>
                            </div>
                        </div>
                    </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

