@extends('layout.master')
@section('content')

<section ng-controller="ctrlPersona">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <div class="collapse navbar-collapse">
                <h4 class="text-center">Administración de Equipo</h4>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombres</th>
                        <th>Proyecto</th>
                        <th>Opc</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in personas">
                        <td>[[item.id]]</td>
                        <td>[[item.nombres + " " + item.paterno + " " + item.materno]]</td>
                        <td>[[item.nombre]]</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-default" ng-click="removeProject([[item.id]])">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-close-session">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="myModalLabel">Registro de Equipo</h4>
                </div>
                <form ng-submit="saveProject()">
                    <div class="modal-body">
                        <div class="row control-group"> 
                            <div class="form-group col-xs-6 floating-label-form-group controls">
                                <label>Nombres:</label>
                                <input type="text" ng-model="nombres" class="form-control" required="true" placeholder="Ingrese nombres..."/>
                            </div>
                            <div class="form-group col-xs-6 floating-label-form-group controls">
                                <label>Apellido paterno:</label>
                                <input type="text" ng-model="paterno" class="form-control" required="true" placeholder="Ingrese apellido paterno.."/>
                            </div>
                        </div>
                        <div class="row control-group"> 
                            <div class="form-group col-xs-6 floating-label-form-group controls">
                                <label>Apellido materno:</label>
                                <input type="text" ng-model="materno" class="form-control" required="true" placeholder="Ingrese apellido materno.."/>
                            </div>
                            <div class="form-group col-xs-6 floating-label-form-group controls">
                                <label>Celular:</label>
                                <input type="text" ng-model="celular" class="form-control" required="true" placeholder="Ingrese celular.."/>
                            </div>
                        </div>
                        <div class="row control-group"> 
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email:</label>
                                <input type="text" ng-model="email" class="form-control" required="true" placeholder="Ingrese email.."/>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" ng-click="saveProject()" class="btn btn-primary">
                            <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Guardar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>&nbsp;Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>     
</section>

@stop
@section("javascript")        
<?= HTML::script('js/persona.js') ?>
@stop
