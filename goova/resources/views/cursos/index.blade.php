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
                            <h1>Cursos</h1>
                        </div>
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
                                                <th>Nombre</th>
                                                <th>Estudiantes</th>
                                                <th>Profesores</th>
                                                <th>Director de Grupo</th>
                                                <th class="noExport">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $key => $val)
                                                <tr>
                                                    <td>{{$val->name}}</td>
                                                    <td><button data-id="{{$val->id_list}}" type="button" class="primary-btn small goova-bt view_students">Visualizar Estudiantes</button></td>
                                                    <td><button data-id="{{$val->id_course}}" type="button" class="primary-btn small goova-bt view_teachers">Visualizar Profesores</button></td>
                                                    <td>{{$val->name_leader}} {{$val->last_name_leader}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                                Seleccionar
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="/editar_cursos/{{$val->id_course}}">Editar</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
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
        <div class="modal fade admin-query" id="inhabilitarUserModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">INHABILITAR USUARIO</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h4>¿Estás segura de inhabilitar este usuario?</h4>
                        </div>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancelar</button>
                            <form method="POST" action="/inhabilitar_usuario" accept-charset="UTF-8" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="" id="student_inhabilitar">
                                <button class="primary-btn goova-bt" type="submit">Aceptar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade admin-query" id="habilitarUserModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">HABILITAR USUARIO</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h4>¿Estás segura de habilitar este usuario?</h4>
                        </div>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancelar</button>
                            <form method="POST" action="/habilitar_usuario" accept-charset="UTF-8" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="" id="student_habilitar">
                                <button class="primary-btn goova-bt" type="submit">Aceptar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade admin-query" id="studentsModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ESTUDIANTES</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade admin-query" id="teachersModal" >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">PROFESORES</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
        <script>
            $('#table_users').DataTable({
                bLengthChange: false,
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
            $('.inhabilitar_user').click(function(){
                var id = $(this).data('id')
                $('.modal#inhabilitarUserModal form input[name=id]').val(id)
            })
            $('.habilitar_user').click(function(){
                var id = $(this).data('id')
                $('.modal#habilitarUserModal form input[name=id]').val(id)
            })
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
            $(document).on('click','.view_teachers',function(){
                var id = $(this).data('id')
                $.ajax({
                    url: '/view_teachers_course/'+id,
                    type: 'get',
                    success:function(dato){
                        var html = `<table class="table">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Nombre</th>
                                                <th>Asignatura</th>
                                                <th>Horas Semanas</th>
                                            </tr>
                                        </thead>
                                        <tbody>`
                            if(dato != 0){
                                $(dato).each(function(k,v){
                                    html += `<tr>
                                                <td>${v.document}</td>
                                                <td>${v.name} ${v.last_name}</td>
                                                <td>${v.subject}</td>
                                                <td>${v.hour_week}</td>
                                            </tr>`
                                })
                            }else{
                                    html += `<tr>
                                                <td colspan="3"><center>Ningún dato disponible</center></td>
                                            </tr>`
                            }
                                html += `</tbody>
                                    </table>`
                        $('#teachersModal .modal-body').html(html)
                        $('#teachersModal').modal('show')
                    }
                })
            })
        </script>
    </body>
</html>
