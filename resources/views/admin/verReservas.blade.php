@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de Reservas</h1>
    </div>
    <hr>
    <div class="row">

        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reservas del Sistema</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered text-center table-striped table-hover table-sm dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nro</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Fecha y hora del registro</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($eventos as $evento)
                                <tr class="odd" >
                                    <td>{{$contador++}}</td>
                                    <td>{{$evento->doctor->nombres." ".$evento->doctor->apellidos}}</td>
                                    <td>{{$evento->doctor->especialidad}}</td>
                                    <td>{{\Carbon\Carbon::parse($evento->start)->format('Y-m-d')}}</td>
                                    <td>{{\Carbon\Carbon::parse($evento->end)->format('H:i')}}</td>
                                    <td>{{$evento->created_at}}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{url('/admin/eventos/destroy', $evento->id)}}" id="formulario{{$evento->id}}" onclick="preguntar{{$evento->id}}(event)" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function preguntar{{$evento->id}}(event){
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: "¿Está seguro de eliminar este registro de reserva?",
                                                        text: "Si elimina el registro otro usuario podrá reservar en este mismo horario",
                                                        icon: "question",
                                                        showDenyButton: true,
                                                        showCancelButton: false,
                                                        confirmButtonText: "Si",
                                                        denyButtonText: `No`
                                                        }).then((result) => {
                                                        /* Read more about isConfirmed, isDenied below */
                                                        if (result.isConfirmed) {
                                                            var form = $('#formulario{{$evento->id}}');
                                                            form.submit();

                                                            //Swal.fire("Registro eliminado correctamente!", "", "success");
                                                        } else if (result.isDenied) {
                                                            Swal.fire("Los cambios fueron desechados", "", "info");
                                                        }
                                                    });
                                                }
                                            </script>
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
                                    "info": "Mostrando START a END de TOTAL Consultorios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Consultorios",
                                    "infoFiltered": "(Filtrado de MAX total Consultorios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar MENU Consultorios",
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