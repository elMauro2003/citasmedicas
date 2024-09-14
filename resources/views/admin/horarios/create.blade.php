@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registro de nuevo Horario</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Rellene los datos</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-3">
                        <form action="{{url('/admin/horarios/create')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="">Consultorio</label> <b>*</b>
                                        <select name="consultorio_id" id="consultorio_select" class="form-control">
                                            <option value="">Seleccione un consultorio</option>
                                            @foreach ($consultorios as $consultorio)
                                                <option value="{{$consultorio->id}}">{{$consultorio->nombre}}</option>
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
                                                <option value="{{$doctor->id}}">{{$doctor->nombres." ".$doctor->apellidos}}</option>
                                            @endforeach
                                        </select>
                                        <script>
                                            // Codigo JavaScript usando AJAX y JQuery
                                            $('#consultorio_select').on('change', function(){
                                                var consultorio_id = $('#consultorio_select').val();
                                                
                                                if (consultorio_id) {
                                                    $.ajax({
                                                        url: "{{url('/admin/horarios/consultorios/')}}" + '/' + consultorio_id,
                                                        type: 'GET',
                                                        success: function (data){
                                                            $('#consultorio_info').html(data);
                                                        },
                                                        error: function(){
                                                            alert('Error al obtener los datos del consultorio!');
                                                        }
                                                    });
                                                }else{
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
                                            <option value="LUNES">LUNES</option>
                                            <option value="MARTES">MARTES</option>
                                            <option value="MIERCOLES">MIERCOLES</option>
                                            <option value="JUEVES">JUEVES</option>
                                            <option value="VIERNES">VIERNES</option>
                                            <option value="SABADO">SABADO</option>
                                            <option value="DOMINGO">DOMINGO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="">Hora de inicio</label> <b>*</b>
                                        <input type="time" value="{{old('hora_inicio')}}" name="hora_inicio" class="form-control" required>
                                        @error('hora_inicio')
                                            <small style="color:red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="">Hora de fin</label> <b>*</b>
                                        <input type="time" value="{{old('hora_fin')}}" name="hora_fin" class="form-control" required>
                                        @error('hora_fin')
                                            <small style="color:red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <a href="{{url('admin/horarios')}}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Registrar horario</button>
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