
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    th{text-align: center;}
</style>
<table  border="1" >
    <thead>
        <tr>
            <th colspan="6"><strong>REPORTE DE ENTREGA DE CREDENCIALES DE MIEMBRO DE MESA POR {{$params->nombreRepor}}</strong></th>
        </tr>
        <tr>
            <td colspan="6">USUARIO : {{$params->usuario}}</td>
        </tr>
        <tr>
            <td colspan="6">ODPE : {{$params->nombreOdpe}}</td>
        </tr>
        <tr>
            <td colspan="2">FECHA: {{substr($params->fecha,0,10)}}</td>
            <td colspan="4">HORA: {{substr($params->fecha,10)}}</td>
        </tr>
        <tr>
            <th>{{$params->nombreRepor}}</th>
            <th>Total Mesas</th>
            <th>Total Miembros de Mesa</th>
            <th>Entregadas</th>
            <th>No Entregadas</th>
            <th>(%) Entregadas</th>
        </tr>
    </thead>
    <tbody>
                <?php 
                    $total_mesa=0;
                    $total_mm=0;
                    $total_e=0;
                    $total_ne=0;
                ?>
        @foreach($data as $item)
        <tr>
                <?php 
                    $total_mesa+=$item->total_mesas;
                    $total_mm+=$item->tota_mm;
                    $total_e+=$item->entregadas;
                    $total_ne+=$item->no_entregadas;
                ?>

            <td> {{$item->first}}</td>
            <td> {{$item->total_mesas}}</td>
            <td> {{$item->tota_mm}}</td>
            <td> {{$item->entregadas}}</td>
            <td> {{$item->no_entregadas}}</td>
            <td style='text-align: right;'> {{$item->porc_entregadas}} {{'%'}}</td>
        </tr>
        @endforeach
            <tr style="font-weight:bold;">
                <td >TOTAL</td>
                <td> {{$total_mesa}}</td>
                <td> {{$total_mm}}</td>
                <td> {{$total_e}}</td>
                <td> {{$total_ne}}</td>
                <td> {{round(($total_e/($total_e+$total_ne))*100,2);}}</td>
            </tr>
    </tbody>
</table>