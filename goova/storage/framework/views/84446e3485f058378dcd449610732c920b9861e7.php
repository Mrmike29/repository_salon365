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
                            <h1>Agragar Tarea</h1>
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
                                            <div class="row mb-30">
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_course" id="id_course">
                                                            <option data-display="Seleccionar Curso *" value="">Select</option>
                                                            <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                                        <select class="niceSelect w-100 bb form-control" name="id_subjects" id="id_subjects" id="sectionSelectStudent">
                                                            <option data-display="Seleccionar Materia *" value="">Section *</option>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                                        <select class="niceSelect w-100 bb form-control" name="id_theme_time" id="id_theme_time" id="sectionSelectStudent">
                                                            <option data-display="Seleccionar Tema *" value="">Section *</option>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_rubrics" id="id_rubrics">
                                                            <option data-display="Seleccionar Rubrica *" value="">Select</option>
                                                            <?php $__currentLoopData = $rubricas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input date form-control" type="text" name="start_time" id="start_time" value="<?php echo e(date('Y-m-d')); ?>" readonly="true">
                                                                <label>Fecha Inicio <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
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
                                                                <input class="primary-input date form-control" type="text" name="limit_time" id="limit_time" value="<?php echo e(date('Y-m-d')); ?>" readonly="true">
                                                                <label>Fecha Fin <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="" type="button">
                                                                <i class="ti-calendar" id="submission_date_icon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <div style="float: right">
                                                            <span class="info">Cantidad maxima de archivos: 9</span><br>
                                                            <span class="info">Tamaño maximo de archivos: 5MB</span>
                                                        </div>
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
    	<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script>
            Dropzone.autoDiscover = false;
            jQuery(document).ready(function() {
                var uploadedDocumentMap = {}
                $("div#my-awesome-dropzone").dropzone({
                    url: "/archivo",
                    dictDefaultMessage: "Agrege los archivos",
                    addRemoveLinks: true,
                    dictRemoveFile: "Eliminar archivo",
                    // maxfilesexceeded: 5024,
                    maxFiles: 9,
                    dictMaxFilesExceeded: "La cantidad maxima de archivos es de 9",
                    maxFilesize: 5,
                    dictFileTooBig: "El tamaño maximo de archivos es de 5MB.",
                    // autoProcessQueue: false,
                    headers: {
                        'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                    },
                    success: function (file, response) {
                        $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
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
                                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
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

                        $('form').find('input[name="document[]"][value="' + name + '"]').remove()
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
                },
                imageUploadParam: 'file' ,
                imageUploadURL: '/upload_image' ,
                imageUploadParams: { id : 'my_editor' },
                imageUploadMethod: 'POST' ,
                imageMaxSize: 5 * 1024 * 1024 ,
                imageAllowedTypes: [ 'jpeg' , 'jpg' , 'png' ]
            } );
            $(document).on('change','select[name=id_course]',function(){
                var id = $(this).val()
                $.ajax({
                    url: '/materias_tereas/'+id,
                    type: 'get',
                    success:function(dato){
                        var html = '<option data-display="Seleccionar Materia *" value="">Section *</option>'
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
        </script>
    </body>
</html>
<?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/repositorio/create-homework.blade.php ENDPATH**/ ?>