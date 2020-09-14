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
                            <h1>Ver Examenes</h1>
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
                                                    <div class="form-group col-lg-6">
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
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_subjects" id="id_subjects">
                                                            <option data-display="Seleccionar Asignatura *" value="">Section *</option>
                                                            @if(empty($profesores))
                                                                @foreach($materias as $key => $val)
                                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
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
                                    <table id="table_users" class="school-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Tema</th>
                                                <th>Asignatura</th>
                                                <th>Curso</th>
                                                <th>Fecha Limite de Entrega</th>
                                                <th>Acciones</th>
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
        <form style="display: none" action="/ver_preguntas_examen" method="POST" id="form">
            @csrf
            <input type="hidden" id="id" name="id" value=""/>
        </form>
        @include('includes.footer')
        <script>
            $('#show-table').hide()
            var table = null
            function tables() {
                var subject = $('select[name=id_subjects]').val()
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
                                url: "/buscar_exam/"+subject+"/"+teacher,
                                dataSrc: ""
                            },
                            columns: [
                                { data: "name_theme" },
                                { data: "name_subject" },
                                { data: "name_list" },
                                { data: "date_end" },
                                { 
                                    data: "id_exam",
                                    render: function (data, type, row, meta) {
                                        return `<button data-id='${data}' type='button' class='primary-btn small goova-bt view_questions_exam'>Ver</button>`
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
            $(document).on('click','.view_questions_exam',function(){
                var id = $(this).data('id')
                $('#form input[name=id]').val(id)
                $('#form').submit()
            })
            $(document).on('change','select[name=id_subjects]',function(){
                var id = $(this).val()
                localStorage.setItem('f', id);
            })
            $(document).on('click','#submit-all',function(){
                
                if(table){
                    table.destroy();
                }
                tables()
                $('#show-table').show()
            })

            let filters = localStorage.getItem('f')

            $(document).on('click','.icofont-arrow-left',function(){
                localStorage.removeItem('f')
            })
            // localStorage.setItem('f', 1);
            // window.onhashchange(function(){
            //     if(window.history.back()){
            //         localStorage.removeItem('f')
            //     }
            // })

            if(filters !== null) {
               $('#id_subjects').val(filters); 
               $('#id_subjects').niceSelect('update')
               $('#submit-all').trigger('click');
            }
        </script>
    </body>
</html>