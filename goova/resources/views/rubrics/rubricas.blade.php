<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')

        <link rel="stylesheet" href="{{asset('css/rubrics/index.css')}}">
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
                                    <h1>Gestionar Rubricas</h1>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="openModalCreateRubric()" title="Crear Rúbrica">
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
                                <div class="white-box" id="container_filter" style="border-radius: 10px 10px 0 0;">
                                    <div class="row mt-25">
                                        <div class="col-lg-4">
                                            <div class="dataTables_wrapper no-footer">
                                                <div class="dataTables_filter">
                                                    <label class="">
                                                        <i class="ti-search"></i>
                                                        <input type="search" name="search_rubric" id="search_rubric" placeholder="Búsqueda rápida">
                                                    </label>
                                                </div>
                                            </div>
                                            <span class="modal_input_validation red_alert"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white-box" id="container_rubrics" style="border-radius: 0">
                                    <div class="dataTables_wrapper no-footer">
                                        <table id="table_rubrics" class="table school-table" style="border-radius: 10px; box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8);">
                                            <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody_rubrics">

                                            </tbody>
                                        </table>
                                        <div class="dataTables_info" id="table_info" role="status" aria-live="polite">

                                        </div>
                                        <div class="dataTables_paginate paging_simple_numbers" id="table_rubrics_paginate">
                                            <a class="paginate_button previous n-t-s" data-id="0" tabindex="0" id="previous">
                                                <span class="ti-angle-left"></span>
                                            </a>
                                            <span id="pagination_number">

                                            </span>
                                            <a class="paginate_button next n-t-s" data-id="20" tabindex="0" id="next">
                                                <span class="ti-angle-right"></span>
                                            </a>
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
        <script type="text/javascript" src="{{asset('js/rubrics/index.js')}}"></script>
    </body>
</html>
