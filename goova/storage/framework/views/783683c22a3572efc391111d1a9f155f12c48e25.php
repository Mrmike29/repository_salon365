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
                            <h1>Usuarios</h1>
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
                                                <th>Tipo de Documento</th>
                                                <th>Documento</th>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Rol</th>
                                                <th>Estado</th>
                                                <th>Telefono</th>
                                                <th>Dirrección</th>
                                                <th class="noExport">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($val->type_document); ?></td>
                                                    <td><?php echo e($val->document); ?></td>
                                                    <td><?php echo e($val->name); ?> <?php echo e($val->last_name); ?></td>
                                                    <td><?php echo e($val->email); ?></td>
                                                    <td><?php echo e($val->rol); ?></td>
                                                    <td><?php echo e($val->state); ?></td>
                                                    <td><?php echo e($val->phone); ?></td>
                                                    <td><?php echo e($val->address); ?></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                                Seleccionar
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="/editar_usuario/<?php echo e($val->id); ?>">Editar</a>
                                                                <?php if($val->state == "HABILITADO"): ?>
                                                                    <a class="dropdown-item inhabilitar_user" data-id="<?php echo e($val->id); ?>" data-toggle="modal" data-target="#inhabilitarUserModal" href="#">Inhabilitar</a>
                                                                <?php else: ?>
                                                                    <a class="dropdown-item habilitar_user" data-id="<?php echo e($val->id); ?>" data-toggle="modal" data-target="#habilitarUserModal" href="#">Habilitar</a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php echo csrf_field(); ?>
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
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="" id="student_habilitar">
                                <button class="primary-btn goova-bt" type="submit">Aceptar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            $('.inhabilitar_user').click(function(){
                var id = $(this).data('id')
                $('.modal#inhabilitarUserModal form input[name=id]').val(id)
            })
            $('.habilitar_user').click(function(){
                var id = $(this).data('id')
                $('.modal#habilitarUserModal form input[name=id]').val(id)
            })
        </script>
    </body>
</html>
<?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/usuarios/index.blade.php ENDPATH**/ ?>