
<!doctype html>
<html lang="en">
<!-- Mirrored from demo.infixedu.com/login by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Jul 2020 16:01:30 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="public/uploads/settings/favicon.png" type="image/png"/>
    <meta name="_token" content="utZZETYEKEm51dHsONesWtSdgM2seIPJcAboUoU5"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/login/index.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/toastr.min.css')); ?>"/>
    <title>Goova | Iniciar sesión</title>
    <style>
        .loginButton {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .loginButton{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .singleLoginButton{
            flex: 22% 0 0;
        }
        .loginButton .get-login-access {
            display: block;
            width: 100%;
            border: 1px solid #fff;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 5px;
            white-space: nowrap;
        }
        @media (max-width: 576px) {
            .singleLoginButton{
                flex: 49% 0 0;
            }
        }
        @media (max-width: 576px) {
            .singleLoginButton{
                flex: 49% 0 0;
            }
            .loginButton .get-login-access {
                margin-bottom: 10px;
            }
        }
        .create_account a {
            color: var(--g-fourth);
            font-weight: 500;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="in_login_part mb-40" style="">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-lg-5 col-xl-4 col-md-7">
                    <div class="in_login_content">
                        
                        <div class="in_login_page_iner">
                            <div class="in_login_page_header">
                                <h5>Goova</h5>
                            </div>
                            <form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>" id="infix_form">
                                <?php echo csrf_field(); ?>
                                <?php if(!empty($_GET['sala'])): ?>
                                    <input type="hidden" name="sala" value="<?php echo e($_GET['sala']); ?>">
                                <?php endif; ?>
                                <div class="in_single_input">
                                    <input type="text" placeholder="Correo Electronico" name="email" class="" value="admin@stratecsa.com" id="email-address">
                                    <span class="addon_icon">
                                        <i class="ti-email"></i>
                                    </span>
                                </div>
                                <div class="in_single_input">
                                    <input type="password" placeholder="Contraseña" name="password" class="" value="12345678">
                                    <span class="addon_icon">
                                        <i class="ti-key"></i>
                                    </span>
                                </div>
                                
                                <div class="in_login_button text-center">
                                    <button type="submit" class="in_btn" id="btnsubmit">
                                        <span class="ti-lock"></span>
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--================ Footer Area =================-->
    

    <!--================ End Footer Area =================-->
    <script src="<?php echo e(asset('js/jquery-3.4.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
	<script>
        $(document).ready(function () {
            $('#btnsubmit').on('click',function(){
                $(this).html('Please wait ...').attr('disabled','disabled');
                $('#infix_form').submit();
            });
        });
        $(document).ready(function() {
            $("#email-address").keyup(function(){
                $("#username-hidden").val($(this).val());
            });
        });
    </script>
</body>

<!-- Mirrored from demo.infixedu.com/login by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Jul 2020 16:01:36 GMT -->
</html>
<?php /**PATH C:\Users\Desarrollo1\Desktop\Goova\repository_salon365\goova\resources\views/auth/login.blade.php ENDPATH**/ ?>