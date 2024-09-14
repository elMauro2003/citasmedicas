@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Paciente: {{ $historial->paciente->nombres . ' ' . $historial->paciente->apellidos }}</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detalles del paciente</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form group">
                                        <label for="">Paciente</label>
                                        <p>{{$historial->paciente->nombres}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form group">
                                        <label for="">Fecha de la cita medica</label>
                                        <p>{{$historial->fecha_visita}}</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="">Descripción de la cita</label>
                                        <p>{!!$historial->detalle!!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{ url('admin/historial') }}" class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
