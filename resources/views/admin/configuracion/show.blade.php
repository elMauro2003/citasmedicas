@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Datos de la configuración</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Nombre de la Clínica/Hospital</label> <b>*</b>
                                    <p>{{$configuracion->nombre}}</p>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Dirección</label> <b>*</b>
                                    <p>{{$configuracion->direccion}}</p>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Teléfono</label> <b>*</b>
                                    <p>{{$configuracion->telefono}}</p>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Correo</label> <b>*</b>
                                    <p>{{$configuracion->correo}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Logotipo</label>
                                <center>
                                    <img src="{{url('storage/'.$configuracion->logotipo)}}" alt="logotipo" width="350px">
                                </center>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{url('admin/configuracion')}}" class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection