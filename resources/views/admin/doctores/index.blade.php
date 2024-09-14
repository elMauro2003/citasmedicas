@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de Doctores</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Doctores del Sistema</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/doctores/create')}}" class="btn btn-primary">
                            Registrar Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nro</th>
                                <th scope="col">Nombres y Apellidos</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Licencia Medica</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Email</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($doctores as $doctor)
                                <tr class="odd">
                                    <td>{{$contador++}}</td>
                                    <td>{{$doctor->nombres}}</td>
                                    <td>{{$doctor->apellidos}}</td>
                                    <td>{{$doctor->telefono}}</td>
                                    <td>{{$doctor->licencia_medica}}</td>
                                    <td>{{$doctor->user->email}}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('admin/doctores/'.$doctor->id)}}" type="button" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                            <a href="{{url('admin/doctores/'.$doctor->id.'/edit')}}" type="button" class="btn btn-sm btn-success"><i class="bi bi-pencil"></i></a>
                                            <a href="{{url('admin/doctores/'.$doctor->id.'/confirm-delete')}}" type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></a>
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
                                    "info": "",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Doctores",
                                    "infoFiltered": "(Filtrado de MAX total Doctores)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar MENU Doctores",
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
@endsection