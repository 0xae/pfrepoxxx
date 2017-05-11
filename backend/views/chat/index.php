<?php

use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Messenger';
?>

<div class="chat-message-index">
    <?php foreach ($models as $obj): $user = $obj->getUser(); ?>
        <div class="media">
              <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="<?= $user->foto ?>" alt="...">
                    </a>
              </div>

              <div class="media-body">
                <h4 class="media-heading">
                    <?= $obj->mensagem ?>
                </h4>
              </div>
        </div>
    <?php endforeach; ?>
</div>
