<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <!--<link rel="stylesheet" href="http://<?php/* echo $_SERVER['HTTP_HOST']; */?>/citasmedicas/public/storage/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/citasmedicas/public/storage/css/dompdf.css">
</head>
<body>
    <table>
        <tr>
            <td>
                {{$configuracion->nombre}} <br>
                {{$configuracion->direccion}} <br>
                {{$configuracion->telefono}} <br>
                {{$configuracion->correo}} <br>
            </td>
            <td width= "330px"></td>
            <td>
                <img src="{{url('storage/'.$configuracion->logotipo)}}" alt="logotipo" width="80px">
            </td>
        </tr>
    </table>
    <br>
    <h2><u>Listado del personal todas las reservas</u></h2>
    <br>
    <p>Reporte desde: {{$fecha_inicio." hasta ".$fecha_fin}}</p>
    <table>
        <thead>
            <tr>
                <th >Nro</th>
                <th>Doctor</th>
                <th>Especialidad</th>
                <th>Fecha de reserva</th>
                <th>Hora de reserva</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            @foreach ($eventos as $evento)
                <tr>
                    <td>{{$contador++}}</td>
                    <td>{{$evento->doctor->nombres." ".$evento->doctor->apellidos}}</td>
                    <td>{{$evento->doctor->especialidad}}</td>
                    <td>{{\Carbon\Carbon::parse($evento->start)->format('Y-m-d')}}</td>
                    <td>{{\Carbon\Carbon::parse($evento->start)->format('H:i')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

