
<div ng-controller="ctrlConsultaCredMMesa" class="container">
    <input type="hidden" ng-model="opc" value="{{$tipo}}" id='opc'/>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border"><span>B</span>ÚSQUEDA</legend>
        <div class="row gutter">
         
            <form>                            
                <div>
                    <label class="control-label col-md-1 labelfield">ODPE</label>
                    <div class="col-md-2">
                    @if($tipo==1)
                      <select class="form-control combobox" ng-model="ambito">
                        <option value="0">-TODOS-</option>
                        @foreach($ambitos as $item)
                        <option value="{{$item->n_ambito_pk}}">{{$item->c_alias}}</option>
                        @endforeach
                    </select>
                    @else
                    
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
                        <input type="text"  class="form-control input-text"  readonly value="{{$ambitos->c_alias}}" />
                        @endif
                    
                    @endif
                </div>
            </div>
        </div>
    </form>
    
</fieldset>

<div class="form-group">
    <div class="col-sm-12 text-right">
        <!--<input ng-click="consultarCredMMEsa()"  type="submit" value="Consultar" class="botomAceptar" ng-disabled="isBusy"/>-->
        <button class="botomAceptar" ng-click="consultarCredMMEsa()" ng-disabled="isBusy">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </button>
    </div>

</div>
<div id="loading"></div>
<br>
<fieldset class="scheduler-border" ng-show="showContent">
    <legend class="scheduler-border"><span>R</span>ESULTADOS</legend><br>
    <p ng-show="showMessage"  ng-cloak>[[message]]</p>
    <table class="table table-excel heading" ng-show="!showMessage">
        <thead>
            <tr>
                <th width="30%" class="backgroundHeadTableA" ng-bind="nameFirstColumn"></th>
                <th width="10%" class="backgroundHeadTableB">TOTAL MESAS</th>
                <th width="20%" class="backgroundHeadTableA">TOTAL MIEMBROS DE MESA</th>
                <th width="10%" class="backgroundHeadTableB">ENTREGADAS</th>
                <th width="15%" class="backgroundHeadTableA">NO ENTREGADAS</th>
                <th width="15%" class="backgroundHeadTableB">(%) ENTREGADAS</th>
                <th width="1%" class="backgroundHeadTableB"></th>
            </tr>
        </thead>
    </table>
    <div class="form-scroll-report" ng-show="!showMessage">
        <table class="table">
            <tbody>
                <tr ng-repeat="item in filterLista">
                    <td width="30%" >[[item.first]]</td>
                    <td width="10%" >[[item.total_mesas]]</td>
                    <td width="20%" >[[item.tota_mm]]</td>
                    <td width="10%" >[[item.entregadas]]</td>
                    <td width="15%" >[[item.no_entregadas]]</td>
                    <td width="15%" >[[item.porc_entregadas]] [['%']]</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="backgroundHeadTableA">TOTAL</th>
                    <td class="backgroundHeadTableB" ng-bind="sumTotalMesas"></td>
                    <td class="backgroundHeadTableA" ng-bind="sumTotalMMesa"></td>
                    <td class="backgroundHeadTableB" ng-bind="sumEntregadas"></td>
                    <td class="backgroundHeadTableA" ng-bind="sumNoEntregadas"></td>
                    <td class="backgroundHeadTableB">[[(sumPorcEntregadas | number:2)]] [['%']]</td>
                </tr>
            </tfoot>
            </table>
        </div>
        <uib-pagination 
        boundary-links="true"   ng-show="showPagination"
        max-size="maxSize" items-per-page="numPerPage" 
        total-items="totalItems" ng-model="currentPage"  class="pagination-sm"
        previous-text="&lsaquo;" next-text="&rsaquo;" 
        first-text="&laquo;" last-text="&raquo;">
    </uib-pagination>
    <input ng-click="exportExcel()"  ng-show="filterLista.length>0" type="button" class="ico_excel" />
</fieldset>
</div>

