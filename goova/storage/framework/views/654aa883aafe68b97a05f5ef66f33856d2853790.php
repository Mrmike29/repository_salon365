<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <link rel="stylesheet" href="<?php echo e(asset('css/rubrics/index.css')); ?>">
    </head>
    <body class="admin">
        <div class="main-wrapper" style="min-height: 600px">
            <!-- Sidebar  -->
            <?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div id="main-content">
                <?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <div class="main-title">
                                    <h1>Gestionar Rubricas</h1>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="openModalCreateRubric()" title="Crear Rúbrica">
                                    <span class="ti-plus"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="mt-50">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="white-box" id="container_filter" style="border-radius: 10px 10px 0 0;">
                                    <div class="row mt-25">
                                        <div class="col-lg-4">
                                            <div class="dataTables_wrapper no-footer">
                                                <div class="dataTables_filter">
                                                    <label class="">
                                                        <input type="search" name="search_rubric" id="search_rubric" placeholder="Búsqueda rápida">
                                                        <a id="search_button">
                                                            <span class="ti-search"></span>
                                                        </a>
                                                    </label>
                                                </div>
                                            </div>
                                            <span class="modal_input_validation red_alert"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white-box" id="container_rubrics" style="border-radius: 0">
                                    <div class="dataTables_wrapper no-footer">
                                        <table id="table_rubrics" class="table school-table" style="border-radius: 10px; box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8);">
                                            <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <?php if(1 === 1): ?> <th>Institución</th> <?php endif; ?>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody_rubrics">

                                            </tbody>
                                        </table>
                                        <div class="dataTables_info" id="table_info" role="status" aria-live="polite">

                                        </div>
                                        <div class="dataTables_paginate paging_simple_numbers" id="table_rubrics_paginate">
                                            <a class="paginate_button previous n-t-s" data-id="0" tabindex="0" id="previous">
                                                <span class="ti-angle-left"></span>
                                            </a>
                                            <span id="pagination_number">

                                            </span>
                                            <a class="paginate_button next n-t-s" data-id="20" tabindex="0" id="next">
                                                <span class="ti-angle-right"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white-box" id="container_footer" style="border-radius: 0 0 10px 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <script type="text/javascript">
            const _token = "<?php echo e(csrf_token()); ?>";
        </script>
        <script type="text/javascript" src="<?php echo e(asset('js/rubrics/index.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\Users\Desarrollo1\Desktop\Goova\repository_salon365\goova\resources\views/rubricas.blade.php ENDPATH**/ ?>