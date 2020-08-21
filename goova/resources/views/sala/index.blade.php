<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body class="admin">
		<div class="main-wrapper">
    		<!-- Sidebar  -->
    		@include('includes.sidebar')
            <div id="main-content">
    		    @include('includes.header')
                
                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <h1>Salas</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area up_st_admin_visitor">
                    <div class="container-fluid p-0">
                        <div class="row m-0">
                            <div class="p-0 col-md-11">
                                <div class="white-box mt-10">
                                    <table id="table_users" class="school-table">
                                        <thead>
                                            <tr>
                                                @if($tipo!="Administrador" && $tipo!="Profesor")
                                                    <th>Nombre Profesor </th>
                                                @endif
                                                <th>Listado</th>
                                                <th>Fecha de Inicio</th>
                                                <th>Asignatura</th>
                                                <th>Estado</th>
                                                <th class="noExport">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($room as $key => $val)
                                                @if(date('Y-m-d') <= date('Y-m-d',strtotime($val->fecha)))
                                                    <tr>
                                                        @if($tipo!="Administrador" && $tipo!="Profesor")
                                                            <td>{{$val->nombre}} {{$val->apellido}}</td>
                                                        @endif
                                                        <td>{{$val->listado}}</td>
                                                        <td>{{$val->fecha}}</td>
                                                        <td>{{$val->asignatura}}</td>
                                                        <td>{{$val->status}}</td>
                                                        <td>
                                                            
                                                            <div class="dropdown">
                                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                                    Seleccionar
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a href="/editar/sala/{{encrypt($val->id)}}" class="dropdown-item">Editar</button>
                                                                    <a href="/ingresar/sala/{{encrypt($val->id)}}" class="dropdown-item">Ingresar</button>
                                                                    @if($val->status == "HABILITADO")
                                                                        <a class="dropdown-item inhabilitar_sala" data-id="{{encrypt($val->id)}}" data-toggle="modal" data-target="#inhabilitarSalaModal" href="#">Inhabilitar</a>
                                                                    @else
                                                                        <a class="dropdown-item habilitar_sala" data-id="{{encrypt($val->id)}}" data-toggle="modal" data-target="#habilitarSalaModal" href="#">Habilitar</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="modal fade admin-query" id="inhabilitarSalaModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">INHABILITAR SALA</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h4>¿Estás seguro de inhabilitar esta sala?</h4>
                        </div>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancelar</button>
                            <form method="POST" action="/cambiar-estado/sala" accept-charset="UTF-8" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="" id="sala_inhabilitar">  
                                <button class="primary-btn fix-gr-bg" type="submit">Aceptar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade admin-query" id="habilitarSalaModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">HABILITAR SALA</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h4>¿Estás seguro de habilitar esta sala?</h4>
                        </div>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancelar</button>
                            <form method="POST" action="/cambiar-estado/sala" accept-charset="UTF-8" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="" id="sala_habilitar">  
                                <button class="primary-btn fix-gr-bg" type="submit">Aceptar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('includes.footer')
        <script>
            $('#table_users').DataTable({
                bLengthChange: false,
                // paging: true,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: 'Búsqueda rápida',
                    decimal: ",",
                    thousands: ".",
                    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    infoPostFix: "",
                    infoFiltered: "(filtrado de un total de _MAX_ registros)",
                    loadingRecords: "Cargando...",
                    lengthMenu: "Mostrar _MENU_ registros",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                    processing: "Procesando...",
                    zeroRecords: "No se encontraron resultados",
                    emptyTable: "Ningún dato disponible en esta tabla",
                    aria: {
                        sortAscending:  ": Activar para ordenar la columna de manera ascendente",
                        sortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        titleAttr: 'Copiar',
                        title : $("#logo_title").val(),
                        exportOptions: {
                            columns: ':visible',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title : $("#logo_title").val(),
                        exportOptions: {
                            columns: ':visible',
                            order: 'applied'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        title : $("#logo_title").val(),
                        exportOptions: {
                            columns: ':visible',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: "thead th:not(.noExport)",
                            order: 'applied',
                            columnGap: 20
                        },
                        pageSize: 'A4',
                        fontSize:10,
                        alignment: 'center',
                        header: true,
                        title : $("#logo_title").val(),
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Imprimir',
                        title : $("#logo_title").val(),
                        exportOptions: {
                            columns: ':visible',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
            });
            setTimeout( function() {
                $('#table_users').parent().parent().parent().removeClass('col-md-11').addClass('col-md-12')
            }, 80);
            $('.inhabilitar_sala').click(function(){
                var id = $(this).data('id')
                $('.modal#inhabilitarSalaModal form input[name=id]').val(id)
            })
            $('.habilitar_sala').click(function(){
                var id = $(this).data('id')
                $('.modal#habilitarSalaModal form input[name=id]').val(id)
            })
        </script>
    </body>
</html>
