
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	th{text-align: center;}
</style>
<table border="1"  >
	<tr>
		<td align="right" colspan="6" style="text-align: center;"> <strong>REPORTE DE REGISTRO DE CREDENCIALES</strong></td>
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
		<td>Fecha Inicio</td>
		<td>{{$params->fechaIni}}</td>
		<td>Fecha Fin</td>
		<td>{{$params->fechaFin}}</td>
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
		<th>ODPE</th>
		<th>DNI</th>
		<th>Mesa</th>
		<th>Apellidos y Nombres</th>
		<th>Fecha Registro</th>
		<th>Usuario</th>
	</tr>
	@foreach($data as $item)
	<tr>
		<td > {{$item->odpe}}</td>
		<td > {{$item->dni}}</td>
		<td > {{$item->mesarec}}</td>
		<td > {{$item->appat}} {{$item->apmat}}, {{$item->nombres}}</td>
		<td > {{$item->fecha}}</td>
		<td > {{$item->usuario}}</td>
	</tr>
	@endforeach
</table>