<?php

use yii\helpers\ArrayHelper;
if (!empty($_dataTickets)) {
    $bilhetesLabel = ArrayHelper::map($_dataTickets, 'ticket_id', 'ticket_name');
}
?>

<?php if (!empty($_dataTickets)): ?>
    <h4><div class="borderlefttitlo"></div><span style="margin-left: 20px; font-size: 20px; color: #009447; font-weight: 700; font-family: 'DINBold'; text-transform: uppercase;">Info Bilhetes</span></h4>
    <div class="col-md-12 titulosection">
        <div class="detail_bilhete">
        <div role="tabpanel">
            <ul class="nav nav-tabs bilhte" role="tablist">
                <li class="active" style="border-top-left-radius: 5px;"role="presentation"> 
                    <a href="#overview" 
                       aria-controls="overview" role="tab" 
                       data-toggle="tab" aria-expanded="false">Overview</a>
                </li>
                <?php foreach ($_dataTickets as $b): $id=$b['ticket_id']; ?>
                    <li role="presentation">
                            <a href="#bil_<?= $id ?>" 
                               aria-controls="home" role="tab" 
                               data-toggle="tab" aria-expanded="false"><?= $b['ticket_name'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="active tab-pane " id="overview">
                    <?php echo $this->render('evento_overview', ['b' => $_dataEvent[0]]); ?>
                </div>

                <?php foreach ($_dataTickets as $b): ?>
                    <div role="tabpanel" class="tab-pane fade " id="bil_<?= $b['ticket_id'] ?>">
                        <?php echo $this->render('evento_profile', ['b' => $b]); ?>
                    </div>
                <?php endforeach; ?>
            <!-- .tab-content -->
            </div>

        <!-- role="tabpanel" -->
        </div> 

        <!-- .detail_bilhete -->
        </div>
    <!-- .titulosection -->
    </div>
<?php else: ?>
    <h4><div class="borderlefttitlo"></div><span style="margin-left: 20px; font-size: 20px; color: #009447; font-weight: 700; font-family: 'DINBold'; text-transform: uppercase;">No Tickets found.</span></h4>
<?php endif; ?>
