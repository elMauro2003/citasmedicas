@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3><b>Bienvenido:</b> {{ Auth::user()->name }} // <b>Rol:
                        </b>{{ Auth::user()->roles->pluck('name')->first() }}</h3>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">

        @can('admin.usuarios.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalUsuarios }}</h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="icon fas bi bi-people-fill"></i>
                    </div>
                    <a href="{{ url('admin/usuarios') }}" class="small-box-footer">Más Info <i
                            class="bi bi-people-fill"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.secretarias.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $totalSecretarias }}</h3>
                        <p>Secretarias</p>
                    </div>
                    <div class="icon">
                        <i class="icon fas bi bi-person-standing-dress"></i>
                    </div>
                    <a href="{{ url('admin/secretarias') }}" class="small-box-footer">Más Info <i
                            class="bi bi-person-standing-dress"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.pacientes.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalPacientes }}</h3>
                        <p>Pacientes</p>
                    </div>
                    <div class="icon">
                        <i class="icon fas bi bi-person-lines-fill"></i>
                    </div>
                    <a href="{{ url('admin/pacientes') }}" class="small-box-footer">Más Info <i
                            class="bi bi-person-lines-fill"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.consultorios.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalConsultorios }}</h3>
                        <p>Consultorios</p>
                    </div>
                    <div class="icon">
                        <i class="icon fas bi bi-hospital"></i>
                    </div>
                    <a href="{{ url('admin/consultorios') }}" class="small-box-footer">Más Info <i
                            class="bi bi-hospital"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.doctores.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalDoctores }}</h3>
                        <p>Doctores</p>
                    </div>
                    <div class="icon">
                        <i class="icon fas bi bi-person-heart"></i>
                    </div>
                    <a href="{{ url('admin/doctores') }}" class="small-box-footer">Más Info <i
                            class="bi bi-person-heart"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.horarios.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $totalHorarios }}</h3>
                        <p>Horarios</p>
                    </div>
                    <div class="icon">
                        <i class="icon fas bi bi-alarm"></i>
                    </div>
                    <a href="{{ url('admin/horarios') }}" class="small-box-footer">Más Info <i class="bi bi-alarm"></i></a>
                </div>
            </div>
        @endcan

        <!-- Otra forma aparte del can, xq si no es doctor no tendrá un doctor_id que cargará error -->
        @if (Auth::check() && Auth::user()->doctor)
            <!-- Esto verifica que el usuario este autenticado y tenga relacion con el modelo doctor -->
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Calendario de reservas</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped table-hover table-sm dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nro</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Fecha de reserva</th>
                                    <th scope="col">Hora de reserva</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 1; ?>
                                @foreach ($eventos as $evento)
                                    @if (Auth::user()->doctor->id == $evento->doctor_id)
                                        <tr class="odd">
                                            <td>{{ $contador++ }}</td>
                                            <td>{{ $evento->user->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($evento->start)->format('H:i') }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            $(function() {
                                $("#example1").DataTable({
                                    "pageLength": 15,
                                    "language": {
                                        "emptyTable": "No hay información",
                                        "info": "Mostrando START a END de TOTAL Consultorios",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Consultorios",
                                        "infoFiltered": "(Filtrado de MAX total Consultorios)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar MENU Consultorios",
                                        "loadingRecords": "Cargando...",
                                        "processing": "Procesando...",
                                        "search": "Buscador:",
                                        "zeroRecords": "Sin resultados encontrados",
                                        "paginate": {
                                            "first": "Primero",
                                            "last": "Ultimo",
                                            "next": "Siguiente",
                                            "previous": "Anterior"
                                        }
                                    },
                                    "responsive": true,
                                    "lengthChange": true,
                                    "autoWidth": false,
                                    buttons: [{
                                            extend: 'collection',
                                            text: 'Reportes',
                                            orientation: 'landscape',
                                            buttons: [{
                                                text: 'Copiar',
                                                extend: 'copy',
                                            }, {
                                                extend: 'pdf'
                                            }, {
                                                extend: 'csv'
                                            }, {
                                                extend: 'excel'
                                            }, {
                                                text: 'Imprimir',
                                                extend: 'print'
                                            }]
                                        },
                                        {
                                            extend: 'colvis',
                                            text: 'Visor de columnas',
                                            collectionLayout: 'fixed three-column'
                                        }
                                    ],
                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            });
                        </script>
                    </div>
                </div>
            </div>
        @endif

        @can('admin.horarios.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalReservas }}</h3>
                        <p>Reservas</p>
                    </div>
                    <div class="icon">
                        <i class="icon fas bi bi-calendar-check"></i>
                    </div>
                    <a href="" class="small-box-footer"><i class="bi bi-calendar-check"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.configuracion.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalConfiguraciones }}</h3>
                        <p>Configuraciones</p>
                    </div>
                    <div class="icon">
                        <i class="icon fas bi bi-gear"></i>
                    </div>
                    <a href="{{ url('/admin/configuracion') }}" class="small-box-footer">Más Info <i
                            class="bi bi-gear"></i></a>
                </div>
            </div>
        @endcan

    </div> <!-- END Widgets -->

    @can('cargar_datos_consultorios')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Calendario de atención de doctores</h3>
                            </div>
                            <div class="col-md-4">
                                <div style="text-align: right">
                                    <label for="">Consultorio</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="consultorio_id" id="consultorio_select" class="form-control">
                                    <option value="">Seleccione un consultorio</option>
                                    @foreach ($consultorios as $consultorio)
                                        <option value="{{ $consultorio->id }}">{{ $consultorio->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <script>
                                // Codigo JavaScript usando AJAX y JQuery
                                $('#consultorio_select').on('change', function() {
                                    var consultorio_id = $('#consultorio_select').val();
                                    if (consultorio_id) {
                                        $.ajax({
                                            url: "{{ url('/consultorios/') }}" + '/' + consultorio_id,
                                            type: 'GET',
                                            success: function(data) {
                                                $('#consultorio_info').html(data);
                                            },
                                            error: function() {
                                                alert('Error al obtener los datos del consultorio!');
                                            }
                                        });
                                    } else {
                                        $('#consultorio_info').html('');
                                    }
                                });
                            </script>
                            <hr>
                            <div id="consultorio_info"><!-- CODIGO --></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Calendario de reserva de citas médicas</h3>
                            </div>
                            <div class="col-md-4">
                                <div style="text-align: right">
                                    <label for="">Doctor</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="doctor_id" id="doctor_select" class="form-control">
                                    <option value="">Seleccione un doctor</option>
                                    @foreach ($doctores as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->nombres . ' ' . $doctor->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                <script>
                                    // Codigo JavaScript usando AJAX y JQuery
                                    $('#doctor_select').on('change', function() {
                                        var doctor_id = $('#doctor_select').val();

                                        var calendarEl = document.getElementById('calendar');
                                        var calendar = new FullCalendar.Calendar(calendarEl, {
                                            initialView: 'dayGridMonth',
                                            locale: 'es',
                                            events: [],
                                        });

                                        if (doctor_id) {
                                            $.ajax({
                                                url: "{{ url('/cargar_reserva_doctores/') }}" + '/' + doctor_id,
                                                type: 'GET',
                                                dataType: 'json',
                                                success: function(data) {
                                                    $('#doctor_info').html(data);
                                                    calendar.addEventSource(data);
                                                },
                                                error: function() {
                                                    alert('Error al obtener los datos del consultorio!');
                                                }
                                            });
                                        } else {
                                            $('#doctor_info').html('');
                                        }

                                        calendar.render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#staticBackdrop">
                                Registrar cita medica
                            </button>

                            <a href="{{ url('/admin/ver_reservas', Auth::user()->id) }}" class="btn btn-success mx-1">
                                Ver las reservas
                            </a>

                            <form action="{{ url('admin/eventos/create') }}" method="post">
                                @csrf
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Reserva de cita medica</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-goup">
                                                            <label for="">Doctor</label>
                                                            <select name="doctor_id" id="" class="form-control">
                                                                @foreach ($doctores as $doctor)
                                                                    <option value="{{ $doctor->id }}">
                                                                        {{ $doctor->nombres . ' ' . $doctor->apellidos . ' ' . $doctor->especialidad }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-goup">
                                                            <label for="">Fecha de reserva</label>
                                                            <input type="date" id="fecha_reserva" name="fecha_reserva"
                                                                value="<?php echo date('Y-m-d'); ?>" name="fecha_reserva"
                                                                class="form-control">
                                                            @error('fecha_reserva')
                                                                <small style="color:red">{{ $message }}</small>
                                                            @enderror
                                                            <script>
                                                                document.addEventListener("DOMContentLoaded", function() {
                                                                    const fechaReservaInput = document.getElementById('fecha_reserva');

                                                                    fechaReservaInput.addEventListener('change', function() {
                                                                        let selectedDate = this.value; // Obtener la fecha seleccionada

                                                                        let today = new Date().toISOString().slice(0,
                                                                            10); // Obtener la fecha actual en formato ISO (yyy-mm-dd)

                                                                        if (selectedDate < today) {
                                                                            // verificar que la fecha no sea anterior a la actual
                                                                            this.value = null;
                                                                            alert('No puede seleccionar una fecha pasada!');
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-goup">
                                                            <label for="">Hora de reserva</label>
                                                            <input type="time" name="hora_reserva" id="hora_reserva"
                                                                class="form-control">
                                                            @error('hora_reserva')
                                                                <small style="color:red">{{ $message }}</small>
                                                            @enderror
                                                            @if (($message = Session::get('hora_reserva')) && ($icono = Session::get('icono')))
                                                                <!-- Pregunto si hay alguna sesion de la variable 'mensaje' -->
                                                                <script>
                                                                    document.addEventListener('DOMContentLoaded', function() {
                                                                        $('#staticBackdrop').modal('show');
                                                                    });
                                                                </script>
                                                                <small style="color:red">{{ $message }}</small>
                                                            @endif
                                                            <script>
                                                                document.addEventListener("DOMContentLoaded", function() {
                                                                    const horaReservaInput = document.getElementById('hora_reserva');

                                                                    horaReservaInput.addEventListener('change', function() {
                                                                        let selectedTime = this.value; // Obtener la hora seleccionada

                                                                        // garantizar que solo se capture la hora
                                                                        if (selectedTime) {
                                                                            selectedTime = selectedTime.split(':'); // separar la cadena en horas y min
                                                                            selectedTime = selectedTime[0] + ':00'; // conservar solo la hora, ignorar los min
                                                                            this.val = selectedTime; // establecer la hora modificada en el campo de entrada
                                                                        }

                                                                        // garantizar que la hora seleccionada esté en el rango permitido
                                                                        if (selectedTime < '08:00' || selectedTime > '20:00') {
                                                                            this.value = null;
                                                                            alert('Por favor, seleccione una hora entre las 08:00 y las 20:00');
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Registrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div> <!--END ROW -->

                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    @endcan



@endsection
