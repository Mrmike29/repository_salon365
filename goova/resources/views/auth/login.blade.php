<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="_token" content="utZZETYEKEm51dHsONesWtSdgM2seIPJcAboUoU5"/>
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/login/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/goova.css')}}">
    <title>Goova | Iniciar sesión</title>

    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

    <script type="text/javascript">
        const cl = [], root = document.documentElement, t = localStorage.getItem('template');

        cl['blue'] = {1: '#0000FF', 2: '#0000BF', 3: '#000040', 4: '#727373'}
        cl['purple'] = {1: '#9F02A3', 2: '#79017F', 3: '#4A024C', 4: '#727373'}
        cl['orange'] = {1: '#FCC412', 2: '#FF8B00', 3: '#E06410', 4: '#727373'}
        cl['red'] = {1: '#FF0000', 2: '#BF0000', 3: '#800000', 4: '#727373'}
        cl['green'] = {1: '#00CC00', 2: '#008000', 3: '#004000', 4: '#727373'}
        cl['cyan'] = {1: '#00FFFF', 2: '#00BFBF', 3: '#008080', 4: '#727373'}
        cl['columbia'] = {1: '#7BACE0', 2: '#587BA1', 3: '#2E4053', 4: '#727373'}
        cl['grey'] = {1: '#C0C0C0', 2: '#A0A0A0', 3: '#686868', 4: '#727373'}
        cl['mixed'] = {1: '#D54616', 2: '#002C38', 3: '#FF8B00', 4: '#727373'}
        cl['pink'] = {1: '#FF00FF', 2: '#BF00BF', 3: '#800080', 4: '#727373'}
        cl['yellow'] = {1: '#FFFF00', 2: '#E6E600', 3: '#bfbf00', 4: '#727373'}

        $.ajax({
            type: 'GET',
            url: '/get-e-c'
        }).done(function(data) {
            const e = data.e.color;
            if(t !== null) {
                root.style.setProperty('--g-first', cl[e][1]);
                root.style.setProperty('--g-second', cl[e][2]);
                root.style.setProperty('--g-third', cl[e][3]);
                root.style.setProperty('--g-fourth', cl[e][4]);
            } else {
                if(t === e) return false;

                localStorage.setItem('template', e);

                root.style.setProperty('--g-first', cl[e][1]);
                root.style.setProperty('--g-second', cl[e][2]);
                root.style.setProperty('--g-third', cl[e][3]);
                root.style.setProperty('--g-fourth', cl[e][4]);
            }
        });


        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : (event.keyCode);
            if (charCode > 31 && (charCode < 48 || charCode > 57)){
                return false;
            }
            return true;
        }
    </script>
</head>
<body>


    <div class="row">
        <div class="col liquid">
            <h4>Goova.co <i class="ti-pencil-alt2"></i></h4>
            <img src="{{asset('img/front/LOGO.svg')}}" alt="" class="login-img">
        </div>
        <div class="col login">
            <button type="button" class="btn btn-signup">Sign Up</button>
            <form method="POST" class="loginForm" action="{{ route('login') }}" id="goova_form">
                @csrf
                @if(!empty($_GET['sala']))
                    <input type="hidden" name="sala" value="{{$_GET['sala']}}">
                @endif
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
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/goova-template.js')}}"></script>

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
