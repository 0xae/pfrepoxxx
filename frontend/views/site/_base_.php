<?php
use yii\bootstrap\Nav;
use backend\models\User;

?>


<h4>Manage Your Account</a></h4>    
<div class="category-form" style="margin-top: 3%; width: 800px; padding: 10px; background: #fafafa;">

    <div class="row">
        <div class="col-md-3">
            <div style="background:#fff; padding:10px; border:1px solid #eee;">
                <?= Nav::widget([
                    'options' => [
                        'class' => 'nav-pills nav-stacked',
                    ],
                    'items' => [
                        ['label' => 'Detalhes da Conta', 'url' => ['/site/update']],
                        ['label' => 'Detalhes do perfil', 'url' => ['/site/profile']],
                        

                        '<hr>',

              
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
