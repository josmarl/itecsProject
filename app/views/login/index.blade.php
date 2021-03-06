<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Itecs Projects</title>
        <?= HTML::style('lib/css/bootstrap.min.css') ?>
        <?= HTML::style('lib/css/freelancer.css') ?>
        <?= HTML::style('css/login.css') ?>   
        <?= HTML::style('lib/font-awesome/css/font-awesome.min.css') ?>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    </head>
    <body id="page-top" class="index">
        <nav class="navbar navbar-default navbar-fixed-top" ng-controller="ctrlLink">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#page-top">Itecs Projects</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li class="page-scroll">
                            <a href="#login">Ingresar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <img class="img-responsive" src="{{ URL::to('/') }}/lib/img/profile.png" alt="">
                        <div class="intro-text">
                            <span class="name">Itecs Projects</span>
                            <hr class="star-light">
                            <span class="skills">Scrum - Gestión de Proyectos - Experiencia de Usuario</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section id="login" class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Ingresar</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="form-login">
                    <form action="{{URL::to('/')}}/usuario/login" method="post">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">    
                                <label>Ingrese usuario:</label>
                                {{Form::text('username',null,array('class' =>'form-control','placeholder'=>'Usuario','id'=>'username','name'=>'username','ng-model'=>'username','ng-keyup'=>'validateEmptyLogin()','maxlength'=>'15','autocomplete'=>'off'));}}
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Ingrese password:</label>
                                {{Form::password('password',array('class' =>'form-control','placeholder'=>'Contraseña','maxlength'=>'20','ng-model'=>'password','ng-keyup'=>'validateEmptyLogin()','autocomplete'=>'off'));}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button class="btn btn-success btn-lg" type="submit">
                                    <span class="glyphicon glyphicon-cog"></span>&nbsp;Ingresar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <footer class="text-center">
            <div class="footer-above">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-md-4">
                            <h3>Dirección</h3>
                            <p>Km.6<br>Carretera Arequipa, Chullunquiani</p>
                        </div>
                        <div class="footer-col col-md-4">
                            <h3>Redes Sociales</h3>
                            <ul class="list-inline">
                                <li>
                                    <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-col col-md-4">
                            <h3>Acerca de Itecs Consulting</h3>
                            <p>Itecs Consulting, es un centro de aplicación de la Universidad Peruana Unión Filial Juliaca.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            Copyright &copy; Itecs Consulting 2016
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?= HTML::script('lib/js/jquery.js') ?>
        <?= HTML::script('lib/js/bootstrap.min.js') ?>
        <?= HTML::script('lib/js/classie.js') ?>
        <?= HTML::script('lib/js/cbpAnimatedHeader.js') ?>
        <?= HTML::script('lib/js/jqBootstrapValidation.js') ?>
        <?= HTML::script('lib/js/contact_me.js') ?>
        <?= HTML::script('lib/js/freelancer.js') ?>
    </body>