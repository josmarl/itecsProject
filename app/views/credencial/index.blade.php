@extends('layout.master')
@section('content')
<div class="container">
    <div ng-controller="ctrlCredencial">
        <div class="row gutter">
            <div class="title-monitoreo">
                <span>R</span>EGISTRO DE <span>E</span>NTREGA DE <span>C</span>REDENCIALES
            </div>
            <form ng-submit="add()" class="form-horizontal">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border"><span>R</span>EGISTRO</legend>
                <div class="col-sm-6 col-md-6 col-lg-5">
                        <div class="marginTop form-group">
                            <label class="control-label col-xs-2 col-sm-2 col-md-1 col-lg-2 labelfield">DNI:</label>
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <input type="text" ng-model="dni" maxlength="8"  class="form-control inputfield onlyNumber" class="onlyNumber"/>
                            </div>
                            <div class="col-sm-2 col-md-3">
                                <img class="pistola" ng-src="{{URL::to('/')}}/img/CredencialesR-10.png" alt="EVA" />
                            </div>
                        </div> 
                </div>
                <div class="col-sm-6 col-md-6 col-lg-7 messageCredencial" ng-show="showMessage"  ng-cloak>
                    <div ng-if="success === false && repeat === true" class="col-sm-3 col-md-3 col-lg-2 img-message">
                        <img class="imgAdvertencia" ng-src="{{URL::to('/')}}/img/CredencialesR-12.png" alt="EVA" />
                    </div>
                    <div ng-if="success === true && repeat === false" class="col-sm-3 col-md-3 col-lg-2 img-message">
                        <img class="imgAdvertencia" ng-src="{{URL::to('/')}}/img/CredencialesR-11.png" alt="EVA" />
                    </div>
                    <div ng-if="success === false && repeat === false" class="col-sm-3 col-md-3 col-lg-2 img-message">
                        <img class="imgAdvertencia" ng-src="{{URL::to('/')}}/img/CredencialesR-13.png" alt="EVA" />
                    </div>
                    <div class="col-sm-7 col-md-9 col-lg-10 text-message">
                        <p>[[message]]</p>
                    </div>
                </div>
            </fieldset>
                <div class="form-group">
                    <div class="col-sm-12 text-right">
                        <input type="button" class="botomAceptar" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agregar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ng-click="add()" ng-disabled="isBusy"/>
                    </div>
                </div>
            </form>
        </div>
            
            
            <div id="loading">
            </div>
        <fieldset ng-show="showContent" class="scheduler-border" ng-cloak>
                <legend class="scheduler-border"><span>L</span>ISTA</legend>
                <div class="form-scroll-head">
                    <table class="table table-striped table-excel heading">
                        <thead>
                            <tr>
                                    <th class="backgroundHeadTableA" width="20%">DNI</th>
                                    <th class="backgroundHeadTableB" width="60%">Apellidos y Nombres</th>
                                    @if($eliminar)
                                            <th class="backgroundHeadTableA" width="20%">Acción</th>
                                    @endif
                                    <th class="backgroundHeadTableA" width="1%"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="form-scroll">
                    <form>
                    <table class="table table-striped table-excel">
                        <tbody>
                            <tr ng-repeat="mmesa in mmesas">
                                <td class="table-spacing" width="20%">[[mmesa.c_num_ele]]</td>
                                    <td class="table-spacing" width="60%">[[mmesa.c_ape_pat]] [[mmesa.c_ape_mat]], [[mmesa.c_nombres]]</th>
                                    @if($eliminar)
                                    <td class="table-spacing" width="20%" style="text-align:center;"> 
                                        <a data-toggle="modal" data-target="#modalDeleteCredencial">
                                            <img class="btn-eliminar" ng-src="{{URL::to('/')}}/img/CredencialesR-18.png" alt="EVA" />
                                        </a>
                                    </td>
                                    @endif
                            </tr>
                        </tbody>
                    </table>
                    </form>
                </div>
        </fieldset> 
        
        <div class="modal fade" id="modalDeleteCredencial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-excel modal-close-session">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">CONFIRMACIÓN</h4>
                    </div>
                    <div class="modal-body">
                        ¿Desea eliminar el registro?
                    </div>
                    <div class="modal-footer">
                        <button type="button" ng-click="remove()" class="btn-accept">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aceptar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            <button type="button" class="btn-cancel" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cancelar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@stop

@section("javascript")        
	<?= HTML::script('js/credencial.js') ?>
@stop
