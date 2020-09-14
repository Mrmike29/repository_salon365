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
                                                            <span class="mb-10" style="display: block;"><i>Múltiples opciones con múltiples respuestas</i></span>
                                                            <div class="radio-btn-flex ml-40">
                                                                <?php $__currentLoopData = $preguntas_multiples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($v->id_question == $value->id): ?>
                                                                        <div class="mr-30">
                                                                            <label for="section<?php echo e($v->id); ?>"><?php echo e($v->description); ?></label>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php elseif($value->id_type_question == 2): ?>
                                                            <span class="mb-10" style="display: block;"><i>Múltiples opciones con única respuesta</i></span>
                                                            <div class="radio-btn-flex ml-40">
                                                                <?php $__currentLoopData = $preguntas_multiples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($v->id_question == $value->id): ?>
                                                                        <div class="mr-30">
                                                                            <label for="relation<?php echo e($v->id); ?>"><?php echo e($v->description); ?></label>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <span class="mb-10" style="display: block;"><i>Pregunta abierta</i></span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
</html><?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/repositorio/view_questions_exam.blade.php ENDPATH**/ ?>