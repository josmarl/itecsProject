
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    th{text-align: center;}
</style>
<table  border="1" >
    <thead>
        <tr>
            <th colspan="12"><strong>REPORTE DE MESAS POR ENTREGA DE CREDENCIALES</strong></th>
        </tr>
        <tr>
            <td colspan="12">USUARIO : {{$params->usuario}}</td>
        </tr>
        <tr>
            <td colspan="12">ODPE : {{$params->nombreOdpe}}</td>
        </tr>
        <tr>
            <td colspan="1">FECHA: {{substr($params->fecha,0,10)}}</td>
            <td colspan="10">HORA: {{substr($params->fecha,10)}}</td>
        </tr>
        <tr>
            <th>Distrito</th>
            <th>Local</th>
            <th>Mesa</th>
            <th>Presidente</th>
            <th>Secretario</th>
            <th>3er Miembro</th>
            <th>1er Suplente</th>
            <th>2do Suplente</th>
            <th>3er Suplente</th>
            <th>Entregadas</th>
            <th>No Entregadas</th>
            <th>% Entregadas</th>
        </tr>
    </thead>
    <tbody>
        {{$sumTotalMesas = 0;}}
        {{$sumTotalPresidente = 0;}}
        {{$sumTotalSecretario = 0;}}
        {{$sumTotalTercerMiembro = 0;}}
        {{$sumTotalPrimerSup = 0;}}
        {{$sumTotalSegundoSup = 0;}}
        {{$sumTotalTercerSup = 0;}}
        {{$sumTotalEntregados = 0;}}
        {{$sumTotalNoEntregados = 0;}}
        @foreach($data as $item)
        <tr>
            <td> {{$item->distrito}}</td>
            <td> {{$item->local}}</td>
            <td> {{$item->total_mesas}}</td>
            <td> {{$item->presidente}}</td>
            <td> {{$item->secretario}}</td>
            <td> {{$item->tercer_miembro}}</td>
            <td> {{$item->primer_sup}}</td>
            <td> {{$item->segundo_sup}}</td>
            <td> {{$item->tercer_sup}}</td>
            <td> {{$item->entregados}}</td>
            <td> {{$item->no_entregados}}</td>
            <td> {{$item->porc_entregados}} {{'%'}}</td>
        </tr>
        {{$sumTotalMesas = $sumTotalMesas + $item->total_mesas}}
        {{$sumTotalPresidente = $sumTotalPresidente + $item->presidente}}
        {{$sumTotalSecretario = $sumTotalSecretario + $item->secretario}}
        {{$sumTotalTercerMiembro = $sumTotalTercerMiembro + $item->tercer_miembro}}
        {{$sumTotalPrimerSup = $sumTotalPrimerSup + $item->primer_sup}}
        {{$sumTotalSegundoSup = $sumTotalSegundoSup + $item->segundo_sup}}
        {{$sumTotalTercerSup = $sumTotalTercerSup + $item->tercer_sup}}
        {{$sumTotalEntregados = $sumTotalEntregados + $item->entregados}}
        {{$sumTotalNoEntregados = $sumTotalNoEntregados + $item->no_entregados}}
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>TOTAL</th>
            <th></th>
            <th>{{$sumTotalMesas}}</th>
            <th>{{$sumTotalPresidente}}</th>
            <th>{{$sumTotalSecretario}}</th>
            <th>{{$sumTotalTercerMiembro}}</th>
            <th>{{$sumTotalPrimerSup}}</th>
            <th>{{$sumTotalSegundoSup}}</th>
            <th>{{$sumTotalTercerSup}}</th>
            <th>{{$sumTotalEntregados}}</th>
            <th>{{$sumTotalNoEntregados}}</th>
            <th>{{round($sumTotalEntregados*100/$sumTotalNoEntregados,3)}} {{'%'}}</th>
        </tr>
    </tfoot>
</table>