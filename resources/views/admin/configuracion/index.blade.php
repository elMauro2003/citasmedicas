@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de configuraciones</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Configuraciones del Sistema</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/configuracion/create') }}" class="btn btn-primary">
                            Registrar Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1"
                        class="table text-center table-bordered table-striped table-hover table-sm dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nro</th>
                                <th scope="col">Hospital/Cíinica</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Logotipo</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($configuraciones as $configuracion)
                                <tr class="odd">
                                    <td>{{ $contador++ }}</td>
                                    <td>{{ $configuracion->nombre }}</td>
                                    <td>{{ $configuracion->direccion }}</td>
                                    <td>{{ $configuracion->telefono }}</td>
                                    <td>{{ $configuracion->correo }}</td>
                                    <td>
                                        <img src="{{ url('storage/' . $configuracion->logotipo) }}" alt="logotipo"
                                            width="100px">
                                    </td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('admin/configuracion/' . $configuracion->id) }}" type="button"
                                                class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                            <a href="{{ url('admin/configuracion/' . $configuracion->id . '/edit') }}"
                                                type="button" class="btn btn-sm btn-success"><i
                                                    class="bi bi-pencil"></i></a>
                                            <a href="{{ url('admin/configuracion/' . $configuracion->id . '/confirm-delete') }}"
                                                type="button" class="btn btn-sm btn-danger"><i
                                                    class="bi bi-trash3"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(function() {
                            $("#example1").DataTable({
                                "pageLength": 15,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Consultorios",
                                    "infoFiltered": "(Filtrado de MAX total Configuraciones)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar MENU Configuraciones",
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
    </div>
@endsection
