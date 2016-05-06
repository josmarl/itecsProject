
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	th{text-align: center;}
	.number_cell{text-align: right;}
</style>
<table border="1"  >
	<tr>
		<td align="right" colspan="26" style="text-align: center;">
			<strong>REPORTE DE ENTREGA DE CREDENCIALES DE MIEMBROS DE MESA POR CARGO</strong>
		</td>
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
<table  border="1">
			<tr>
				<th rowspan="2">Distrito</th>
				<th rowspan="2">Mesas</th>
				<th rowspan="2">MM</th>
				<th colspan="3">Presidente</th>
				<th colspan="3">Secretario</th>
				<th colspan="3">3er Miembro</th>
				<th colspan="3">1er Suplente</th>
				<th colspan="3">2do Suplente</th>
				<th colspan="3">3er Suplente</th>
				<th colspan="3">Total</th>
			</tr>
			<tr>
				<th>E</th>
				<th>NE</th>
				<th>E%</th>

				<th>E</th>
				<th>NE</th>
				<th>E%</th>

				<th>E</th>
				<th>NE</th>
				<th>E%</th>

				<th>E</th>
				<th>NE</th>
				<th>E%</th>

				<th>E</th>
				<th>NE</th>
				<th>E%</th>

				<th>E</th>
				<th>NE</th>
				<th>E%</th>

				<th>E</th>
				<th>NE</th>
				<th>E%</th>

				<th>E</th>
				<th>NE</th>
				<th>E%</th>
			</tr>
			<?php
				$tepre =0;
				$tnepre =0;
				$tesec=0;
				$tnesec=0;
				$teter=0;
				$tneter=0;
				$tepsu=0;
				$tnepsu=0;
				$tessu=0;
				$tnessu=0;
				$tetsu=0;
				$tnetsu=0;
				$ttet=0;
				$ttne=0;	
			?>
			@foreach($data as $item)
			<tr>
				<?php 
					$te=$item->epre+$item->esec+$item->eter+$item->epsu+$item->essu+$item->etsu;
					$tne=$item->nepre+$item->nesec+$item->neter+$item->nepsu+$item->nessu+$item->netsu;
					$perc= round(($te/($te+$tne))*100,2);
					$tepre += $item->epre;
	  				$tnepre += $item->nepre;
	  				$tesec+= $item->esec;
	  				$tnesec+= $item->nesec;
	  				$teter+= $item->eter;
	  				$tneter+= $item->neter;
	  				$tepsu+= $item->epsu;
	  				$tnepsu+= $item->nepsu;
	  				$tessu+= $item->essu;
	  				$tnessu+= $item->nessu;
	  				$tetsu+= $item->etsu;
	  				$tnetsu+= $item->netsu;
	  				$ttet+=$te;
	  				$ttne+=$tne;
				?>
				<td > {{$item->c_distrito}}</td>
				<td > {{$item->mesas}}</td>
				<td > {{$item->mm}}</td>
				<td > {{$item->epre}}</td>
				<td > {{$item->nepre}}</td>
				<td class='number_cell'> {{ round(($item->epre/($item->epre+$item->nepre)*100),2) }}%</td>
				<td > {{$item->esec}}</td>
				<td > {{$item->nesec}}</td>
				<td class='number_cell'> {{ round(($item->esec/($item->esec+$item->nesec)*100),2) }}%</td>
				<td > {{$item->eter}}</td>
				<td > {{$item->neter}}</td>
				<td class='number_cell'> {{ round(($item->eter/($item->eter+$item->neter)*100),2) }}%</td>
				<td > {{$item->epsu}}</td>
				<td > {{$item->nepsu}}</td>
				<td class='number_cell'> {{ round(($item->epsu/($item->epsu+$item->nepsu)*100),2) }}%</td>
				<td > {{$item->essu}}</td>
				<td > {{$item->nessu}}</td>
				<td class='number_cell'> {{ round(($item->essu/($item->essu+$item->nessu)*100),2) }}%</td>
				<td > {{$item->etsu}}</td>
				<td > {{$item->netsu}}</td>
				<td class='number_cell'> {{ round(($item->etsu/($item->etsu+$item->netsu)*100),2) }}%</td>
				<td > {{$te}}</td>
				<td > {{$tne}}</td>
				<td > {{$perc}}% </td>
			</tr>
			@endforeach
			<tr style="font-weight:bold;">
				<td colspan="3">TOTAL</td>
				<td> {{$tepre}}</td>
				<td> {{$tnepre}}</td>
				<td></td>
				<td> {{$tesec}}</td>
				<td> {{$tnesec}}</td>
				<td></td>
				<td> {{$teter}}</td>
				<td> {{$tneter}}</td>
				<td></td>
				<td> {{$tepsu}}</td>
				<td> {{$tnepsu}}</td>
				<td></td>
				<td> {{$tessu}}</td>
				<td> {{$tnessu}}</td>
				<td></td>
				<td> {{$tetsu}}</td>
				<td> {{$tnetsu }}</td>
				<td></td>
				<td> {{$ttet}}</td>
				<td> {{$ttne}}</td>
				<td> </td>
			</tr>
		</table>