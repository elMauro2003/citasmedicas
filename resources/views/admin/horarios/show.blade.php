@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registro de nuevo Horario</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detalles del horario</h3>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form group">
                                <label for="">Doctor</label>
                                <p>{{$horario->doctor->nombres}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form group">
                                <label for="">Consultorio</label>
                                <p>{{$horario->consultorio->nombre}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form group">
                                <label for="">Dia</label>
                                <p>{{$horario->dia}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form group">
                                <label for="">Hora de inicio</label> <b>*</b>
                                <p>{{$horario->hora_inicio}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form group">
                                <label for="">Hora de fin</label> <b>*</b>
                                <p>{{$horario->hora_fin}}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{url('admin/horarios')}}" class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection