@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Eliminar configuración</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Está seguro de eliminar este registro?</h3>
                </div>
                
                <div class="card-body">
                    <form action="{{url('/admin/configuracion',$configuracion->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-6">
                                    <div class="form group">
                                        <label for="">Nombre de la Clínica/Hospital</label>
                                        <input type="text" value="{{$configuracion->nombre}}" name="nombre" class="form-control" disabled>
                                        @error('nombre')
                                            <small style="color:red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-6">
                                    <div class="form group">
                                        <label for="">Dirección</label>
                                        <input type="address" value="{{$configuracion->direccion}}" name="direccion" class="form-control" disabled>
                                        @error('direccion')
                                            <small style="color:red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-6">
                                    <div class="form group">
                                        <label for="">Teléfono</label>
                                        <input type="text" value="{{$configuracion->telefono}}" name="telefono" class="form-control" disabled>
                                        @error('telefono')
                                            <small style="color:red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-6">
                                    <div class="form group">
                                        <label for="">Correo</label>
                                        <input type="email" value="{{$configuracion->correo}}" name="correo" class="form-control" disabled>
                                        @error('correo')
                                            <small style="color:red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Logotipo</label>
                                    <center>
                                        <output id="list">
                                            <img src="{{url('storage/'.$configuracion->logotipo)}}" alt="logotipo" width="100%">
                                        </output>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{url('admin/configuracion')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-danger">Eliminar configuracion</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection