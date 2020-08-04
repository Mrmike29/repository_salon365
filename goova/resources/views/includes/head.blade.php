<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--    <link rel="icon" href="public/uploads/settings/favicon.png" type="image/png">--}}
    <title>Goova  <?= ($_SERVER['REQUEST_URI'] != '/' ? '| ' . ucwords(preg_replace(["/[\/]/", "/[-]/"], ['', ' '], explode("/", "$_SERVER[REQUEST_URI]")[1])) : '') ?></title>

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

    <link rel="stylesheet" href="{{asset('css/loade.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/goova.css')}}">

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #7c32ff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #7c32ff  !important;
        }

        ::placeholder {
            color: #415094  !important;
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
    </style>

    <script type="text/javascript">
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : (event.keyCode);
            if (charCode > 31 && (charCode < 48 || charCode > 57)){
                return false;
            }
            return true;
        }
    </script>
