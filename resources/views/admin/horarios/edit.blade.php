@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Editar Horario</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Rellene los datos</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-3">
                        <form action="{{ url('/admin/horarios', $horario->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="">Consultorio</label> <b>*</b>
                                        <select name="consultorio_id" id="consultorio_select" class="form-control">
                                            @foreach ($consultorios as $consultorio)
                                                <option value="{{ $consultorio->id }}"
                                                    {{ $consultorio->id == $horario->consultorio->id ? 'selected' : '' }}>
                                                    {{ $consultorio->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="">Doctor</label> <b>*</b>
                                        <select name="doctor_id" id="" class="form-control">
                                            @foreach ($doctores as $doctor)
                                                <option value="{{ $horario->doctor->id }}"
                                                    {{ $doctor->id == $horario->doctor->id ? 'selected' : '' }}>
                                                    {{ $doctor->nombres . ' ' . $doctor->apellidos }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <script>
                                            // Codigo JavaScript usando AJAX y JQuery
                                            $('#consultorio_select').on('change', function() {
                                                var consultorio_id = $('#consultorio_select').val();

                                                if (consultorio_id) {
                                                    $.ajax({
                                                        url: "{{ url('/admin/horarios/consultorios/') }}" + '/' + consultorio_id,
                                                        type: 'GET',
                                                        success: function(data) {
                                                            $('#consultorio_info').html(data);
                                                        },
                                                        error: function() {
                                                            alert('Error al obtener los datos del consultorio!');
                                                        }
                                                    });
                                                } else {
                                                    $('consultorio_info').html('');
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="">Dia</label> <b>*</b>
                                        <select name="dia" id="" class="form-control">
                                            <option value="LUNES" {{ $horario->dia == 'LUNES' ? 'selected' : '' }} >LUNES</option>
                                            <option value="MARTES"{{ $horario->dia == 'MARTES' ? 'selected' : '' }} >MARTES</option>
                                            <option value="MIERCOLES"{{ $horario->dia == 'MIERCOLES' ? 'selected' : '' }} >MIERCOLES</option>
                                            <option value="JUEVES"{{ $horario->dia == 'JUEVES' ? 'selected' : '' }} >JUEVES</option>
                                            <option value="VIERNES"{{ $horario->dia == 'VIERNES' ? 'selected' : '' }} >VIERNES</option>
                                            <option value="SABADO"{{ $horario->dia == 'SABADO' ? 'selected' : '' }} >SABADO</option>
                                            <option value="DOMINGO"{{ $horario->dia == 'DOMINGO' ? 'selected' : '' }} >DOMINGO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="">Hora de inicio</label> <b>*</b>
                                        <input type="time" value="{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}" name="hora_inicio"
                                            class="form-control" required>
                                        @error('hora_inicio')
                                            <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="">Hora de fin</label> <b>*</b>
                                        <input type="time" value="{{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}" name="hora_fin"
                                            class="form-control" required>
                                        @error('hora_fin')
                                            <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <a href="{{ url('admin/horarios') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar horario</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <div id="consultorio_info">
                                <!-- Codigo de la tabla -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
