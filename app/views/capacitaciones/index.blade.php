@extends('layout.master')
@section('content')

<section class="container-fluid" ng-controller="ctrlCapacitacion" nv-file-drop="" uploader="uploader" filters="queueLimit, customFilter">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#">Importación de Miembros de Mesa</a></li>
        <li><a href="#">Reporte de Importación de Miembros de Mesa</a></li>
        <li><a href="#">Formatos de Capacitación</a></li>
        <li><a href="#">Reporte de Miembros de Mesa por ORC</a></li>
        <li><a href="#">Salir de Módulo</a></li>
    </ul>

    <div>
        <div>    
            <label>ORC</label>
            <label>Usuario</label>
            <label>Hora</label>
            <label>Fecha</label>
        </div>
        <div>
            <label>Capacitación</label>
            <br>

            <div class="col-xs-12 alert alert-success" ng-show="showProgressComplete" ng-bind="messageUpload"></div>
            <div class="col-xs-2">
                <select ng-model="idCap" ng-change="showInputFile(idCap)" class="form-control">
                    <option value="">-Seleccione-</option>
                    <option ng-repeat="tipos in listTipoCap" ng-value="[[tipos.n_tipo_capacitacion_pk]]">[[tipos.c_nombre]]</option>
                </select>
            </div>

            <div class="col-xs-2">                 
                <div ng-if="idCapResult" ng-show="importFileCap">
                    <input type="file" ng-model="inputImportCap" nv-file-select="" uploader="uploader" id="upl" name="upl"/>
                    <div ng-repeat="item in uploader.queue">
                        <button ng-init="item.upload()" ng-show="showCarga">cargar</button>
                        <button ng-click="item.remove()" ng-show="showCarga">eliminar</button>
                        <button ng-click="item.cancel()" ng-show="showCarga">cancelar</button>
                    </div>
                </div>
                <div ng-show="showProgressComplete">
                    <div class="progress progress-position" ng-if="message !== false">
                        <div class="progress-bar progress-bar-style" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                    </div>
                    <div ng-bind="uploadComplete"></div>
                </div>
            </div>
            <div class="col-xs-12 alert alert-success" ng-show="showProgressComplete" ng-bind="totalRowsUploaded"></div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>DNI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in dataExcelCap">
                        <td>[[item.nro]]</td>
                        <td>[[item.dni]]</td>
                    </tr>
                </tbody>
            </table>

        </div>
</section>

</section>
@stop
@section("javascript")        
<?= HTML::script('js/capacitaciones.js') ?>
@stop
