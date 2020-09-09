<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <style>
            .common-radio:empty ~ label {
                float: unset !important;
            }
            .common-checkbox + label {
                display: inline-block !important;
                text-transform: capitalize;
                font-weight: 500;
            }
        </style>
    </head>
    <body class="admin">
		<div class="main-wrapper">
    		<!-- Sidebar -->
    		<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div id="main-content">
    		    <?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <h1>Examen</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/crear_realizar_examen" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id_exam" value="<?php echo e(encrypt($examen->id)); ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <div class="row mb-30">
                                                <?php $__currentLoopData = $preguntas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-group col-lg-12">
                                                        <p class="text-uppercase fw-500 mb-0"><?php echo e($value->description); ?></p>
                                                        <?php if($value->id_type_question == 1): ?>
                                                            <span class="mb-10" style="display: block;"><i>Por favor selecciona <?php if($value->max_answer == 1): ?><?php echo e($value->max_answer); ?> <?php echo e('opción'); ?><?php else: ?><?php echo e($value->max_answer); ?> <?php echo e('opciones'); ?><?php endif; ?></i></span>
                                                            <div class="radio-btn-flex ml-40">
                                                                <?php $__currentLoopData = $preguntas_multiples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($v->id_question == $value->id): ?>
                                                                        <div class="mr-30">
                                                                            <input type="checkbox" id="section<?php echo e($v->id); ?>" data-id="<?php echo e($value->id); ?>" data-max="<?php echo e($value->max_answer); ?>" class="common-checkbox form-control valid-limit-<?php echo e($value->id); ?>" name="respuesta[<?php echo e($value->id); ?>][]" value="<?php echo e($v->id); ?>">
                                                                            <label for="section<?php echo e($v->id); ?>"><?php echo e($v->description); ?></label>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php elseif($value->id_type_question == 2): ?>
                                                            <span class="mb-10" style="display: block;"><i>Por favor selecciona <?php if($value->max_answer == 1): ?><?php echo e($value->max_answer); ?> <?php echo e('opción'); ?><?php else: ?><?php echo e($value->max_answer); ?> <?php echo e('opciones'); ?><?php endif; ?></i></span>
                                                            <div class="radio-btn-flex ml-40">
                                                                <?php $__currentLoopData = $preguntas_multiples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($v->id_question == $value->id): ?>
                                                                        <div class="mr-30">
                                                                            <input type="radio" name="respuesta[<?php echo e($value->id); ?>][]" id="relation<?php echo e($v->id); ?>" value="<?php echo e($v->id); ?>" class="common-radio relationButton" required>
                                                                            <label for="relation<?php echo e($v->id); ?>"><?php echo e($v->description); ?></label>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php elseif($value->id_type_question == 3): ?>
                                                            <div class="radio-btn-flex ml-40">
                                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                                    <textarea class="primary-input form-control valid-request" cols="0" rows="5" name="respuesta[<?php echo e($value->id); ?>][]" id="guardians_address" required></textarea>
                                                                    <label>Respuesta <span></span> </label>
                                                                    <span class="focus-border textarea"></span>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="primary-btn goova-bt" id="submit-all" data-toggle="tooltip" title="">
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
            $(document).on('click','input.common-checkbox',function(){
                var id = $(this).data('id')
                var max = $(this).data('max')
                var i = 0
                $('.valid-limit-'+id).each(function(){
                    if($(this).is(':checked')) {  
                        i++  
                    }
                })
                if(i > max){
                    $(this).prop('checked', false);  
                }
            })
        </script>
    </body>
</html><?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/repositorio/info_exam.blade.php ENDPATH**/ ?>