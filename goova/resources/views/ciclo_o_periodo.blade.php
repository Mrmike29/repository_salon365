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

                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <div class="main-title">
                                    <h1>Ciclo O Periodo</h1>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#" class="primary-btn small fix-gr-bg" onclick="openModalCreateEvent()" title="Agregar Evento">
                                    <span class="ti-plus pr-2"></span>
                                    Agregar
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mt-50">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="white-box" id="container_filter">
                                    <div class="row mt-25">
                                        <div class="col-lg-4" id="sibling_class_div">
                                            <div class="input-effect">
                                                <input class="primary-input form-control" type="text" name="name_create_event" id="name_create_event">
                                                <label>
                                                    Nombre *<span></span>
                                                </label>
                                                <span class="focus-border"></span>
                                            </div>
                                            <span class="modal_input_validation red_alert"></span>
                                        </div>
                                        <div class="col-lg-4" id="sibling_class_div">
                                            <div class="input-effect">
                                                <input class="primary-input form-control" type="text" name="name_create_event" id="name_create_event">
                                                <label>
                                                    Nombre *<span></span>
                                                </label>
                                                <span class="focus-border"></span>
                                            </div>
                                            <span class="modal_input_validation red_alert"></span>
                                        </div>
                                        <div class="col-lg-4" id="sibling_class_div">
                                            <div class="input-effect">
                                                <input class="primary-input form-control" type="text" name="name_create_event" id="name_create_event">
                                                <label>
                                                    Nombre *<span></span>
                                                </label>
                                                <span class="focus-border"></span>
                                            </div>
                                            <span class="modal_input_validation red_alert"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white-box" id="container_times">
                                    <table id="table_times" class="table school-table" style="box-shadow: 0 10px 15px rgba(236, 208, 244, 0.8);">
                                        <thead>
                                        <tr>
                                            <th>Nº Periodo/Ciclo</th>
                                            <th>Temas</th>
                                            @if(1 === 1) <th>Temas</th> @endif
                                            <th class="noExport">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>d</td>
                                            <td>ds</td>
                                            <td>ds</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        Seleccionar
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="/editar_usuario/">Editar</a>
                                                        <a class="dropdown-item inhabilitar_user" data-id="" data-toggle="modal" data-target="#inhabilitarUserModal" href="#">Inhabilitar</a>
                                                        <a class="dropdown-item habilitar_user" data-id="" data-toggle="modal" data-target="#habilitarUserModal" href="#">Habilitar</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white-box" id="container_filter">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        @include('includes.footer')
    </body>
</html>
