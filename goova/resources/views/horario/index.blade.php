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
                                                @if(Auth::user()->id_rol != 4 || Auth::user()->id_rol == 3)
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
                                                <!-- @if(Auth::user()->id_rol <> 5)
                                                    <div class="form-group col-lg-4">
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
                                                @endif -->
                                                <div class="form-group col-lg-4">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_subjects" id="id_subjects">
                                                            <option data-display="Seleccionar Asignatura *" value="">Section *</option>
                                                            @if(Auth::user()->id_rol == 5 || Auth::user()->id_rol == 4)
                                                                @foreach($asignatura as $key => $value)
                                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                @if(Auth::user()->id_rol <> 5)
                                                    <div class="form-group @if(!empty($profesores)){{'col-lg-4'}}@else{{'col-lg-6'}}@endif">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <select class="niceSelect w-100 bb form-control" name="id_theme_time" id="id_theme_time">
                                                                <option data-display="Seleccionar Tema *" value="">Section *</option>
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
                            <div class="p-0 col-md-12">
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
                                            @foreach ($room as $key => $val)
                                                @if(date('Y-m-d') <= date('Y-m-d',strtotime($val->fecha)))
                                                    <tr>
                                                        @if($tipo!="Administrador" && $tipo!="Profesor")
                                                            <td>{{$val->nombre}} {{$val->apellido}}</td>
                                                        @endif
                                                        <td>{{$val->listado}}</td>
                                                        <td>{{$val->fecha}}</td>
                                                        <td>{{$val->asignatura}}</td>
                                                        <td>{{$val->materia}}</td>
                                                        <td>{{$val->status}}</td>
                                                        <td><button data-id="{{$val->id_list_students}}" type="button" class="primary-btn small goova-bt view_students">Visualizar Estudiantes</button></td>
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
        <div class="modal fade admin-query" id="studentsModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ESTUDIENTES</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>

        @include('includes.footer')
        <script>

            function search_filter(){
                if(($('select[name=id_teacher]').length > 0)){
                    var teacher=$('select[name=id_teacher]').val()
                }else{
                    var teacher=0
                }
                if(($('select[name=id_teacher]').length > 0)){
                    var curso=$('select[name=id_curso]').val()
                }else{
                    var curso=0
                }
                var subjects=$('select[name=id_subjects]').val()
                var tema=$('select[name=id_theme_time]').val()
                $.ajax({
                    url:'/room_filter',
                    type:'GET',
                    data:{id_teahcer:teacher,id_curso:curso,id_subjects:subjects,id_themes_time:tema},
                    beforeSend:function(){
                        $('tbody').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">Cargando...</td></tr>')
                    },
                    success:function(data){
                        $('tbody').html(data)
                    }
                })
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
            }

            // $('tbody').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">Cargando...</td></tr>')
            $(document).on('change','select[name=id_teacher]',function(){
                var id = $(this).val()
                $.ajax({
                    url: '/materias_profesores/'+id,
                    type: 'get',
                    success:function(dato){
                        var html = '<option data-display="Seleccionar Materia *" value="">Section *</option>'
                        $(dato).each(function(k,v){
                            html += `<option value="${v.id}">${v.name}</option>`
                        })
                        $('select[name=id_subjects]').html(html)
                        $('select[name=id_subjects]').niceSelect('update');
                    }
                })
            })
            // $(document).on('change','select[name=id_subjects]',function(){
            //     var id = $(this).val()
            //     $.ajax({
            //         url: '/materias_tereas/'+id,
            //         type: 'get',
            //         success:function(dato){
            //             var html = '<option data-display="Seleccionar Asignatura *" value="">Section *</option>'
            //             $(dato).each(function(k,v){
            //                 html += `<option value="${v.id}">${v.subjects} - ${v.teacher} ${v.last_name}</option>`
            //             })
            //             $('select[name=id_subject]').html(html)
            //             $('select[name=id_subject]').niceSelect('update');
            //         }
            //     })
            // })
            $(document).on('change','select[name=id_subjects]',function(){
                var id = $(this).val()
                if(($('select[name=id_teacher]').length > 0)){
                    var teacher = $('select[name=id_teacher]').val()
                }else{
                    var teacher = 0
                }
                $.ajax({
                    url: '/temas_materias/'+id+'/'+teacher,
                    type: 'get',
                    success:function(dato){
                        var html = '<option data-display="Seleccionar Tema *" value="">Section *</option>'
                        $(dato).each(function(k,v){
                            html += `<option value="${v.id}">${v.name} ${v.name_list}</option>`
                        })
                        $('select[name=id_theme_time]').html(html)
                        $('select[name=id_theme_time]').niceSelect('update');
                    }
                })
            })
            // $(document).on('change','select[name=id_subjects]',function(){
            //     var id = $(this).val()
            //     var con = $('select[name=id_subjects]').val()
            //     $.ajax({
            //         url: '/temas_tereas/'+id+'/'+con,
            //         type: 'get',
            //         success:function(dato){
            //             var html = '<option data-display="Seleccionar Tema *" value="">Section *</option>'
            //             $(dato).each(function(k,v){
            //                 html += `<option value="${v.id}">${v.name}</option>`
            //             })
            //             $('select[name=id_theme_time]').html(html)
            //             $('select[name=id_theme_time]').niceSelect('update');
            //         }
            //     })
            // })

            $('#filter_search').click(function(){
                search_filter()
            })

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
            $(document).on('click','.view_students',function(){
                var id = $(this).data('id')
                $.ajax({
                    url: '/view_students_course/'+id,
                    type: 'get',
                    success:function(dato){
                        var html = `<table class="table">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Nombre</th>
                                            </tr>
                                        </thead>
                                        <tbody>`
                            if(dato != 0){
                                $(dato).each(function(k,v){
                                    html += `<tr>
                                                <td>${v.document}</td>
                                                <td>${v.name} ${v.last_name}</td>
                                            </tr>`
                                })
                            }else{
                                    html += `<tr>
                                                <td colspan="2"><center>Ningún dato disponible</center></td>
                                            </tr>`
                            }
                                html += `</tbody>
                                    </table>`
                        $('#studentsModal .modal-body').html(html)
                        $('#studentsModal').modal('show')
                    }
                })
            })
        </script>
    </body>
</html>
