@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Editar historial</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Rellene los datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('/admin/historial', $historial->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for="">Paciente</label> <b>*</b>
                                            <select name="paciente_id" id="" class="form-control">
                                                @foreach ($pacientes as $paciente)
                                                    <option value="{{ $paciente->id }}"
                                                        {{ $historial->paciente->id == $paciente->id ? 'selected' : '' }}>
                                                        {{ $paciente->nombres . ' ' . $paciente->apellidos }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for="">Fecha de la cita medica</label> <b>*</b>
                                            <input type="date" name="fecha_visita" id="" class="form-control" value="{{$historial->fecha_visita}}">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form group">
                                            <label for="">Descripción de la cita</label> <b>*</b>
                                            <textarea name="detalle" id="editor" cols="30" rows="10" class="form'control" width="100%">{!!$historial->detalle!!}</textarea>
                                            <script type="importmap">
                                                {
                                                    "imports": {
                                                        "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.js",
                                                        "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.1.0/"
                                                    }
                                                }
                                            </script>
                                            <script type="module">
                                                import {
                                                    ClassicEditor,
                                                    Essentials,
                                                    Bold,
                                                    Italic,
                                                    Font,
                                                    Paragraph
                                                } from 'ckeditor5';
                                            
                                                ClassicEditor
                                                    .create( document.querySelector( '#editor' ), {
                                                        plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                                                        toolbar: {
                                                            items: [
                                                                'undo', 'redo', '|', 'bold', 'italic', '|',
                                                                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                                                            ]
                                                        }
                                                    } )
                                                    .then( /* ... */ )
                                                    .catch( /* ... */ );
                                            </script>
                                            
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
                                    <a href="{{ url('admin/historial') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
