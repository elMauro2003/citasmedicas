@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de Horarios</h1>
    </div>
    <hr>
    <div class="row">

        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Horarios del Sistema</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/horarios/create')}}" class="btn btn-primary">
                            Registrar Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nro</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Consultorio</th>
                                <th scope="col">Dia de atención</th>
                                <th scope="col">Hora de inicio</th>
                                <th scope="col">Hora de fin</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($horarios as $horario)
                                <tr class="odd">
                                    <td>{{$contador++}}</td>
                                    <td>{{$horario->doctor->nombres}}</td>
                                    <td>{{$horario->doctor->especialidad}}</td>
                                    <td>{{$horario->consultorio->nombre}}</td>
                                    <td>{{$horario->dia}}</td>
                                    <td>{{$horario->hora_inicio}}</td>
                                    <td>{{$horario->hora_fin}}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('admin/horarios/'.$horario->id)}}" type="button" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                            <a href="{{url('admin/horarios/'.$horario->id.'/edit')}}" type="button" class="btn btn-sm btn-success"><i class="bi bi-pencil"></i></a>
                                            <a href="{{url('admin/horarios/'.$horario->id.'/confirm-delete')}}" type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></a>
                                          </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 15,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando START a END de TOTAL Horarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Horarios",
                                    "infoFiltered": "(Filtrado de MAX total Horarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar MENU Horarios",
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
                                "responsive": true, "lengthChange": true, "autoWidth": false,
                                buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    },{
                                        extend: 'csv'
                                    },{
                                        extend: 'excel'
                                    },{
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }
                                    ]
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
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Calendario de atención de doctores</h3>
                </div>            
                <div class="card-body row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Consultorio</label>
                            <select name="consultorio_id" id="consultorio_select" class="form-control">
                                <option value="">Seleccione un consultorio</option>
                                @foreach ($consultorios as $consultorio)
                                    <option value="{{$consultorio->id}}">{{$consultorio->nombre}}</option>
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
        
                <hr>
                <div id="consultorio_info">
                </div>
            </div>
        </div>
    </div>
@endsection