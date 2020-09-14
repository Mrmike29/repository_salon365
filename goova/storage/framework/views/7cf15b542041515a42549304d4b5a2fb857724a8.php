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
                            <h1>Crear Curso</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area up_st_admin_visitor">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/update_cursos" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="" id="append_campos">
                                            <div class="row mb-30">
                                                <div class="form-group col-lg-9">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input type="hidden" name="id" value="<?php echo e($course->id); ?>">
                                                                <input class="primary-input form-control" type="text" name="name" value="<?php echo e($course->name); ?>" required>
                                                                <label>Nombre <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="primary-btn goova-bt" data-toggle="tooltip" title="">
                                                    <span class="ti-check"></span>
                                                    Guardar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script>
            $(document).on('click','.plus',function(){
                var html = `<div class="row mb-30">
                                <div class="form-group col-lg-5">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <select class="niceSelect w-100 bb form-control" name="id_subjects[]" id="classSelectStudent" required>
                                            <option data-display="Seleccionar Asignatura *" value="">Select</option>
                                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-5">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <select class="niceSelect w-100 bb form-control" name="id_teacher[]" id="classSelectStudent" required>
                                            <option data-display="Seleccionar Profesor *" value="">Select</option>
                                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?> <?php echo e($val->last_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <button type="button" class="btn btn-danger minus"><i class="icofont icofont-minus"></i></button>
                                    </div>
                                </div>
                            </div>`
                $('#append_campos').append(html)
                $('select.niceSelect').niceSelect();
            })
            $(document).on('click','.minus',function(){
                $(this).parent().parent().parent().remove()
            })
        </script>
    </body>
</html>
<?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/cursos/edit.blade.php ENDPATH**/ ?>