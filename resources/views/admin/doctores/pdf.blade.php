<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="http://<?php/* echo $_SERVER['HTTP_HOST']; */?>/citasmedicas/public/storage/css/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/citasmedicas/public/storage/css/dompdf.css">-->
</head>
<body>
    <table class="table table-striped table-bordered table-hover table-sm text-center">
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
    <h2 class="text-center"><u>Listado del personal médico</u></h2>
    <br>
    <table class="table table-striped table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th >Nro</th>
                <th>Apellidos y Nombres</th>
                <th>Teléfono</th>
                <th>Licencia Médica</th>
                <th>Especialidad</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            @foreach ($doctores as $doctor)
                <tr>
                    <td>{{$contador++}}</td>
                    <td>{{$doctor->apellidos." ".$doctor->nombres}}</td>
                    <td>{{$doctor->telefono}}</td>
                    <td>{{$doctor->licencia_medica}}</td>
                    <td>{{$doctor->especialidad}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

