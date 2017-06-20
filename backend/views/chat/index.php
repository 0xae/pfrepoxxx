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

            <div class="panel-body">
                <a ng-repeat="c in conversations" 
                  class="active"
                   ng-click="loadMessagesFrom(c.id_user, c)" href="javascript:void(0)">
                    <div class="message-box "
                       ng-class="{'active': currentUser == c.id_user}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="perfil">
                                    <img ng-src="../passafree_uploads/{{c.foto}}" class="img-rounded" />
                                </div>
                            </div>
                            <div class="col-md-10" style="margin-top: 15px;">
                                <span ng-class="{'subject' : c.is_read, 'title': !c.is_read}">{{ c.nome }}</span>
                                <small class="pull-right time">{{ c.data }}</small><br>
                                <small ng-class="{'subject' : c.is_read, 'title': !c.is_read}">
                                    {{ c.mensagem.substr(0,30) + "..." }}
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
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
                                        <img ng-src="../passafree_uploads/{{profile.foto}}" class="img-rounded" />
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

