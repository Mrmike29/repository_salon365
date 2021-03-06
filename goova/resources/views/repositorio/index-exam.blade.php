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
                            @if(Auth::user()->id_rol == 2 || Auth::user()->id_rol == 3 || Auth::user()->id_rol == 4)
                                <h1>Revisar Examenes</h1>
                            @else
                                <h1>Ver Examenes</h1>
                            @endif
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
                                                            <select class="niceSelect w-100 bb form-control valid-request" name="id_teacher" id="id_teacher">
                                                                <option data-display="Seleccionar Profesor *" value="">Section *</option>
                                                                @foreach($profesores as $key => $val)
                                                                    <option value="{{$val->id}}">{{$val->name}} {{$val->last_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                        <span class="modal_input_validation red_alert"></span>
                                                    </div>
                                                @endif
                                                <div class="form-group @if(!empty($profesores) && Auth::user()->id_rol <> 5){{'col-lg-4'}}@else{{'col-lg-6'}}@endif">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control valid-request" name="id_subjects" id="id_subjects">
                                                            <option data-display="Seleccionar Asignatura *" value="">Section *</option>
                                                            @if(empty($profesores))
                                                                @foreach($materias as $key => $val)
                                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                    <span class="modal_input_validation red_alert"></span>
                                                </div>
                                                @if(Auth::user()->id_rol <> 5)
                                                    <div class="form-group @if(!empty($profesores)){{'col-lg-4'}}@else{{'col-lg-6'}}@endif">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <select class="niceSelect w-100 bb form-control valid-request" name="id_theme_time" id="id_theme_time">
                                                                <option data-display="Seleccionar Tema *" value="">Section *</option>
                                                            </select>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                        <span class="modal_input_validation red_alert"></span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <button type="button" class="primary-btn small goova-bt" id="submit-all" data-toggle="tooltip" title="">
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
                                                    <th>Fecha Limite de Entrega</th>
                                                    <th>Estado</th>
                                                    <th class="noExport">Acciones</th>
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
                                                    <th>Asignatura</th>
                                                    <th>Estudiante</th>
                                                    <th>Grado</th>
                                                    <th>Fecha Limite de Entrega</th>
                                                    <th>Estado</th>
                                                    <th class="noExport">Acciones</th>
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
        <form style="display: none" action="/realizar_examen" method="POST" id="form">
            @csrf
            <input type="hidden" id="id" name="id" value=""/>
            <input type="hidden" id="exam" name="exam" value=""/>
        </form>
        <div class="modal fade admin-query" id="examCourseModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center" id="descripcion">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade admin-query" id="modal-msg-student" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center" id="descripcion">
                            <?=session('status')?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
        <script>
            /** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
            (function( $ ){ 
                $.fn.mValid = function(data) { 
                    // console.log($(this).attr('name') + ' = ' + $(this).val());

                    data.text = $.trim($(this).val()) === ''? data.text : ''; 
                    $(this).parents('div.input-effect').siblings('span').text(data.text); 
                    return ($.trim($(this).val()) === ''); 
                }; 
            })( jQuery );
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
                                url: "/buscar_tema_exam/"+subject+"/"+theme+"/"+teacher,
                                dataSrc: ""
                            },
                            columns: [
                                { data: "name_theme" },
                                @if(Auth::user()->id_rol <> 5)
                                    { data: "name_subject" },
                                    { data: "name_students" },
                                    { data: "name_list" },
                                @else
                                    { data: "name_teacher" },
                                @endif
                                { data: "date_end" },
                                { data: "status" },
                                { 
                                    data: "id_questions_students",
                                    render: function (data, type, row, meta) {
                                        @if(Auth::user()->id_rol == 5)
                                            if(row.status == "Calificado"){
                                                return `<button data-id='${data}' data-s='${row.id_students}' data-n='${row.note}' type='button' class='primary-btn small goova-bt view_exam_course'>Ver Nota</button>`
                                            }
                                            if(row.status == "Entregado" || row.status == "Vencido"){
                                                return `<button data-id='${data}' data-s='${row.id_students}' type='button' class='primary-btn small goova-bt view_exam_course'>Ver</button>`
                                            }
                                            if(row.status == "Pendiente"){
                                                if(data){
                                                    return `<button data-id='${data}' data-s='${row.id_students}' type='button' class='primary-btn small goova-bt view_exam_course'>Ver</button>`
                                                }else{
                                                    return `<button data-id='${data}' data-exam='${row.id_exam}' type='button' class='primary-btn small goova-bt go_up_exam_course'>Realizar</button>`
                                                }
                                            }
                                        @else
                                            if(row.status == "Calificado"){
                                                return `<button data-id='${data}' data-s='${row.id_students}' data-n='${row.note}' type='button' class='primary-btn small goova-bt view_exam_course'>Ver</button>`
                                            }else{
                                                return `<button data-id='${data}' data-s='${row.id_students}' type='button' class='primary-btn small goova-bt view_exam_course'>Ver</button>`
                                            }
                                        @endif
                                    }
                                }
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
                    url: '/materias_profesores_exam/'+id,
                    type: 'get',
                    success:function(dato){
                        var html = '<option data-display="Seleccionar Asignatura *" value="">Section *</option>'
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
                    url: '/temas_materias_exam/'+id+'/'+teacher,
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
                var res = true
                $('select.valid-request').each(function(){
                    var sel =   $(this).mValid({
                                    text: 'Campo vacío'
                                })
                    if(sel == true){
                        res = false
                    }
                })
                if(res){
                    if(table){
                        table.destroy();
                    }
                    tables()
                    $('#show-table').show()
                }
            })
            $(document).on('click','.go_up_exam_course',function(){
                var id = $(this).data('id')
                var exam = $(this).data('exam')
                $('#form input[name=id]').val(id)
                $('#form input[name=exam]').val(exam)
                $('#form').submit()
            })
            $(document).on('click','.view_exam_course',function(){
                var id = $(this).data('id')
                var user = $(this).data('s')
                var note = $(this).data('n')
                if(id && id !== 'undefined'){
                    $.ajax({
                        url: '/ver_nota/'+id+'/'+user,
                        type: 'get',
                        success:function(dato){
                            if(dato){
                                window.location.href = '/ver_respuestas_examen/'+id+'/'+user
                            }else{
                                @if(Auth::user()->id_rol == 4)
                                    window.location.href = '/respuestas_examen/'+id
                                @else
                                    $('#examCourseModal .modal-body #descripcion').html('<h4>Aún no se ha calificado</h4>')
                                    $('#examCourseModal').modal()
                                @endif
                            }
                        }
                    })
                }else if(note !== 'undefined'){
                    $('#examCourseModal .modal-body #descripcion').html(`<h4>Nota: ${note}</h4><h5 style="color: red;">Este examne no se presento</h5>`)
                    $('#examCourseModal').modal()
                }else{
                    $('#examCourseModal .modal-body #descripcion').html('<h4>Aún no lo ha realizado</h4>')
                    $('#examCourseModal').modal()
                }
            })
            @if(session('status'))
                $('#modal-msg-student').modal('show')
            @endif
        </script>
    </body>
</html>