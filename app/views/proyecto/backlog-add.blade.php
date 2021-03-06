@extends('layout.master')
@section('content')

<section ng-controller="ctrlBacklog">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="text-center">Administración de Product Backlog</h4>
        </div>
        <div class="container menu-button" role="group" aria-label="...">
            <button class="btn btn-sm btn-primary" data-target="#modal-nuevo-miembro" data-toggle="modal">
                <i class="glyphicon glyphicon-user"></i>&nbsp<b>Nuevo Miembro</b>
            </button>
            <button class="btn btn-sm btn-primary" data-target="#modal-nuevo-req" data-toggle="modal">
                <i class="glyphicon glyphicon-th-list"></i>&nbsp<b>Nuevo Requerimiento</b>
            </button>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-responsive">
                <tbody>
                    <tr>
                        <th><strong>Proyecto:</strong></th>
                        <th class="text-left text-capitalize" colspan="3">{{$nombreProy}}</th>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Equipo:</strong></td>
                        <td><p class="paragraf-project text-capitalize" ng-repeat="item in personas.result"><b>[[item.rol]]: </b>[[item.nombres]]</p></td>
                    </tr>

                </tbody>
            </table>
            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Requerimiento</th>
                        <th>Complejidad</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in backlogs.result">
                        <td>&nbsp;</td>
                        <td>[[item.nombreBacklog]]</td>
                        <td>[[item.valor]]</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger" ng-click="openEliminarBacklog([[item.idBacklog]])" data-target="#modal-eliminar-req" data-toggle="modal">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-nuevo-req" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-close-session">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="myModalLabel">Registro de Requerimientos</h4>
                </div>
                <form ng-submit="saveBacklog()">
                    <div class="modal-body">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Nombre de requerimiento :</label>
                                <input type="text" ng-model="requerimiento" class="form-control" placeholder="Ingrese requerimiento..." required="true"/>
                            </div>
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Complejidad :</label>
                                <select class="form-control" ng-model="complejidad">
                                    <option ng-value="[[item.id]]" ng-repeat="item in complejidades.result">[[item.valor]]</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Prioridad :</label>
                                <input type="number" min="0"  max=[[sizeBacklog]]  ng-model="prioridad" class="form-control" placeholder="Ingrese prioridad..." required="true"/>
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

    <div class="modal fade" id="modal-nuevo-miembro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-close-session">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="myModalLabel">Registro de Miembros</h4>
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

    <div class="modal fade" id="modal-eliminar-req" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <button type="button" ng-click="removeBacklog([[idBacklog]])" class="btn btn-primary">
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
<?= HTML::script('js/backlog.js') ?>
@stop
