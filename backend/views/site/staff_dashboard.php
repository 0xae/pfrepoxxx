<?php
$user = \Yii::$app->user;
$context = '';
if ($user->can('admin')) {
    $context = 'passafree';
} else if ($user->can('producer')) {
    $context = 'producer';
} else if ($user->can('business')) {
    $context = 'business';
}
?>

<span id="dashboard_context" data-value="<?php echo $context; ?>"></span>

<div class="row">
    <div class="col-md-12 titulosection">
        <div class="proximo_evento">
            <h4><div class="borderlefttitlo"></div><span>Overview</span></h4>
            <div class="pageventbtngroup">
                <a id="iiidLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <h4>
                    <div class=""></div>
                    <span class="glyphicon glyphicon-filter"></span>

                </h4>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dLabel">
                  <form action=<?= \yii\helpers\Url::to(['site/logout'])?> method="post">
                    <button type="submit" class="btn btn-primary">Sair</button>
                  </form>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php /*?>BOX TOP<?php */?>
<div class="col-md-12 contentbox">
    <?php if ($user->can('admin') || $user->can('passafree_staff')) :?>
            <div class="col-md-3">
                <div class="white_box">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="white_box_inner">
                                <h3 id="biz_counter" style="font-weight: 700;">0</h3>
                                <small>Business</small>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="text-center box_icon">
                                <i class="overview_icons overall_users">business</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php /*?>02<?php */?>
            <div class="col-md-3">
                <div class="white_box">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="white_box_inner">
                                <h3 id="user_counter" style="font-weight: 700;">0</h3>
                                <small>Users</small>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="text-center box_icon">
                                <i class="overview_icons overall_users">users</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endif; ?>

    <?php if ($user->can('admin') || $user->can('passafree_staff') || $user->can('business')) :?>
        <div class="col-md-3">
            <div class="white_box">
                <div class="row">
                    <div class="col-md-7">
                        <div class="white_box_inner">
                            <h3 id="producer_counter" style="font-weight: 700;">0</h3>
                            <small>Producers</small>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="text-center box_icon">
                            <i class="overview_icons overall_users">users</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

        <div class="col-md-3">
            <div class="white_box">
                <div class="row">
                    <div class="col-md-7">
                        <div class="white_box_inner">
                            <h3 id="events_counter" style="font-weight: 700;">0</h3>
                            <small>Events</small>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="text-center box_icon">
                            <i class="overview_icons overall_users">users</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3" style="margin-top:10px">
            <div class="white_box">
                <div class="row">
                    <div class="col-md-7">
                        <div class="white_box_inner">
                            <h3 id="reactions_counter" style="font-weight: 700;">0</h3>
                            <small>Reactions</small>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="text-center box_icon">
                            <i class="overview_icons overall_users">users</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3" style="margin-top:10px">
            <div class="white_box">
                <div class="row">
                    <div class="col-md-7">
                        <div class="white_box_inner">
                            <h3 style="font-weight: 700;"><span id="sales_counter" class="money">0</span>$00</h3>
                            <small>Sales</small>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="text-center box_icon">
                            <i class="overview_icons overall_users">users</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php /*?>body box<?php */?>
<div class="row">

    <?php if ($user->can('admin') || $user->can('passafree_staff')) :?>
        <div class="col-md-6">
            <div class=" titulosection">
                <div class="proximo_evento">
                    <h4><div class="borderlefttitlo"></div><span>Revenue per Business</span></h4>
                    <div id="revenue_per_business"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($user->can('admin') || $user->can('passafree_staff') || $user->can('business')) :?>
        <div class="col-md-6 ">
    <?php else: ?>
        <div class="col-md-12 ">
    <?php endif; ?>
            <div class="titulosection">
                <div class="proximo_evento">
                    <h4><div class="borderlefttitlo"></div><span>Revenue per event</span></h4>
                    <div id="revenue_per_event"></div>
                </div>
            </div>
        </div>

    <?php if ($user->can('admin') || $user->can('passafree_staff') || $user->can('business')) :?>
        <div class="col-md-6 ">
            <div class="titulosection">
                <div class="proximo_evento">
                    <h4><div class="borderlefttitlo"></div><span>Revenue per producer</span></h4>
                    <div id="revenue_per_producer"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

