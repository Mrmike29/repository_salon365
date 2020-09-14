<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body class="admin">
		<div class="main-wrapper">
    		<!-- Sidebar  -->
    		<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div id="main-content">
    		    <?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <?php if(Auth::user()->id_rol == 2 || Auth::user()->id_rol == 3 || Auth::user()->id_rol == 4): ?>
                                <h1>Revisar Examenes</h1>
                            <?php else: ?>
                                <h1>Ver Examenes</h1>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/crear_tarea" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <div class="row">
                                                <?php if(!empty($profesores)): ?>
                                                    <div class="form-group col-lg-4">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <select class="niceSelect w-100 bb form-control" name="id_teacher" id="id_teacher">
                                                                <option data-display="Seleccionar Profesor *" value="">Section *</option>
                                                                <?php $__currentLoopData = $profesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?> <?php echo e($val->last_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group <?php if(!empty($profesores) && Auth::user()->id_rol <> 5): ?><?php echo e('col-lg-4'); ?><?php else: ?><?php echo e('col-lg-6'); ?><?php endif; ?>">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_subjects" id="id_subjects">
                                                            <option data-display="Seleccionar Asignatura *" value="">Section *</option>
                                                            <?php if(empty($profesores)): ?>
                                                                <?php $__currentLoopData = $materias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <?php if(Auth::user()->id_rol <> 5): ?>
                                                    <div class="form-group <?php if(!empty($profesores)): ?><?php echo e('col-lg-4'); ?><?php else: ?><?php echo e('col-lg-6'); ?><?php endif; ?>">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <select class="niceSelect w-100 bb form-control" name="id_theme_time" id="id_theme_time">
                                                                <option data-display="Seleccionar Tema *" value="">Section *</option>
                                                            </select>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
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
                                    <?php if(Auth::user()->id_rol == 5): ?>
                                        <table id="table_users" class="school-table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Profesor</th>
                                                    <th>Fecha Limite de Entrega</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <table id="table_users" class="school-table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Asignatura</th>
                                                    <th>Estudiante</th>
                                                    <th>Grado</th>
                                                    <th>Fecha Limite de Entrega</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <form style="display: none" action="/realizar_examen" method="POST" id="form">
            <?php echo csrf_field(); ?>
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
        <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                url: "/buscar_tema_exam/"+subject+"/"+theme+"/"+teacher,
                                dataSrc: ""
                            },
                            columns: [
                                { data: "name_theme" },
                                <?php if(Auth::user()->id_rol <> 5): ?>
                                    { data: "name_subject" },
                                    { data: "name_students" },
                                    { data: "name_list" },
                                <?php else: ?>
                                    { data: "name_teacher" },
                                <?php endif; ?>
                                { data: "date_end" },
                                { data: "status" },
                                { 
                                    data: "id_questions_students",
                                    render: function (data, type, row, meta) {
                                        <?php if(Auth::user()->id_rol == 5): ?>
                                            if(row.status == "Entregado" || row.status == "Vencido" || row.status == "Calificado"){
                                                return `<button data-id='${data}' data-s='${row.id_students}' type='button' class='primary-btn small goova-bt view_exam_course'>Ver</button>`
                                            }
                                            if(row.status == "Pendiente"){
                                                if(data){
                                                    return `<button data-id='${data}' data-s='${row.id_students}' type='button' class='primary-btn small goova-bt view_exam_course'>Ver</button>`
                                                }else{
                                                    return `<button data-id='${data}' data-exam='${row.id_exam}' type='button' class='primary-btn small goova-bt go_up_exam_course'>Realizar</button>`
                                                }
                                            }
                                        <?php else: ?>
                                            return `<button data-id='${data}' data-s='${row.id_students}' type='button' class='primary-btn small goova-bt view_exam_course'>Ver</button>`
                                        <?php endif; ?>
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
                
                if(table){
                    table.destroy();
                }
                tables()
                $('#show-table').show()
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
                if(id && id !== 'undefined'){
                    $.ajax({
                        url: '/ver_nota/'+id+'/'+user,
                        type: 'get',
                        success:function(dato){
                            console.log(dato)
                            if(dato){
                                window.location.href = '/ver_respuestas_examen/'+id+'/'+user
                                // $('#examCourseModal .modal-body #descripcion').html(`<h3>${dato.value}</h3>`)
                                // $('#examCourseModal').modal()
                            }else{
                                <?php if(Auth::user()->id_rol == 4): ?>
                                    window.location.href = '/respuestas_examen/'+id
                                <?php else: ?>
                                    $('#examCourseModal .modal-body #descripcion').html('<h4>Aún no se ha calificado</h4>')
                                    $('#examCourseModal').modal()
                                <?php endif; ?>
                            }
                        }
                    })
                }else{
                    $('#examCourseModal .modal-body #descripcion').html('<h4>Aún no lo ha realizado</h4>')
                    $('#examCourseModal').modal()
                }
            })
        </script>
    </body>
</html><?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/repositorio/index-exam.blade.php ENDPATH**/ ?>