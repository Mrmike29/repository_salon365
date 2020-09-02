{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
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
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/login/index.css')}}">
	<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}"/>
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
                        {{-- <img src="public/uploads/settings/logo.png" alt="Login Panel"> --}}
                        <div class="in_login_page_iner">
                            <div class="in_login_page_header">
                                <h5>Goova</h5>
                            </div>
                            <form method="POST" class="loginForm" action="{{ route('login') }}" id="infix_form">
                                @csrf
                                @if(!empty($_GET['sala']))
                                    <input type="hidden" name="sala" value="{{$_GET['sala']}}">
                                @endif
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
                                {{-- <div class="d-flex justify-content-between">
                                    <div class="in_checkbox">
                                        <div class="boxes">
                                            <input type="checkbox" id="Remember">
                                            <label for="Remember">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="in_forgot_pass">
                                        <a href="recovery/passord.html">Forget Password ? </a>
                                    </div>
                                </div> --}}
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
    {{-- <footer class="footer_area min-height-10" style="margin-top: -50px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <p style="color: var(--g-fourth)">Copyright &copy; 2019 - 2020 All rights reserved | This template is made by Codethemes </p>
                </div>
            </div>
        </div>
    </footer> --}}

    <!--================ End Footer Area =================-->
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/toastr.min.js')}}"></script>
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
