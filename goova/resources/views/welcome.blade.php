<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body class="admin">

		<div class="main-wrapper" style="min-height: 600px">
    		<!-- Sidebar  -->
    		@include('includes.sidebar')
            <div id="main-content">
    		    @include('includes.header')
                <section class="mb-40">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h3 class="mb-0" style="text-transform: capitalize;">Bienvenido - <!--Goova-->{{Auth::user()->name}} {{Auth::user()->last_name}} | {{$rol->name}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            </div>
                        </div>
                        <div class="row">
                            @if(Auth::user()->id_rol == 2)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <a href="#" class="d-block">
                                        <div class="white-box single-summery">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h3>Estudiantes</h3>
                                                    <p class="mb-0">Total Estudiantes</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$roles['students']}}
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
                                                    <h3>Profesores</h3>
                                                    <p class="mb-0">Total Profesores</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$roles['teacher']}}
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
                                                    <h3>Padres</h3>
                                                    <p class="mb-0">Total Padres</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$roles['parents']}}
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
                                                    <h3>Secretarias</h3>
                                                    <p class="mb-0">Total Secretarias</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$roles['secretary']}}
                                                </h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @elseif(Auth::user()->id_rol == 3)
                            @elseif(Auth::user()->id_rol == 4)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <a href="#" class="d-block">
                                        <div class="white-box single-summery">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h3>Estudiantes</h3>
                                                    <p class="mb-0">Total Estudiantes</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$roles['students']}}
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
                                                    <h3>Profesores</h3>
                                                    <p class="mb-0">Total Profesores</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$roles['teacher']}}
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
                                                    <h3>Padres</h3>
                                                    <p class="mb-0">Total Padres</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$roles['parents']}}
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
                                                    <h3>Secretarias</h3>
                                                    <p class="mb-0">Total Secretarias</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$roles['secretary']}}
                                                </h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @elseif(Auth::user()->id_rol == 5)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <a href="#" class="d-block">
                                        <div class="white-box single-summery">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h3>Tareas Pendientes</h3>
                                                    <p class="mb-0">Total Pendientes</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$estados['Pendiente']}}
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
                                                    <h3>Tareas Vencidas</h3>
                                                    <p class="mb-0">Total Vencidas</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$estados['Vencido']}}
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
                                                    <h3>Tareas Entregadas</h3>
                                                    <p class="mb-0">Total Entregadas</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$estados['Entregado']}}
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
                                                    <h3>Tareas Calificadas</h3>
                                                    <p class="mb-0">Total Calificadas</p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    {{$estados['Calificado']}}
                                                </h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @elseif(Auth::user()->id_rol == 6)
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <form style="display: none" action="/realizar_examen" method="POST" id="form">
            @csrf
            <input type="hidden" id="id" name="id" value=""/>
            <input type="hidden" id="exam" name="exam" value=""/>
        </form>
        @include('includes.footer')
        <script>
            $(document).on('click','.go_up_exam_course',function(){
                var id = $(this).data('id')
                var exam = $(this).data('exam')
                $('#form input[name=id]').val(id)
                $('#form input[name=exam]').val(exam)
                $('#form').submit()
            })
        </script>
    </body>
</html>