<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')

    <style>
        .progress-bar {
            height: 35px;
            width: 250px;
            border: 2px solid blue;
        }

        .progress-bar-fill {
            height: 100%;
            width: 0;
            background: lightblue;
            display: flex;
            align-items: center;
            font-weight: bold;
            transition: width 0.25s;
        }

        .progress-bar-text{
            margin-left: 10px;
            font-weight: bold;
        }
    </style>
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
                    <div class="col-lg-6">
                        <div class="main-title">
                            <h1>Subir Archivo</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="openModalCreateTime()" title="Agregar Ciclo/Periodo">
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

                    </div>
                    <div class="col-lg-12">
                        <div class="white-box" id="" style="border-radius: 0">
                            <form class="form" id="upload_file" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="file" name="the_file" id="the_file" />
                                <input type="submit" class="button" value="Cargar">
                            </form>

                            <div class="progress-bar" id="progress_bar">
                                <div class="progress-bar-fill">
                                    <span class="progress-bar-text">
                                        0%
                                    </span>
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

@include('includes.footer')

<script type="text/javascript">
    const _token = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{asset('js/upload-file/index.js')}}"></script>
</body>
</html>
