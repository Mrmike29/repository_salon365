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
                            <h1>Validar Examen</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="white-box">
                                    <div class="">
                                        <div class="row mb-30">
                                            <?php $__currentLoopData = $preguntas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-group col-lg-12">
                                                    <p class="text-uppercase fw-500 mb-0"><?php echo e($value->description); ?></p>
                                                    <?php if($value->id_type_question == 1): ?>
                                                        <span class="mb-10" style="display: block;"><i>Por favor selecciona <?php if($value->max_answer == 1): ?><?php echo e($value->max_answer); ?> <?php echo e('opción'); ?><?php else: ?><?php echo e($value->max_answer); ?> <?php echo e('opciones'); ?><?php endif; ?></i> <?php if($value->status == 't'): ?> <i class="icofont icofont-ui-check" style="color: green"></i> <?php else: ?> <i class="icofont icofont-ui-close" style="color: red"></i> <?php endif; ?> </span>
                                                        <div class="radio-btn-flex ml-40">
                                                            <?php $__currentLoopData = $preguntas_multiples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($v->id_question == $value->id): ?>
                                                                    <div class="mr-30">
                                                                        <input <?php if($v->answer): ?><?php echo e('checked'); ?><?php endif; ?> type="checkbox" id="section<?php echo e($v->id); ?>" data-id="<?php echo e($value->id); ?>" data-max="<?php echo e($value->max_answer); ?>" class="common-checkbox form-control valid-limit-<?php echo e($value->id); ?>" name="respuesta[<?php echo e($value->id); ?>][]" value="<?php echo e($v->id); ?>">
                                                                        <label for="section<?php echo e($v->id); ?>"><?php echo e($v->description); ?></label>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php elseif($value->id_type_question == 2): ?>
                                                        <span class="mb-10" style="display: block;"><i>Por favor selecciona <?php if($value->max_answer == 1): ?><?php echo e($value->max_answer); ?> <?php echo e('opción'); ?><?php else: ?><?php echo e($value->max_answer); ?> <?php echo e('opciones'); ?><?php endif; ?></i> <?php if($value->status == 't'): ?> <i class="icofont icofont-ui-check" style="color: green"></i> <?php else: ?> <i class="icofont icofont-ui-close" style="color: red"></i> <?php endif; ?> </span>
                                                        <div class="radio-btn-flex ml-40">
                                                            <?php $__currentLoopData = $preguntas_multiples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($v->id_question == $value->id): ?>
                                                                    <div class="mr-30">
                                                                        <input <?php if($v->answer): ?><?php echo e('checked="checked"'); ?><?php endif; ?> type="radio" name="respuesta[<?php echo e($value->id); ?>][]" id="relation<?php echo e($v->id); ?>" value="<?php echo e($v->id); ?>" class="common-radio relationButton" required>
                                                                        <label for="relation<?php echo e($v->id); ?>"><?php echo e($v->description); ?></label>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php elseif($value->id_type_question == 3): ?>
                                                        <?php $__currentLoopData = $respuestas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($v->id_questions == $value->id): ?>
                                                                <span class="mb-10" style="display: block;"><i>Respuesta</i><?php if($v->status == 't'): ?> <i class="icofont icofont-ui-check" style="color: green"></i> <?php else: ?> <i class="icofont icofont-ui-close" style="color: red"></i><?php endif; ?></span>
                                                                <div class="radio-btn-flex ml-40">
                                                                    <?php if(!empty($v->description)): ?>
                                                                        <span><?php echo e($v->description); ?></span> <span><?php echo e($v->status); ?></span><br>
                                                                    <?php else: ?>
                                                                        <div class="col-lg-8">
                                                                            <span><?php echo e($v->answer); ?></span>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group col-lg-12">
                                                <center>
                                                    <h2>Nota <?php echo e($nota->value); ?></h2>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script>
            /** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
            (function( $ ){ 
                $.fn.mValid = function(data) { 
                    console.log($(this).attr('name') + ' = ' + $(this).val());

                    data.text = $.trim($(this).val()) === ''? data.text : ''; 
                    $(this).parents('div.input-effect').siblings('span').text(data.text); 
                    return ($.trim($(this).val()) === ''); 
                }; 
            })( jQuery );
            $('form.form-horizontal').submit(function(e){
                var res = false
                $('select.valid-request').each(function(){
                    var sel =   $(this).mValid({
                                    text: 'Campo vacío'
                                })
                    if(sel == true){
                        res = true
                    }
                })
                if(res){
                    e.preventDefault()
                }
            })
        </script>
    </body>
</html><?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/repositorio/view_answers_exam.blade.php ENDPATH**/ ?>