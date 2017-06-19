<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Chat';
?>

<div class="chat-group contentbox" ng-controller="ChatController">
    <div class="row">
        <div class="col-md-4 panel panel-default inbox">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <span>Messages</span>
                    </div>
                    <div class="col-md-6">
                        <a href="">
                            <span><i class="glyphicon glyphicon-refresh"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body" ng-init="loadMessagesFrom(<?= @$models[0]['id_user'] ?>)">
                <?php foreach($models as $p): ?>
                    <a href="javascript:void(0)" ng-click="loadMessagesFrom(<?=  $p['id_user'] ?>)">
                        <div class="message-box ">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="perfil">
                                    <span class="img-rounded"></span>
                                    </div>
                                </div>
                                <div class="col-md-10" style="margin-top: 15px;">
                                    <span><?= $p['nome']; ?></span>
                                    <small class="pull-right time"><?= substr($p['data'], 0, 10) . '...'; ?></small><br>
                                    <?php if ($p['is_read']): ?>
                                        <small class="subject"><?= substr($p['mensagem'], 0, 30) . '...'; ?></small>
                                    <?php else: ?>
                                        <small class="title"><?= substr($p['mensagem'], 0, 30) . '...' ?></small><br>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-8">
            <div class="message panel panel-default" ng-if="profile">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="perfil">
                                        <img src="img/jorge.jpg" alt="" class="img-rounded"/>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="profile-details">
                                      <span class="details">{{ profile.nome }}</span><br>
                                      <small class="details"><i class="fa fa-user"></i>{{ profile.data_nascimento }}</small><br/>
                                      <small class="local"><i class="fa fa-envelope"></i>{{ profile.email }}</small><br>
                                      <small class="local"><i class="fa fa-phone"></i>{{ profile.telefone }}</small>
                                    </div>
                                    <div class="contacts">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              <div class="message full-message panel panel-default" ng-repeat="m in messages"> 
                <div class="panel panel-body">
                    <div class="row">
                       <div class="col-md-8">
                            <p> <small> {{::m.timming}} </small> </p>
                            <p>
                                &nbsp;&nbsp;From&nbsp;&nbsp;
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    {{ ::profile.email }}
                                </a>
                                &nbsp;&nbsp;To&nbsp;&nbsp;
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    {{ ::m.bizEmail }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-body subject-text">
                    <div class="row">
                        <div class="col-md-12">
                            <p>{{ ::m.mensagem }}</p>
                        </div>
                    </div>
                </div>

              </div>
            </div>
        </div>
    </div>
</div>

