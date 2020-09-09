<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="_token" content="utZZETYEKEm51dHsONesWtSdgM2seIPJcAboUoU5"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/login/index.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/goova.css')); ?>">
    <title>Goova | Iniciar sesión</title>

</head>
<body>


    <div class="row">
        <div class="col liquid">
            <h4>Goova.co <i class="ti-pencil-alt2"></i></h4>
            <img src="<?php echo e(asset('img/front/LOGO.svg')); ?>" alt="" class="login-img">
        </div>
        <div class="col login">
            <button type="button" class="btn btn-signup">Sign Up</button>
            <form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>" id="goova_form">
                <?php echo csrf_field(); ?>
                <?php if(!empty($_GET['sala'])): ?>
                    <input type="hidden" name="sala" value="<?php echo e($_GET['sala']); ?>">
                <?php endif; ?>
                <div class="titles">
                    <h3>Goova</h3>
                </div>
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email" class="form-input"  value="admin@stratecsa.com" id="email-address">
                    <span class="addon_icon">
                        <i class="ti-email"></i>
                    </span>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Contraseña" name="password"  class="form-input" value="12345678">
                    <span class="addon_icon">
                        <i class="ti-key"></i>
                    </span>
                </div>

                <button type="submit" class="btn btn-login">
                    <span class="ti-lock"></span>
                    Login
                </button>
            </form>
        </div>
    </div>


    <!--================ End Footer Area =================-->
    <script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/goova-template.js')); ?>"></script>

    <script>
        $(document).ready(function () {
            $('#btnsubmit').on('click',function(){
                $(this).html('Please wait ...').attr('disabled','disabled');
                $('#goova_form').submit();
            });

            $("#email-address").keyup(function(){ $("#username-hidden").val($(this).val()); });
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/auth/login.blade.php ENDPATH**/ ?>