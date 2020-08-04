<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body class="admin">
		<div class="main-wrapper">
    		<!-- Sidebar  -->
    		@include('includes.sidebar')
            <div id="main-content">
    		    @include('includes.header')
                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <h1>Agragar Tarea</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area">
                    <div class="container-fluid p-0">
                        <form method="POST" action="https://infixedu.com/save-homework-data" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <input type="hidden" name="url" id="url" value="https://infixedu.com">
                                            <div class="row mb-30">
                                                <div class="col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="class_id" id="classSelectStudent">
                                                            <option data-display="Seleccionar Clase *" value="">Select</option>
                                                            <option value="1" >One 1</option>
                                                            <option value="5" >Two 1</option>
                                                            <option value="9" >Three 1</option>
                                                            <option value="13" >Four 1</option>
                                                            <option value="17" >Five 1</option>
                                                            <option value="21" >Six 1</option>
                                                            <option value="25" >Seven 1</option>
                                                            <option value="29" >Eight 1</option>
                                                            <option value="33" >Nine 1</option>
                                                            <option value="37" >Ten 1</option>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                                        <select class="niceSelect w-100 bb form-control" name="section_id" id="sectionSelectStudent">
                                                            <option data-display="Seleccionar Materia *" value="">Section *</option>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-30">
                                                <div class="col-lg-6">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input date form-control" id="homework_date" type="text" name="homework_date" value="{{date('m/d/Y')}}" readonly="true">
                                                                <label>Fecha Inicio <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="" type="button">
                                                                <i class="ti-calendar" id="homework_date_icon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input date form-control" id="submission_date" type="text" name="submission_date" value="08/03/2020" readonly="true">
                                                                <label>Fecha Fin <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="" type="button">
                                                                <i class="ti-calendar" id="submission_date_icon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row md-20">
                                                <div class="col-lg-12">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row md-20">
                                                <div class="col-lg-12">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <div class="form-group" id="textarea">
                                                            <textarea id="texto" name="cotizacion"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                                <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="">
                                                    <span class="ti-check"></span>
                                                    Save Homework
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
    	</div>
    	@include('includes.footer')
    </body>
</html>
