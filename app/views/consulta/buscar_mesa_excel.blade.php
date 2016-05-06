<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    th{text-align: center;}
</style>
<table border="1"  >
    <tr>
        <td align="right" colspan="6" style="text-align: center;"><strong>REPORTE DE MESA POR LOCAL</strong></td>
    </tr>
    <tr>
        <td align="center" colspan="4">&nbsp;</td>
    </tr>
    <tr>
        <td >Usuario: </td>
        <td colspan="3">{{$params->usuario}}</td>
    <tr>
        <td >{{$tipoAmbito}}:</td>
        <td colspan="3">{{$params->ambito}}</td>
    </tr>

    <tr>
        <td>Fecha Reporte</td>
        <td>{{substr($params->fecha,0,10)}}</td>
        <td>Hora</td>
        <td>{{substr($params->fecha,10)}}</td>
    </tr>
</table>
<table  border="1" >
    <tr>
        <th>Número de Mesa</th>
        <th>Presidente</th>
        <th>Secretario</th>
        <th>3er Miembro</th>
        <th>1er Suplente</th>
        <th>2do Suplente</th>
        <th>3er Suplente</th>
        <th>Estado</th>
    </tr>
    @foreach($data as $item)
    <tr>    
        <td > {{$item->c_mesa_rec}}</td>
        <td > @if($item->presidente===null) 0 @else 1 @endif</td>
        <td > @if($item->secretario===null) 0 @else 1 @endif</td>
        <td > @if($item->tercer_miembro===null) 0 @else 1 @endif</td>
        <td > @if($item->primer_suplente===null) 0 @else 1 @endif</td>
        <td > @if($item->segundo_suplente===null) 0 @else 1 @endif</td>
        <td > @if($item->tercer_suplente===null) 0 @else 1 @endif</td>
        <td > 
            @if($item->estado == 0) CRÍTICA @endif
            @if($item->estado >= 1 && $item->estado < 3) INCOMPLETA @endif
            @if($item->estado >= 3) COMPLETA @endif
        </td>
    </tr>
    @endforeach
</table>