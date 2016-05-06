
@extends('layout.master')
@section("javascript")        
<?= HTML::script('js/reporte.js') ?> 
<?= HTML::script('js/consulta_credencial_entregada.js') ?>
<?= HTML::script('js/consulta_credencial_cargo.js') ?>
<?= HTML::script('js/consulta_mmesa.js') ?>
<?= HTML::script('js/consulta_credencial_local.js') ?>
<?= HTML::script('js/buscamesa.js') ?> 
@stop
@section('content')

<section ng-controller="ctrlReporte" class="container">
                <div class="title-monitoreo"><span>R</span>EPORTES </div>
                <div>
                    <div class="col-md-1"><label class="control-label labelfield">Reportes:</label></div>
                    <div class="col-md-11">
                            @if($isDropDowList)
                            <select ng-model="option" ng-change="change()" class="form-control combobox">
                                    <option value="">-Seleccionar-</option>
                                    @if (Session::get('menu'))
                                            @foreach (Session::get('menu') as $value)
                                            <option value="{{ URL::to($value->c_url) }}">{{ $value->c_descripcion}}</option>
                                            @endforeach                                
                                    @endif
                            </select>
                            @endif
                    </div>
                </div>
		<div id="reportContainer"  dynamic="html">[[html]]</div>
</section>
@stop

