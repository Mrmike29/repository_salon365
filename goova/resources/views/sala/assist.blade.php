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
                <section class="admin-visitor-area">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/crear_tarea" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <div class="row">
                                                @if(Auth::user()->id_rol != 4 )
                                                    <div class="form-group col-lg-4">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <select class="niceSelect w-100 bb form-control" name="id_teacher" id="id_teacher">
                                                                <option data-display="Seleccionar Profesor *" value="">Section *</option>
                                                                @foreach($teacher as $key => $value)
                                                                    <option value="{{$value->id}}">{{$value->name}} {{$value->last_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="form-group @if(Auth::user()->id_rol <> 5){{'col-lg-4'}}@else{{'col-lg-6'}}@endif">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_subjects" id="id_subjects">
                                                            <option data-display="Seleccionar Asignatura *" value="">Section *</option>
                                                            @foreach($asignatura as $key => $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                @if(Auth::user()->id_rol <> 5)
                                                    <div class="form-group @if(Auth::user()->id_rol==5){{'col-lg-4'}}@else{{'col-lg-6'}}@endif">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <select class="niceSelect w-100 bb form-control" name="id_curso" id="id_theme_time">
                                                                <option data-display="Seleccionar Curso *" value="">Section *</option>
                                                                @foreach($curso as $key => $value)
                                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <button type="button" class="primary-btn small goova-bt" id="filter_search" data-toggle="tooltip" title="">
                                                    <span class="ti-search"></span>
                                                    Buscar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                                <th>Curso</th>
                                                <th>Fecha de Inicio</th>
                                                <th>Asignatura</th>
                                                <th>Materia</th>
                                                <th>Estado</th>
                                                <th class="noExport">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
       

        @include('includes.footer')
        <script>

            // function search_filter(){
            //     var teacher=$('select[name=id_teacher]').val()
            //     var curso=$('select[name=id_curso]').val()
            //     var subjects=$('select[name=id_subjects]').val()
            //     $.ajax({
            //         url:'/room_filter',
            //         type:'GET',
            //         data:{id_teahcer:teacher,id_curso:curso,id_subjects:subjects},
            //         beforeSend:function(){
            //             $('tbody').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">Cargando...</td></tr>')
            //         },
            //         success:function(data){
            //             $('tbody').html(data)
            //         }
            //     })

            //     table.destroy();
            //     setTimeout(function(){
            //         reloadTable();
            //     },200)
                
            // }

            // $('tbody').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">Cargando...</td></tr>')


            $('#filter_search').click(function(){
                search_filter()
            })

            function reloadTable(){
                table=$('#table_users').DataTable({
                    bLengthChange: false,
                    paging: true,
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
            }
            reloadTable();
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
