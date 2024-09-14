<?php>
<?>
<table style="text-align: center" class="table table-striped table-hover table-sm table-bordered">
    <thead>
        <tr>
            <th>Hora</th>
            <td>Lunes</td>
            <td>Martes</td>
            <td>Miercoles</td>
            <td>Jueves</td>
            <td>Viernes</td>
            <td>Sabado</td>
            <td>Domingo</td>
        </tr>
    </thead>
    <tbody>
        @php
            $horas = ['08:00:00 - 09:00:00', '09:00:00 - 10:00:00', '10:00:00 - 11:00:00', '11:00:00 - 12:00:00', '12:00:00 - 13:00:00', '13:00:00 - 14:00:00', '14:00:00 - 15:00:00', '15:00:00 - 16:00:00', '16:00:00 - 17:00:00', '17:00:00 - 18:00:00', '18:00:00 - 19:00:00', '19:00:00 - 20:00:00'];
            $diasSemana = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO'];
        @endphp
        @foreach ($horas as $hora)
            
            @php
                list($hora_inicio, $hora_fin) = explode(' - ',$hora);
            @endphp
            
            <tr>
                <td>{{$hora}}</td>
                @foreach ($diasSemana as $dia)
                    @php
                        $nombreDoctor = '';
                        foreach ($horarios as $horario){
                            if (strtoupper($horario->dia) == $dia && 
                                $hora_inicio >= $horario->hora_inicio && 
                                $hora_fin <= $horario->hora_fin ) {
                                    $nombreDoctor = $horario->doctor->nombres;
                                break;
                            }
                        }
                    @endphp
                    <td>{{$nombreDoctor}}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>