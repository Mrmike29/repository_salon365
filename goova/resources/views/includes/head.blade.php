<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--    <link rel="icon" href="public/uploads/settings/favicon.png" type="image/png">--}}
    <title>Goova  <?= ($_SERVER['REQUEST_URI'] != '/' ? '| ' . ucwords(preg_replace(["/[\/]/", "/[-]/", "/[_]/"], ['', ' ', ' '], explode("/", "$_SERVER[REQUEST_URI]")[1])) : '') ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">


    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.data-tables.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/rowReorder.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.dataTables.min.css')}}">


    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('icofont/icofont.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/fastselect.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/overhang.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/loade.css')}}">
    <link rel="stylesheet" href="{{asset('css/goova.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">


    

    
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--g-third) !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--g-third)  !important;
        }
        ::placeholder {
            color: var(--g-fourth)  !important;
        }
        .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-bottom{
            z-index: 99999999999 !important;
            background: #fff !important;
        }
        .input-effect {
            float: left;
            width: 100%;
        }
        #livesearch a {
            text-align: left;
            display: block;
        }
        .languageChange .list{
            padding-top: 40px !important;
        }
        .goova_theme_rtl .list{
            padding-top: 40px !important;
        }
        .goova_theme_style .list{
            padding-top: 40px !important;
        }
        p.date {
            font-size: 11px;
        }
        .mr-10.text-right.bell_time {
            text-align: right !important;
            margin-right: 0;
            padding-right: 0;
            position: relative;
            left: 22px;
        }
        .profile_single_notification i {
            margin-bottom: 20px;
        }
        .profile_single_notification span.ti-bell {
            font-size: 12px;
            margin-right: 5px;
            display: inline-block;
            overflow: hidden;
        }
        .dropdown-item:last-child .profile_single_notification {
            background: #000;
        }
        .profile_single_notification.d-flex.justify-content-between.align-items-center {
            /* background: red; */
            margin-bottom: 10px !important;
            margin-top: 10px !important;
        }
        .admin .navbar .right-navbar .dropdown .message.notification_msg {
            font-size: 12px;
            max-width: 127px;
            max-height: auto !important;
            overflow: visible !important;
            -webkit-transition: all 0.4s ease 0s;
            -moz-transition: all 0.4s ease 0s;
            -o-transition: all 0.4s ease 0s;
            transition: all 0.4s ease 0s;
            line-height: 1.4;
            white-space: normal;
        }
        .admin .navbar .right-navbar .dropdown .message {
            max-height: initial !important;
        }
        .modal_input_validation.red_alert {
            color: red !important;
        }
        .dropzone .dz-preview .dz-error-message {
            top: -115px !important;
        }
        .dropzone .dz-preview .dz-error-message:after {
            top: 109px !important;
            transform: rotate(180deg) !important;
        }
        .dropzone {
            border: 2px dashed rgba(0, 0, 0, 0.3) !important;
        }
        .fr-wrapper > div:first-child a {
            background-color: #fff !important;
            height: 0 !important;
            display: none !important;
        }
        #insertVideo-1, #insertFile-1 {
            display: none !important;
        }
        .dropzone .dz-message {
            margin: 3em 0 !important;
        }
        .input-effect span.info {
            font-style: oblique;
            font-size: 11px;
        }
    </style>

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
