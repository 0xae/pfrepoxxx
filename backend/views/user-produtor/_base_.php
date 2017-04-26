<?php
use yii\bootstrap\Nav;
use backend\models\User;

?>


<h4>Manage Your Account</a></h4>    
<div class="category-form" style="border: 1px solid rgba(0, 0, 0, 0.1); padding: 10px; background: #fafafa;">

    <div class="row">
        <div class="col-md-3">
            <div style="background:#fff; padding:10px; border:1px solid #eee;">
                <?= Nav::widget([
                    'options' => [
                        'class' => 'nav-pills nav-stacked',
                    ],
                    'items' => [
                        ['label' => 'Detalhes da Conta', 'url' => ['/user-produtor/update', 'id' => $model->id]],
                        ['label' => 'Detalhes do perfil', 'url' => ['/user-produtor/profile', 'id' => $model->id]],
                        //['label' => 'Privilégios', 'url' => ['/artista/previlegio', 'id' => $model->id]],

                        '<hr>',




                        [
                            'label' => ('Bloquear Utilizador'),
                            'url'   => ['/user-produtor/block', 'id' => $model->id],
                            'visible' => !$model->blocked_at,
                            'linkOptions' => [
                                'class' => 'text-danger',
                                'data-method' => 'post',
                                'data-confirm' => ('Are you sure you want to block this user?'),
                            ],
                        ],
                        [
                            'label' => 'Desbloquear Utilizador',
                            'url'   => ['/user-produtor/block', 'id' => $model->id],
                            'visible' => $model->blocked_at,
                            'linkOptions' => [
                                'class' => 'text-success',
                                'data-method' => 'post',
                                'data-confirm' => 'Are you sure you want to unblock this user?',
                            ],
                        ],





                        [
                            'label' => 'Apagar Utilizador',
                            'url'   => ['/user-produtor/delete', 'id' => $model->id],
                            'linkOptions' => [
                                'class' => 'text-danger',
                                'data-method' => 'post',
                                'data-confirm' => 'Are you sure you want to delete this user?',
                            ],
                        ],
                    ],
                ]) ?>
            </div>
        </div>
        <div class="col-md-9">
            <div style="background:#fff; padding:10px; border:1px solid #eee;">
                
                 <?= $content ?>

                
            </div>
        </div>
    </div><br><br><br><br><br><br><br><br><br><br>


</div>