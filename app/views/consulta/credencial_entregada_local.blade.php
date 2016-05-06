<div ng-controller="ctrlConsultaEntregLocal" class="container">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border"><span>B</span>ÚSQUEDA</legend>
                    <form>
                        <label class="control-label col-md-1 labelfield">ODPE:</label>
                    <div class="col-md-2">
                        @if(count($ambitos)>1)
                        <select ng-model="ambito"  class="form-control combobox">
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
                    </form>
            </fieldset>
            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <!--<input ng-click="consultarByLocal()" type="submit" value="Consultar" class="botomAceptar"/>-->
                    <button class="botomAceptar" ng-click="consultar()" ng-disabled="isBusy">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </button>
                </div>
            </div>
            <br>
            <fieldset class="scheduler-border" ng-show="showTable">
                <legend class="scheduler-border"><span>R</span>ESULTADOS</legend>
                    <p ng-show="showMessage"  ng-cloak>[[message]]</p>
                    <table class="table table-excel heading table-nopadding" ng-show="!showMessage">
                        <thead>
                            <tr>
                                <th width="120px" class="backgroundHeadTableA">Distrito</th>
                                <th width="120px"class="backgroundHeadTableB">Local</th>
                                <th width="50px" class="backgroundHeadTableA">Mesa</th>
                                <th width="100px" class="backgroundHeadTableB">Presidente</th>
                                <th width="100px" class="backgroundHeadTableA">Secretario</th>
                                <th width="100px" class="backgroundHeadTableB">3er Miembro</th>
                                <th width="100px" class="backgroundHeadTableA">1er Suplente</th>
                                <th width="100px" class="backgroundHeadTableB">2do Suplente</th>
                                <th width="100px" class="backgroundHeadTableA">3er Suplente</th>
                                <th width="100px" class="backgroundHeadTableB">Entregadas</th>
                                <th width="100px" class="backgroundHeadTableA">No Entregadas</th>
                                <th width="100px" class="backgroundHeadTableB">% Entregadas</th>
                                <th width="1%" class="backgroundHeadTableB"></th>
                            </tr>
                        </thead>
                    </table>
                <div class="form-scroll-report" ng-show="!showMessage">
                    <table class="table table-excel">
                        <tbody>     
                            <tr ng-repeat="cred in credByLocal">
                                <td width="120px" class="th-dis">[[cred.distrito]]</td>
                                <td width="120px" class="th-local">[[cred.local]]</td>
                                <td width="50px" >[[cred.total_mesas]]</td>
                                <td width="100px">[[cred.presidente]]</td>
                                <td width="100px">[[cred.secretario]]</td>
                                <td width="100px">[[cred.tercer_miembro]]</td>
                                <td width="100px">[[cred.primer_sup]]</td>
                                <td width="100px">[[cred.segundo_sup]]</td>
                                <td width="100px">[[cred.tercer_sup]]</td>
                                <td width="100px">[[cred.entregados]]</td>
                                <td width="100px">[[cred.no_entregados]]</td>
                                <td width="100px">[[cred.porc_entregados]] [['%']]</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="backgroundHeadTableB">Total</td>
                                <td class="backgroundHeadTableB">&nbsp;</td>
                                <td class="backgroundHeadTableB">[[sumTotalMesas]]</td>
                                <td class="backgroundHeadTableB">[[presidente]]</td>
                                <td class="backgroundHeadTableB">[[secretario]]</td>
                                <td class="backgroundHeadTableB">[[tercer_miembro]]</td>
                                <td class="backgroundHeadTableB">[[primer_sup]]</td>
                                <td class="backgroundHeadTableB">[[segundo_sup]]</td>
                                <td class="backgroundHeadTableB">[[tercer_sup]]</td>
                                <td class="backgroundHeadTableB">[[sumEntregadas]]</td>
                                <td class="backgroundHeadTableB">[[sumNoEntregadas]]</td>
                                <td class="backgroundHeadTableB">[[(sumEntregadas*100/sumNoEntregadas) | number:3]] [['%']]</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                    <input ng-click="exportExcel()" ng-show="showTable" type="button" class="ico_excel"/>
            </fieldset>
            <div ng-bind="msg"></div>
</div>
