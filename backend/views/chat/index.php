<?php

use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Messenger';
?>

<div class="chat-group contentbox">
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
                        <a href="#">
                            <div class="message-box active">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="perfil">
                                            <img src="img/logo.jpg" alt="" class="img-rounded"/>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <span>Jorge Vieira</span>
                                        <small class="pull-right time"><i class="fa fa-clock-o"></i> 12:10am</small><br>
                                        <small class="title">Gamboa War, Suggestion</small><br>
                                        <small class="subject">Location H-2, Ayojan Nagar, Near Gate-3</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="message-box">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="perfil">
                                            <img src="img/jorge.jpg" alt="" class="img-rounded"/>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <span>Jorge Vieira</span>
                                        <small class="pull-right time"><i class="fa fa-clock-o"></i> 12:10am</small><br>
                                        <small class="title">Gamboa War, Suggestion</small><br>
                                        <small class="subject">Location H-2, Ayojan Nagar, Near Gate-3</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="message panel panel-default">
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
                                              <span class="details">Jorge Vieira</span><br>
                                              <small class="details"><i class="fa fa-user"></i>Nascido 14 de fev 1993 (24anos)</small>&nbsp;&nbsp;&nbsp;&nbsp;
                                              <small class="local"><i class="fa fa-map-marker"></i>Palmarejo, Praia, Cabo Verde</small>
                                            </div>
                                            <div class="contacts">
                                              <small class="local"><i class="fa fa-envelope"></i>bonako@gmail.com</small><br>
                                              <small class="local"><i class="fa fa-phone"></i>9999999</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                      <div class="message full-message panel panel-default">   
                        <div class="panel panel-body">
                            <div class="row">
                                <div class="col-md-8">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <h4>Gamboa War, Suggestion</h4>
                                          <h6>Today at 12:10am</h6>
                                        </div>
                                      </div>
                                    <ul class="nav nav-pills">
                                        <li><p>from&nbsp;&nbsp;</p>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">wilvieira28@gmail.com<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><span>Action</span></a></li>
                                                <li><a href="#"><span>Another action</span></a></li>
                                            </ul>
                                        </li>

                                        <li><p>&nbsp;&nbsp;to&nbsp;&nbsp;</p>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">wilson.vieira@student.unicv.edu.cv<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><span>Same Action</span></a></li>
                                                <li><a href="#"><span>Another action</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <div class="change-view">
                                        <ul>
                                            <li><a href=""><i class="glyphicon glyphicon-print"></i></a></li>
                                            <li><a href=""><i class="glyphicon glyphicon-trash"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="change-view">
                                        <ul>
                                            <button class="btn btn-default">Reply</button>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-body subject-text">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="">
                                        Keffiyeh blog actually fashion axe vegan, irony biodiesel. Cold-pressed hoodie chillwave put a bird on it aesthetic, bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester mlkshk. Ethical master cleanse Bushwick, occupy Thundercats banjo cliche ennui farm-to-table mlkshk fanny pack gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt tofu scenester chillwave 3 wolf moon asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe, Godard disrupt migas church-key tofu blog locavore. Thundercats cronut polaroid Neutra tousled, meh food truck selfies narwhal American Apparel.
                                    </p>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="message full-message panel panel-default">   
                        <div class="panel panel-body">
                            <div class="row">
                                <div class="col-md-8">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <h4>Gamboa War, Suggestion</h4>
                                          <h6>Today at 12:10am</h6>
                                        </div>
                                      </div>
                                    <ul class="nav nav-pills">
                                        <li><p>from&nbsp;&nbsp;</p>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">wilvieira28@gmail.com<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><span>Action</span></a></li>
                                                <li><a href="#"><span>Another action</span></a></li>
                                            </ul>
                                        </li>

                                        <li><p>&nbsp;&nbsp;to&nbsp;&nbsp;</p>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">wilson.vieira@student.unicv.edu.cv<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><span>Same Action</span></a></li>
                                                <li><a href="#"><span>Another action</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <div class="change-view">
                                        <ul>
                                            <li><a href=""><i class="glyphicon glyphicon-print"></i></a></li>
                                            <li><a href=""><i class="glyphicon glyphicon-trash"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="change-view">
                                        <ul>
                                            <button class="btn btn-default">Reply</button>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-body subject-text">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="">
                                        Keffiyeh blog actually fashion axe vegan, irony biodiesel. Cold-pressed hoodie chillwave put a bird on it aesthetic, bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester mlkshk. Ethical master cleanse Bushwick, occupy Thundercats banjo cliche ennui farm-to-table mlkshk fanny pack gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt tofu scenester chillwave 3 wolf moon asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe, Godard disrupt migas church-key tofu blog locavore. Thundercats cronut polaroid Neutra tousled, meh food truck selfies narwhal American Apparel.
                                    </p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>




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
