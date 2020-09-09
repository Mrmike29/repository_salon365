<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <style>
            .common-radio:empty {
                margin-top: 0px !important;
            }
        </style>
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
                            <h1>Agragar Examen</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/crear_examen" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" novalidate>
                            <?php echo csrf_field(); ?>
                            <div class="row mb-30">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="f">
                                            <div class="row mb-30">
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control valid-request" name="id_course" id="id_course" required>
                                                            <option data-display="Seleccionar Curso *" value="">Select</option>
                                                            <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                    <span class="modal_input_validation red_alert"></span>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                                        <select class="niceSelect w-100 bb form-control valid-request" name="id_subjects" id="id_subjects" id="sectionSelectStudent" required>
                                                            <option data-display="Seleccionar Asignatura *" value="">Section *</option>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                    <span class="modal_input_validation red_alert"></span>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                                        <select class="niceSelect w-100 bb form-control valid-request" name="id_theme_time" id="id_theme_time" id="sectionSelectStudent" required>
                                                            <option data-display="Seleccionar Tema *" value="">Section *</option>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                    <span class="modal_input_validation red_alert"></span>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control valid-request" name="id_rubrics" id="id_rubrics" required>
                                                            <option data-display="Seleccionar Rubrica *" value="">Select</option>
                                                            <?php $__currentLoopData = $rubricas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                    <span class="modal_input_validation red_alert"></span>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input date form-control valid-request" type="text" name="date_start" id="date_start" value="<?php echo e(date('Y-m-d')); ?>" readonly="true" required>
                                                                <label>Fecha Inicio <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                            <span class="modal_input_validation red_alert"></span>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="" type="button">
                                                                <i class="ti-calendar" id="homework_date_icon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input date form-control valid-request" type="text" name="date_end" id="date_end" value="<?php echo e(date('Y-m-d')); ?>" readonly="true" required>
                                                                <label>Fecha Fin <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                            <span class="modal_input_validation red_alert"></span>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="" type="button">
                                                                <i class="ti-calendar" id="submission_date_icon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="row mb-30">
                                            <div class="col-lg-4">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <select class="niceSelect w-100 bb form-control valid-request" name="type_question[]" id="type_question" required>
                                                        <option data-display="Seleccionar Tipo de Pregunta *" value="">Select</option>
                                                        <?php $__currentLoopData = $tipo_pregunta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="focus-border"></span>
                                                </div>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                            <div class="form-group col-lg-7 p">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <textarea data-id="0" class="primary-input form-control valid-request" cols="0" rows="3" name="question[]" id="guardians_address" required></textarea>
                                                    <label>Pregunta <span></span> </label>
                                                    <span class="focus-border textarea"></span>
                                                </div>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                            <div class="form-group col-lg-1">
                                                
                                            </div>
                                            <div class="form-group col-lg-12">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pr"></div>
                            <div class="row" style="justify-content: flex-end; margin: unset;">
                                <div class="form-group">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <button type="button" class="btn btn-primary plus">Añadir pregunta</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="row">
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
            /** Mi función, la utilizo para hacer mis inputs de tipo number */
            (function( $ ){ $.fn.mNumber = function() { $(this).bind('paste input',function(){ $(this).val ( $(this).val().replace (/[A-Za-zàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝäëïöüÿÄËÏÖÜŸ !@%&`":´¨<>ºªñÑçÇ;·~€¬/='¿¡[\]{}()*+?,\\^$|#\s-]/g ,"")) }); }; })( jQuery );
            $(document).on('change','select[name=id_course]',function(){
                var id = $(this).val()
                $.ajax({
                    url: '/materias_tereas/'+id,
                    type: 'get',
                    success:function(dato){
                        var html = '<option data-display="Seleccionar Asignatura *" value="">Section *</option>'
                        $(dato).each(function(k,v){
                            html += `<option value="${v.id}">${v.subjects} - ${v.teacher} ${v.last_name}</option>`
                        })
                        $('select[name=id_subjects]').html(html)
                        $('select[name=id_subjects]').niceSelect('update');
                    }
                })
            })
            $(document).on('change','select[name=id_subjects]',function(){
                var id = $(this).val()
                var con = $('select[name=id_course]').val()
                $.ajax({
                    url: '/temas_tereas/'+id+'/'+con,
                    type: 'get',
                    success:function(dato){
                        var html = '<option data-display="Seleccionar Tema *" value="">Section *</option>'
                        $(dato).each(function(k,v){
                            html += `<option value="${v.id}">${v.name}</option>`
                        })
                        $('select[name=id_theme_time]').html(html)
                        $('select[name=id_theme_time]').niceSelect('update');
                    }
                })
            })
            $(document).on('change','select[name^=type_question]',function(){
                var id = $(this).parent().parent().parent().find('textarea[name^=question]').data('id')
                if($(this).val() == 1){
                    var html = `<div class="row">
                                    <div class="form-group col-lg-4">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <input class="primary-input form-control valid-request m-number" type="number" name="max_answer[${id}]" min="1" required>
                                                    <label>Numero de respuestas correctas <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                </div>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-7">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <input class="primary-input form-control valid-request" type="text" name="opcion[${id}][]" required>
                                                    <label>Opción <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                </div>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <select class="niceSelect w-100 bb form-control valid-request" name="status[${id}][]" id="st">
                                                <option data-display="Seleccionar Tipo de Pregunta *" value="">Select</option>
                                                <option value="true">Verdadera</option>
                                                <option value="false">Falsa</option>
                                            </select>
                                            <span class="focus-border"></span>
                                        </div>
                                        <span class="modal_input_validation red_alert"></span>
                                    </div>
                                    <div class="form-group col-lg-1">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <button type="button" class="btn btn-primary opcion-plus"><i class="icofont icofont-plus"></i></button>
                                        </div>
                                    </div>
                                </div>`
                }
                if($(this).val() == 2){
                    var html = `<div class="row">
                                    <div class="form-group col-lg-7">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <input class="primary-input form-control valid-request" type="text" name="opcion[${id}][]" required>
                                                    <label>Opción <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                </div>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <select class="niceSelect w-100 bb form-control valid-request" name="status[${id}][]" id="st">
                                                <option data-display="Seleccionar Tipo de Pregunta *" value="">Select</option>
                                                <option value="true">Verdadera</option>
                                                <option value="false">Falsa</option>
                                            </select>
                                            <span class="focus-border"></span>
                                        </div>
                                        <span class="modal_input_validation red_alert"></span>
                                    </div>
                                    <div class="form-group col-lg-1">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <button type="button" class="btn btn-primary opcion-plus"><i class="icofont icofont-plus"></i></button>
                                        </div>
                                    </div>
                                </div>`
                }
                if($(this).val() == 3){
                    var html = `<div class="input-effect sm2_mb_20 md_mb_20">
                                    <textarea class="primary-input form-control valid-request" cols="0" rows="3" name="respuesta[${id}]" id="guardians_address" required></textarea>
                                    <label>Respuesta <span></span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                                <span class="modal_input_validation red_alert"></span>`
                }
                $(this).parent().parent().parent().find('div.col-lg-12').html(html)
                // $('select[name=status].niceSelect').niceSelect();
                $('.m-number').mNumber();
                $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
            })
            $(document).on('click','button.plus',function(){
                var array = 0
                $('textarea[name^=question]').each(function(k, v){
                    if($(v).data('id') > array){
                        array = $(v).data('id')
                    }
                })
                var id = array + 1
                var html = `<div class="row mb-30">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="row mb-30">
                                            <div class="col-lg-4">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <select class="niceSelect w-100 bb form-control valid-request" name="type_question[${id}]" id="type_question" required>
                                                        <option data-display="Seleccionar Tipo de Pregunta *" value="">Select</option>
                                                        <?php $__currentLoopData = $tipo_pregunta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="focus-border"></span>
                                                </div>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                            <div class="form-group col-lg-7 p">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <textarea data-id="${id}" class="primary-input form-control valid-request" cols="0" rows="3" name="question[${id}]" id="guardians_address" required></textarea>
                                                    <label>Pregunta <span></span> </label>
                                                    <span class="focus-border textarea"></span>
                                                </div>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                            <div class="form-group col-lg-1">
                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                    <button type="button" class="btn btn-danger minus"><i class="icofont icofont-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                $('form div.pr').append(html)
                $('select.niceSelect').niceSelect();
                $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
            })
            $(document).on('click','button.minus',function(){
                $(this).parent().parent().parent().parent().parent().parent().remove()
            })
            $(document).on('click','button.opcion-plus',function(){
                var id = $(this).parent().parent().parent().parent().parent().find('textarea[name^=question]').data('id')
                var html = `<div class="row">
                                <div class="form-group col-lg-7">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control valid-request" type="text" name="opcion[${id}][]" required>
                                                <label>Opción <span>*</span></label>
                                                <span class="focus-border"></span>
                                            </div>
                                            <span class="modal_input_validation red_alert"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <select class="niceSelect w-100 bb form-control valid-request" name="status[${id}][]" id="st">
                                            <option data-display="Seleccionar Tipo de Pregunta *" value="">Select</option>
                                            <option value="true">Verdadera</option>
                                            <option value="false">Falsa</option>
                                        </select>
                                        <span class="focus-border"></span>
                                    </div>
                                    <span class="modal_input_validation red_alert"></span>
                                </div>
                                <div class="form-group col-lg-1">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <button type="button" class="btn btn-danger opcion-minus"><i class="icofont icofont-minus"></i></button>
                                    </div>
                                </div>
                            </div>`
                $(this).parent().parent().parent().parent().append(html)
                // $('select[name=status].niceSelect').niceSelect();
                $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
            })
            $(document).on('click','button.opcion-minus',function(){
                $(this).parent().parent().parent().remove()
            })
            $(document).on('change','select[name^=status]',function(){
                var val = $(this).parent().parent().parent().parent().find('input[name^=max_answer]').val()
                if(val){
                    var s = $(this).parent().parent().parent().parent().find('select[name^=status]')
                    var i = 0
                    $(s).each(function(){
                        // if($(this).next().find('li.selected').attr('data-value') == 'true'){
                        if($(this).val() == 'true'){
                            i++
                        }
                    })
                    if(i > val){
                        $(this).val('')
                        // $(this).niceSelect('update')
                    }
                }else{
                    var s = $(this).parent().parent().parent().parent().find('select[name^=status]')
                    var i = 0
                    $(s).each(function(){
                        // if($(this).next().find('li.selected').attr('data-value') == 'true'){
                        if($(this).val() == 'true'){
                            i++
                        }
                    })
                    if(i > 1){
                        $(this).val('')
                        // $(this).niceSelect('update')
                    }
                }
            })
            $(document).on('keyup','input[name^=max_answer]',function(){
                var val = $(this).val()
                var s = $(this).parent().parent().parent().parent().parent().parent().find('select[name^=status]')
                var i = 0
                $(s).each(function(){
                    // if($(this).next().find('li.selected').attr('data-value') == 'true'){
                    if($(this).val() == 'true'){
                        i++
                    }
                })
                if(i > val){
                    $(s).each(function(){
                        $(this).val('')
                        // $(this).niceSelect('update')
                    })
                }
            })
            $('form.form-horizontal').submit(function(e){
                var res = false
                $('select.valid-request, input.valid-request, textarea.valid-request').each(function(){
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
</html>
<?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/repositorio/create-exam.blade.php ENDPATH**/ ?>