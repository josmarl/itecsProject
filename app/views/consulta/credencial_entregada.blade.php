<?= HTML::script('js/library/bootstrap-datepicker.js') ?>
<?= HTML::style('css/library/boostrap/datepicker.css') ?>
    <div ng-controller="ctrlConsultaCredencial">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border"><span>B</span>ÚSQUEDA</legend>
            <div class="form-horizontal">
                <div class="row gutter">
                    <label class="control-label col-md-2 labelfield">{{$tipoAmbito}}:</label>
                    <div class="col-md-2">
                        @if(count($ambitos)>1)
                        <select ng-model="ambito" ng-change="getUbigeos()" class="form-control combobox">
                               <option value="0">-TODOS-</option>
                               @foreach($ambitos as $ambito)
                               <option value="{{$ambito->n_ambito_pk}}">{{$ambito->c_alias}}</option>
                               @endforeach
                       </select>
                        @else
                        <div style="display:none;">
                            [[ambito={{$ambitos->n_ambito_pk}}]]
                        </div>
                        <input type="hidden" ng-model="ambito"  value="{{$ambitos->n_ambito_pk}}" />
                        <input type="text" readonly value="{{$ambitos->c_alias}}" class="form-control input-text"/>
                        @endif
                    </div>
                    <label class="control-label col-md-2 labelfield">Distrito:</label>
                    <div class="col-md-2">
                        @if(count($ubigeos)>0)
                            <select ng-model="ubigeo" class="form-control combobox">
                                    <option value="0">-TODOS-</option>
                                    @foreach($ubigeos as $ubigeo)
                                    <option value="{{$ubigeo->c_ubigeo_pk}}">{{$ubigeo->c_distrito}}</option>
                                    @endforeach
                            </select>
                            @else

                            <select ng-model="ubigeo" class="form-control combobox">
                                    <option value="0">-TODOS-</option>
                                    <option ng-repeat="ubigeo in ubigeos" value="[[ubigeo.c_ubigeo_pk]]">[[ubigeo.c_distrito]]</option>
                            </select>
                        @endif
                    </div>
                    
                    <label class="control-label col-md-2 labelfield">Entregada:</label>
                    <div class="col-md-2">
                        <input type="checkbox" id="cb1" ng-model="entregada" ng-change="habilita()"/>
                        <label for="cb1"></label><br>
                    </div>

                </div>
                <br>
                <div class="row gutter">
                    <label class="control-label col-md-2 labelfield" ng-style="style">Fecha Inicial:</label>
                    <div class="col-md-2">
                        <input type="text"  style="cursor:default !important" id="fechaInicio" ng-model="fechaIni" readonly="true" 
                        ng-style="style" class="form-control input-text"/>    
                    </div>
                    <label class="control-label col-md-2 labelfield" ng-style="style">Fecha Final:</label>
                    <div class="col-md-2">
                        <input type="text" id="fechaFin" style="cursor:default !important" ng-model="fechaFin" readonly="true" ng-style="style" class="form-control input-text"/>
                    </div>
                    <label class="control-label col-md-2 labelfield" ng-style="style">Usuario:</label>
                    <div class="col-md-2"> 
                        @if(count($usuarios)>1)
                        <select ng-model="usuario" ng-style="style" class="form-control combobox">
                                <option value="0">-TODOS-</option>
                                @foreach($usuarios as $usuario)
                                <option value="{{$usuario->usuario}}">{{$usuario->nombre}}</option>
                                @endforeach
                        </select>
                        @else
                            <div style="display:none;">
                                [[usuario={{$usuarios->n_usuario_pk}}]]
                            </div>
                            <input type="hidden" ng-model="usuario"  value="{{$usuarios->n_usuario_pk}}" />
                            <input type="text"  ng-style="style" readonly value="{{$usuarios->c_usuario}}" class="form-control input-text"/>
                        @endif
                    </div>
                </div>
            </div>
            
        </fieldset>
        <div class="form-group">
            <div class="col-sm-12 text-right">
                <button class="botomAceptar" ng-click="consultar()" ng-disabled="isBusy">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </button>
            </div>
        </div>
        <div id="loading">
        </div>
        <br>
        <fieldset class="scheduler-border" ng-show="showContent"  ng-cloak>
            <legend class="scheduler-border"><span>R</span>ESULTADOS</legend>
                <p ng-show="showMessage"  ng-cloak>[[message]]</p> 
                        <table ng-show="!showMessage" ng-cloak class="table table-excel heading">
                            <thead>
                                <tr>
                                    <th width="25%" class="backgroundHeadTableA">{{$tipoAmbito}}</th>
                                    <th width="10%" class="backgroundHeadTableB">DNI</th>
                                    <th width="10%" class="backgroundHeadTableA">Mesa</th>
                                    <th width="30%" class="backgroundHeadTableB">Apellidos y Nombres</th>
                                    <th width="15%" class="backgroundHeadTableA">Fecha Registro</th>
                                    <th width="10%" class="backgroundHeadTableB">Usuario</th>
                                    <th widht="1%" class="backgroundHeadTableB"></th>
                                </tr>
                            </thead>
                        </table>
                <div class="form-scroll-report">
                    <table ng-show="!showMessage" ng-cloak class="table table-excel">
                            <tr ng-repeat="item in filterLista">
                                    <td width="25%"> [[item.odpe]]</td>
                                    <td width="10%"> [[item.dni]]</td>
                                    <td width="10%"> [[item.mesarec]]</td>
                                    <td width="30%"> [[item.appat]] [[item.apmat]], [[item.nombres]]</td>
                                    <td width="15%"> [[item.fecha]]</td>
                                    <td width="10%"> [[item.usuario]]</td>
                            </tr>
                    </table>
                </div>
	
                <uib-pagination 
                boundary-links="true"   ng-show="showPagination"
                max-size="maxSize" items-per-page="numPerPage" 
                total-items="totalItems" ng-model="currentPage"  class="pagination-sm"
                previous-text="&lsaquo;" next-text="&rsaquo;" 
                first-text="&laquo;" last-text="&raquo;">
                </uib-pagination>
            <input type="button" ng-click="exportar()" ng-show="filterLista.length>0" class="ico_excel"/> 
            <label class="msg-25-reg" ng-bind="msgRegistros"></label>
        </fieldset>
    </div>
<script>
$(document).ready(function() {
  $("#fechaInicio").datepicker({
    language:"es",
    format:"dd/mm/yyyy",
       autoclose: true,
  });
  $("#fechaFin").datepicker({
    language:"es",
    format:"dd/mm/yyyy",
    autoclose:true,
  });
});
</script>
