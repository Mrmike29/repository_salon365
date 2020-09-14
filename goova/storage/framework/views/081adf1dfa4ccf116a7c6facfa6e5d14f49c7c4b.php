<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <style>
            .admin-visitor-area {
                width: 100%;
                height: 91%;
                overflow-y: scroll;
                padding: 0px 5px;
            }
            .icofont {
                font-size: 17px;
            }
            html, body, .main-wrapper, #main-content {
                height: 100%;
            }
            .admin .navbar {
                height: 8%;
            }
        </style>
    </head>
    <body class="admin">
		<div class="main-wrapper">
    		<!-- Sidebar  -->
    		<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div id="main-content">
    		    <?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <section id="show-table" class="admin-visitor-area up_st_admin_visitor">
                    <div class="container-fluid p-0">
                        <?php $__currentLoopData = $contenido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row m-0 <?php if(Auth::user()->id == $val->id): ?><?php echo e('d-flex justify-content-end'); ?><?php endif; ?>">
                                <div class="p-0 col-md-7 col-md-offset-4">
                                    <div class="white-box mt-10" style="padding: 20px 20px;">
                                        <?php if($key == 0): ?>
                                            <h5 style="text-transform: uppercase;"><b><?php echo e($val->name); ?> <?php echo e($val->last_name); ?></b> (<?php echo e($val->rol); ?>)</h5>
                                        <?php else: ?>
                                            <h5 style="text-transform: uppercase;"><b><?php echo e($val->name); ?> <?php echo e($val->last_name); ?></b> (<?php echo e($val->rol); ?>) a <b><?php echo e($val->answer_name); ?> <?php echo e($val->answer_last_name); ?></b></h5>
                                        <?php endif; ?>
                                        <?= $val->content ?>
                                        <?php if(!$archivos->isEmpty()): ?>
                                            <span class="text-primary">Archivos adjuntos</span>
                                            <?php $__currentLoopData = $archivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($val->id_content == $v->id_content_foro): ?>
                                                    <a href="/archives/<?php echo e($v->description); ?>" download data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Clic para descargar">
                                                        <?php $exts=explode(".",$v->description); $exts=strtolower(end($exts)); ?>
                                                        <?php if($exts == "jpg" || $exts == "jpeg"): ?>
                                                            <i class="icofont icofont-file-jpg"></i>
                                                        <?php elseif($exts == "png"): ?>
                                                            <i class="icofont icofont-file-png"></i>
                                                        <?php elseif($exts == "gif"): ?>
                                                            <i class="icofont icofont-file-gif"></i>
                                                        <?php elseif($exts == "psd"): ?>
                                                            <i class="icofont icofont-file-psd"></i>
                                                        <?php elseif($exts == "pdf"): ?>
                                                            <i class="icofont icofont-file-pdf"></i>
                                                        <?php elseif($exts == "zip" || $exts == "rar"): ?>
                                                            <i class="icofont icofont-file-zip"></i>
                                                        <?php elseif($exts == "docx" || $exts == "docm" || $exts == "dotx" || $exts == "dotm" || $exts == "doc" || $exts == "dot"): ?>
                                                            <i class="icofont icofont-file-word"></i>
                                                        <?php elseif($exts == "xlsx" || $exts == "xlsm" || $exts == "xlsb" || $exts == "xltx" || $exts == "xltm" || $exts == "xls" || $exts == "xlt" || $exts == "xml" || $exts == "xlam" || $exts == "xla" || $exts == "xlw" || $exts == "xlr"): ?>
                                                            <i class="icofont icofont-file-excel"></i>
                                                        <?php else: ?>
                                                            <i class="icofont icofont-file-alt"></i>
                                                        <?php endif; ?>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php if(Auth::user()->id_rol == 4 || Auth::user()->id_rol == 5): ?>
                                            <?php if($foro->date_end >= date('Y-m-d 00:00:00')): ?>
                                                <div class="reply" style="display: flex; justify-content: flex-end;">
                                                    <a href="/info_foro_responder/<?php echo e(encrypt($val->id_content_foro)); ?>" style="text-decoration: underline;">Responder</a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
            </div>
        </div>
        <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script>
            $('a[download]').popover();
        </script>
    </body>
</html><?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/repositorio/info_foro.blade.php ENDPATH**/ ?>