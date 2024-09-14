<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/citasmedicas/public/storage/css/bootstrap.min.css">
</head>
<body>
    <table class="table table-bordered table-sm table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Apellidos y Nombres</th>
                <th>Teléfono</th>
                <th>Licencia Médica</th>
                <th>Especialidad</th>
                <th>
                    <img src="{{url('storage/'.$configuracion->logotipo)}}" alt="logotipo" width="80px">
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</body>
</html>