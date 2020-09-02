<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body class="admin">

		<div class="main-wrapper" style="min-height: 600px">
    		<!-- Sidebar  -->
    		<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div id="main-content">
    		    <?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <section class="mb-40">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h3 class="mb-0">Welcome - InfixEdu | Super admin</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="d-block">
                                    <div class="white-box single-summery">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h3>Student</h3>
                                                <p class="mb-0">Total Students</p>
                                            </div>
                                            <h1 class="gradient-color2">
                                                38
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="d-block">
                                    <div class="white-box single-summery">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h3>Teachers</h3>
                                                <p class="mb-0">Total Teachers</p>
                                            </div>
                                            <h1 class="gradient-color2">
                                                4
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="d-block">
                                    <div class="white-box single-summery">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h3>Parents</h3>
                                                <p class="mb-0">Total Parents</p>
                                            </div>
                                            <h1 class="gradient-color2">
                                                38
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="d-block">
                                    <div class="white-box single-summery">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h3>Staffs</h3>
                                                <p class="mb-0">Total Staffs</p>
                                            </div>
                                            <h1 class="gradient-color2">
                                                6
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    	</div>
    	<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html><?php /**PATH C:\Users\Desarrollo1\Desktop\Goova\repository_salon365\goova\resources\views/welcome.blade.php ENDPATH**/ ?>