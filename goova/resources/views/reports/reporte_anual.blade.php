<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
        <link rel="stylesheet" href="{{asset('css/notes/index.css')}}">
    </head>
    <body class="admin">

        <div class="main-wrapper" style="min-height: 600px">
            <!-- Sidebar  -->
            @include('includes.sidebar')
            <div id="main-content">
                @include('includes.header')

                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <h1>Reporte Anual</h1>
                        </div>
                    </div>
                </section>
                @include('reports.list')
            </div>
        </div>

        @include('includes.footer')
        <script type="text/javascript">
            const _token = "{{ csrf_token() }}";
        </script>
        <script type="text/javascript" src="{{asset('js/reports/index2.js')}}"></script>
    </body>
</html>
