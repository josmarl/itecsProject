@extends('layout.master')
@section('content')

<section ng-controller="ctrlProyecto">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="text-center">Administración de Proyectos</h4>
        </div>
        <div class="container menu-button" role="group" aria-label="...">
            <button class="btn btn-sm btn-primary" data-target="#modal-nuevo" data-toggle="modal">
                <i class="glyphicon glyphicon-folder-close"></i>&nbsp<b>Nuevo Proyecto</b>
            </button>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover table-responsive skills">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proyecto</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in proyectos">
                        <td>[[item.id]]</td>
                        <td>[[item.nombre]]</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger" ng-click="goToConfig([[item.id]])">
                                <span class="glyphicon glyphicon-cog"></span>
                            </button>
                            <button type="button" class="btn btn-sm btn-default" ng-click="getEliminarProyecto([[item.id]])" data-target="#modal-eliminar-proyecto" data-toggle="modal">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-close-session">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="myModalLabel">Registro</h4>
                </div>
                <form ng-submit="saveProject()">
                    <div class="modal-body">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Nombre de Proyecto :</label>
                                <input type="text" ng-model="nombre" class="form-control" placeholder="Ingrese nombre de proyecto..." required="true"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
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

    <div class="modal fade" id="modal-eliminar-proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="myModalLabel">Información</h4>
                </div>
                <form>
                    <div class="modal-body">
                        ¿Está seguro de eliminar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" ng-click="removeProyecto([[idProyecto]])" class="btn btn-primary">
                            <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Eliminar
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
<?= HTML::script('js/proyecto.js') ?>
@stop
