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
        <?= HTML::style('css/main.css') ?>
        <?= HTML::style('css/base.css') ?>
        <?= HTML::script('js/library/jquery-2.1.0.min.js') ?>
        <?= HTML::script('js/library/angular.min.js') ?> 
        <?= HTML::script('js/library/angular-route.min.js') ?> 
        <?= HTML::script('js/library/ui-bootstrap-tpls-0.14.3.min.js') ?>    
        <?= HTML::script('js/app.js') ?>        
        <?= HTML::style('lib/font-awesome/css/font-awesome.min.css') ?>
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    </head>
    <body id="page-top" class="index" ng-app="app">
        <nav class="navbar navbar-default navbar-static-top" ng-controller="ctrlLink">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#page-top">
                        <img class="img-responsive" src="{{ URL::to('/') }}/img/logo-upeu-trans.png" alt="Itecs Projects">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li id="proyectos" class="nav-item">
                            <a class="nav-link" href="#" ng-click="goToProyectos()">
                                <span class="glyphicon glyphicon-lock"></span>&nbsp;Proyectos</a>
                        </li>
                        <li id="equipo" class="nav-item">
                            <a class="nav-link" href="#" ng-click="goToPersona()">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;Equipo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" type="button" data-target="#modalCloseSession" data-toggle="modal">
                                <span class="glyphicon glyphicon-off"></span>&nbsp;Cerrar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section>
            <div class="container">
                <div class="row">
                    <section class="text-right">
                        <span>Bienvenido: </span><label>{{Session::get('usuario.username')->username}}</label>
                    </section>
                </div>
                <div class="row">
                    @yield('content')
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

        <div class="modal fade" id="modalCloseSession" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ng-controller="ctrlLink">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-close-session">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Información</h4>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de cerrar sesión?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" href="#" ng-click="salir()" ng-cloak>
                            <span class="glyphicon glyphicon-ok"></span>&nbsp;Aceptar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>&nbsp;Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>           
    </section>
    <?= HTML::script('lib/js/jquery.js') ?>
    <?= HTML::script('lib/js/bootstrap.min.js') ?>
    <?= HTML::script('lib/js/classie.js') ?>
    <?= HTML::script('lib/js/cbpAnimatedHeader.js') ?>
    <?= HTML::script('lib/js/jqBootstrapValidation.js') ?>
    <?= HTML::script('lib/js/contact_me.js') ?>
    <?= HTML::script('lib/js/freelancer.js') ?>
    <?= HTML::script('js/index.js') ?>
    @yield('javascript') 
</body>
</html>
