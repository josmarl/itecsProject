
<section ng-controller="ctrlBuscarMesa">
    <div class="form-horizontal">

    <div class="row gutter">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border"><span>B</span>ÚSQUEDA</legend>
            <div class="col-lg-4">
                <div class="col-lg-12">
                    <div class="form-group col-lg-12">
                        <label>
                            <input type="radio" id="q128" name="quality[21]" value="1" checked="checked" ng-click="porMesa()" /> 
                            <label for="q128" class="labelfield">Mesas</label><br>
                        </label> 
                    </div>
                    <div class="form-group col-lg-12 form-margin-bottom">
                        <label>
                            <input type="radio" id="q129" name="quality[21]"  value="2" ng-click="porDistrito()"/> 
                            <label for="q129" class="labelfield">Locales</label><br>
                        </label>
                    </div>
                </div>
            </div>
            <div class="" ng-show="showPorMesa">
                    <div class="">
                        <label for="inputPassword" class="col-lg-2 control-label labelfield">Ingresar Mesa</label>
                        <div class="col-sm-2">
                            <form ng-submit="searchMesa()">
                                <input type="text" ng-model="n_mesa" maxlength="6" autocomplete="off"  class="form-control inputfield onlyNumber" />
                            </form>
                        </div>
                    </div>                    
            </div>

            <div class="" ng-show="showPorDistrito">                
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="control-label col-sm-4 labelfield">ODPE</label>
                        <div class="col-sm-8">
                            @if(count($ambitos)>1)                                 
                            <select class="combobox form-control" required="1" ng-model="Odpe" ng-change="listarOdpe()">                                        
                                <option value="0" ng-selected>-TODOS-</option>
                                @foreach( $ambitos as $item)
                                <option  value="{{$item->n_ambito_pk}}" >{{$item->c_alias}}</option>
                                @endforeach
                            </select>
                            @else
                            <div style="display:none;">
                                [[Odpe={{Session::get('usuario.ambito')}}]]
                            </div>
                            <input type="hidden" value="{{Session::get('usuario.ambito')}}" id="ambito" >
                            <input class="col-md-10 form-control inputfield" type="text" readonly="" value="{{$ambitos->c_alias}}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="control-label col-sm-4 labelfield">Distrito:</label>
                        <div class="col-sm-8">
                            <select class="combobox form-control" required="1" ng-model="Distrito" ng-change="listarLocal()">                                        
                                <option value="" ng-selected>- Seleccione -</option>
                                <option ng-repeat="item in lDistritos" value="[[item.c_ubigeo_pk]]" >[[item.c_distrito]]</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group form-margin-bottom">
                        <label class="control-label col-sm-4 labelfield">Local:</label>
                        <div class="col-sm-8">
                            <select class="combobox form-control" required="1" ng-model="Local" >                                        
                                <option value="" ng-selected>- Seleccione -</option>
                                <option ng-repeat="item in lLocales" value="[[item.c_local_pk]]" >[[item.c_nombre]]</option>
                            </select>    
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group form-margin-bottom">
                        <label class="control-label col-sm-4 labelfield">Filtro:</label>
                        <div class="col-sm-8">
                            <select class="combobox form-control" name="theinput3" id="theinput3"  ng-model="filtroMesas">                                        
                                <option value="" ng-selected>NINGUN FILTO</option>
                                <option value="1" >CRÍTICAS</option>
                                <option value="2" >INCOMPLETAS</option>
                                <option value="3" >COMPLETAS</option>
                            </select>
                        </div>
                    </div>
                </div>
            
        </div>
        </fieldset>
        
        <div class="col-md-12 text-right">
            <button class="botomAceptar" ng-show="showPorMesa" ng-click="searchMesa()" ng-disabled="isBusy" class="btn btn-primary ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </button>
        </div>

        <div class="col-md-12 text-right">
            <button class="botomAceptar" ng-show="showPorDistrito" ng-click="searchDistrito()" ng-disabled="isBusy" class="btn btn-primary">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </button>
        </div>

        
    </div>   

    <div id="loading"></div>
    <div class="row" ng-show="showResMesa">
        
        <fieldset class="scheduler-border" >
            <p ng-show="showMessage"  ng-cloak>[[message]]</p>
            <legend class="scheduler-border"><span>R</span>ESULTADO</legend>
            <div class="col-md-12">                                
                <div class="form-scroll-head">
                    <table class="table table-striped table-excel heading"  ng-show="!showMessage">
                        <thead>
                            <tr>
                                <th class="backgroundHeadTableA" width="20%">Nro de Mesa.</th>
                                <th class="backgroundHeadTableB" width="10%">Presidente</th>
                                <th class="backgroundHeadTableA" width="10%">Secretario</th>
                                <th class="backgroundHeadTableB" width="10%">3er Miembro</th>
                                <th class="backgroundHeadTableA" width="10%">1er Suplente</th>
                                <th class="backgroundHeadTableB" width="10%">2do Suplente</th>
                                <th class="backgroundHeadTableA" width="20%">3er Suplente</th>
                                <th class="backgroundHeadTableB" width="20%">Estado</th>
                                <th class="backgroundHeadTableA" width="1%"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="form-scroll" ng-show="!showMessage">
                    <form>
                        <table class="table table-striped table-excel" > 
                            <tbody class="credencial-entregada">
                                <tr ng-if="dataMesa.success === true" ng-repeat="item in filterLista">
                                    <td width="20%" scope="row" class="table-spacing center-input">[[item.c_mesa_rec]]</td>                                            

                                    <td ng-if="item.presidente != null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-15.png" alt="EVA" />
                                    </td>
                                    <td ng-if="item.presidente == null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-16.png" alt="EVA" />
                                    </td>

                                    <td ng-if="item.secretario != null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-15.png" alt="EVA" />
                                    </td> 
                                    <td ng-if="item.secretario == null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-16.png" alt="EVA" />
                                    </td> 

                                    <td ng-if="item.tercer_miembro != null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-15.png" alt="EVA" />
                                    </td>
                                    <td ng-if="item.tercer_miembro == null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-16.png" alt="EVA" />
                                    </td>

                                    <td ng-if="item.primer_suplente != null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-15.png" alt="EVA" />
                                    </td>
                                    <td ng-if="item.primer_suplente == null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-16.png" alt="EVA" />
                                    </td>

                                    <td ng-if="item.segundo_suplente != null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-15.png" alt="EVA" />
                                    </td>
                                    <td ng-if="item.segundo_suplente == null" width="10%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-16.png" alt="EVA" />
                                    </td>

                                    <td ng-if="item.tercer_suplente != null" width="20%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-15.png" alt="EVA" />
                                    </td>
                                    <td ng-if="item.tercer_suplente == null" width="20%" class="table-spacing">
                                        <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/Credenciales1b-16.png" alt="EVA" />
                                    </td>

                                    <td ng-if="item.estado == 0" width="20%" class="table-spacing"><div class="rojo"></div></td>                                       
                                    <td ng-if="item.estado <= 2 && item.estado >= 1" width="20%" class="table-spacing"><div class="amarillo"></div></td>
                                    <td ng-if="item.estado >= 3" width="20%" class="table-spacing"><div class="verde"></div></td>
                                </tr>
                                <tr ng-if="dataMesa.success === false">
                                    <td width="30%">[[dataMesa.message]]</td>
                                </tr>
                            </tbody>                                       

                        </table>
                    </form>
            </div>
            <label class="msg-25-reg" ng-bind="msgRegistros"></label>
        </fieldset>
   <uib-pagination 
   boundary-links="true"   ng-show="showPagination"
   max-size="maxSize" items-per-page="numPerPage" 
   total-items="totalItems" ng-model="currentPage"  class="pagination-sm"
   previous-text="&lsaquo;" next-text="&rsaquo;" 
   first-text="&laquo;" last-text="&raquo;">
   </uib-pagination>
    </div>
<input type="button" ng-click="excelEstadoMesas()" class="ico_excel" ng-show="dataMesa.success"/>                               
</fieldset>
</div>
</section>
