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
                            <h1>Agragar Tarea</h1>
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
                                                @if(!empty($profesores))
                                                    <div class="form-group col-lg-4">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <select class="niceSelect w-100 bb form-control" name="id_teacher" id="id_teacher">
                                                                <option data-display="Seleccionar Profesor *" value="">Section *</option>
                                                                @foreach($profesores as $key => $val)
                                                                    <option value="{{$val->id}}">{{$val->name}} {{$val->last_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="form-group @if(!empty($profesores) && Auth::user()->id_rol <> 5){{'col-lg-4'}}@else{{'col-lg-6'}}@endif">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_subjects" id="id_subjects">
                                                            <option data-display="Seleccionar Materia *" value="">Section *</option>
                                                            @if(empty($profesores))
                                                                @foreach($materias as $key => $val)
                                                                    <option value="{{$val->id}}">{{$val->name}}</option>
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
                                                <button type="button" class="primary-btn small fix-gr-bg" id="submit-all" data-toggle="tooltip" title="">
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
                <section id="show-table" class="admin-visitor-area up_st_admin_visitor mt-40">
                    <div class="container-fluid p-0">
                        <div class="row m-0">
                            <div class="p-0 col-md-12">
                                <div class="white-box mt-10">
                                    @if(Auth::user()->id_rol == 5)
                                        <table id="table_users" class="school-table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Profesor</th>
                                                    <th>Ver Tarea</th>
                                                    <th>Fecha Limite de Entrega</th>
                                                    <th>Entrega Tarea</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    @else
                                        <table id="table_users" class="school-table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Materia</th>
                                                    <th>Estudiante</th>
                                                    <th>Grado</th>
                                                    <th>Ver Tarea</th>
                                                    <th>Fecha Limite de Entrega</th>
                                                    <th>Entrega Tarea</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="modal fade admin-query" id="homeworkModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center" id="descripcion">
                        </div>
                        <div class="text-center" id="archivos">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade admin-query" id="homeworkCourseModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center" id="descripcion">
                        </div>
                        <div class="text-center" id="archivos">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade admin-query" id="goUpHomeworkCourseModal" >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ENTREGA DE ACTIVIDAD</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                            <div class="text-center" id="descripcion">
                            </div>
                            <div class="text-center" id="archivos">
                            </div>
                        </form>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancelar</button>
                                {{-- <input type="hidden" name="id" value="" id="student_inhabilitar"> --}}
                            <button class="primary-btn fix-gr-bg" id="submit">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
        <script>
            $('#show-table').hide()
            var table = null
            function tables() {
                var subject = $('select[name=id_subjects]').val()
                if(($('select[name=id_theme_time]').length > 0)){
                    var theme = $('select[name=id_theme_time]').val()
                }else{
                    var them = 0
                }
                if(($('select[name=id_teacher]').length > 0)){
                    var teacher = $('select[name=id_teacher]').val()
                }else{
                    var teacher = 0
                }
                table = $('#table_users').DataTable({
                            bLengthChange: false,
                            processing: true,
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
                            ajax: {
                                url: "/buscar_tema/"+subject+"/"+theme+"/"+teacher,
                                dataSrc: ""
                            },
                            columns: [
                                { data: "name_theme" },
                                @if(Auth::user()->id_rol <> 5)
                                    { data: "name_subject" },
                                @endif
                                { data: "name_students" },
                                @if(Auth::user()->id_rol <> 5)
                                    { data: "name_list" },
                                @endif
                                { 
                                    data: "id_homework",
                                    render: function (data, type, row, meta) {
                                        return `<button data-id='${data}' type='button' class='primary-btn small fix-gr-bg view_homework'>Ver</button>`
                                    }
                                },
                                { data: "limit_time" },
                                { 
                                    data: "id_homework_course",
                                    render: function (data, type, row, meta) {
                                        @if(Auth::user()->id_rol == 5)
                                            if(row.status == "Entregado" || row.status == "Vencido"){
                                                return `<button data-id='${data}' type='button' class='primary-btn small fix-gr-bg view_homework_course'>Ver</button>`
                                            }
                                            if(row.status == "Pendiente"){
                                                if(data){
                                                    return `<button data-id='${data}' type='button' class='primary-btn small fix-gr-bg view_homework_course'>Ver</button>`    
                                                }else{
                                                    return `<button data-id='${data}' data-homework='${row.id_homework}' type='button' class='primary-btn small fix-gr-bg go_up_homework_course'>Subir</button>`
                                                }
                                            }
                                        @else
                                            return `<button data-id='${data}' type='button' class='primary-btn small fix-gr-bg view_homework_course'>Ver</button>`
                                        @endif
                                    }
                                },
                                { data: "status" }
                            ],
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
            }
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
            $(document).on('click','#submit-all',function(){
                if(table){
                    table.destroy();
                }
                tables()
                $('#show-table').show()
            })
            $(document).on('click','.view_homework',function(){
                var id = $(this).data('id')
                $.ajax({
                    url: '/buscar_tarea/'+id,
                    type: 'get',
                    success:function(dato){
                        $('#homeworkModal .modal-body #descripcion').html(dato.tarea.description)
                        var html = `<div class="row">`
                        $(dato.archivos).each(function(k, v){
                            html += `<div class="col-md-3"><center><i class="icofont icofont-file-alt" style="font-size: 35px;"></i><br><a href="${v.description}" download>Descargar</a></center></div>`
                        })
                        $('#homeworkModal .modal-body #archivos').html(html)
                        $('#homeworkModal').modal()
                    }
                })
            })
            $(document).on('click','.view_homework_course',function(){
                var id = $(this).data('id')
                if(id){
                    $.ajax({
                        url: '/buscar_tarea_curso/'+id,
                        type: 'get',
                        success:function(dato){
                            $('#homeworkCourseModal .modal-body #descripcion').html(dato.tarea.description)
                            var html = `<div class="row">`
                            $(dato.archivos).each(function(k, v){
                                html += `<div class="col-md-3"><center><i class="icofont icofont-file-alt" style="font-size: 35px;"></i><br><a href="${v.description}" download>Descargar</a></center></div>`
                            })
                            $('#homeworkCourseModal .modal-body #archivos').html(html)
                            $('#homeworkCourseModal').modal()
                        }
                    })
                }else{
                    $('#homeworkCourseModal .modal-body #descripcion').html('<h4>No hay ningún elemento</h4>')
                    $('#homeworkCourseModal .modal-body #archivos').html('')
                    $('#homeworkCourseModal').modal()
                }
            })
            function option_homework()
            {
                Dropzone.autoDiscover = false;
                jQuery(document).ready(function() {
                    var uploadedDocumentMap = {}
                    $("div#my-awesome-dropzone").dropzone({
                        url: "/archivo",
                        dictDefaultMessage: "Agrege los archivos de la tarea",
                        addRemoveLinks: true,
                        dictRemoveFile: "Eliminar archivo",
                        // maxfilesexceeded: 5024,
                        maxFilesize: 5,
                        dictFileTooBig: "El tamaño maximo de archivos es de 5MB.",
                        // autoProcessQueue: false,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function (file, response) {
                            $('#goUpHomeworkCourseModal .modal-body form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                            uploadedDocumentMap[file.name] = response.name
                        },
                        removedfile: function (file) {

                            var name = ''
                            if (typeof file.file_name !== 'undefined') {
                                name = file.file_name
                            } else {
                                name = uploadedDocumentMap[file.name]
                            }

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                type: 'POST',
                                url: '/delete_archivo',
                                data: {filename: name},
                                success: function (data){
                                    console.log("File deleted successfully!!");
                                },
                                error: function(e) {
                                    console.log(e);
                                }
                            });
                            file.previewElement.remove()

                            $('#goUpHomeworkCourseModal .modal-body form').find('input[name="document[]"][value="' + name + '"]').remove()
                        }
                    });
                });
                var editor = new FroalaEditor('#textarea textarea', {
                    language: 'es',
                    fontFamilyDefaultSelection: 'Font',
                    fontFamily: {
                        'Arial,Helvetica,sans-serif': 'Arial',
                        'Georgia,serif': 'Georgia',
                        'Impact,Charcoal,sans-serif': 'Impact',
                        'Tahoma,Geneva,sans-serif': 'Tahoma',
                        "'Times New Roman',Times,serif": 'Times New Roman',
                        'Verdana,Geneva,sans-serif': 'Verdana',
                        "'Open Sans Condensed',sans-serif": 'Open Sans Condensed',
                        "'Century Gothic', Futura, sans-serif": 'Century Gothic'
                    }
                } );
            }
            $(document).on('click','.go_up_homework_course',function(){
                var id = $(this).data('homework')
                var html = `@csrf
                            <div class="row">
                                <input type="hidden" name="id_homework" value="${id}">
                                <div class="form-group col-lg-12">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div><br>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <div class="form-group" id="textarea">
                                            <textarea id="texto" name="description" id="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                $('#goUpHomeworkCourseModal .modal-body form').html(html)
                option_homework()
                $('#goUpHomeworkCourseModal').modal('show')
            })
            $(document).on('click','#goUpHomeworkCourseModal .modal-body #submit', function(){
                $.ajax({
                    url: '/subir_tarea',
                    type: 'post',
                    data: $('#goUpHomeworkCourseModal .modal-body form').serialize(),
                    success:function(dato){
                        if(dato == 1){
                            $('#submit-all').trigger('click')
                            $('#goUpHomeworkCourseModal').modal('hide')
                        }
                    }
                })
            })
        </script>
    </body>
</html>
