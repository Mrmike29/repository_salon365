<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
        <style>
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
        </style>
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
                                                        <select class="niceSelect w-100 bb form-control" name="id_course">
                                                            <option data-display="Seleccionar Curso *" value="">Select</option>
                                                            @foreach($cursos as $key => $val)
                                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                                        <select class="niceSelect w-100 bb form-control" name="id_subjects" id="sectionSelectStudent">
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
                                                                <input class="primary-input date form-control" id="homework_date" type="text" name="homework_date" value="{{date('d/m/Y')}}" readonly="true">
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
                                                {{-- <div class="col-lg-3">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="text" name="marks" value="">
                                                                <label>Marks <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
        <script src="https://soporte.stratecsa.com/assets/js/froala_editor.pkgd.min.js"></script>
        <script src="https://soporte.stratecsa.com/assets/js/application-18caf78ea729799d396faaacacecde7c.js"></script>
        <script>
            Dropzone.autoDiscover = false;
            jQuery(document).ready(function() {
                $("div#my-awesome-dropzone").dropzone({
                    url: "{{URL::asset('archivo')}}",
                    dictDefaultMessage: "Agrege los archivos de la tarea",
                    addRemoveLinks: true,
                    dictRemoveFile: "Eliminar archivo",
                    maxfilesexceeded: 5024,
                    dictFileTooBig: "El tamaño maximo de archivos es de 5MB."
                });
            });
            var editor = new FroalaEditor('#textarea textarea', {
                language: 'es',
                fontFamilyDefaultSelection: 'Font',
                fontFamily: {
                    'Arial,Helvetica,sans-serif': 'Arial',
                    'Georgia,serif': 'Georgia',
                    'Impact,Charcoal,sans-serif': 'Impact',
                    'Tahoma,Geneva,sans-serif': 'Tahoma',
                    "'Times New Roman',Times,serif": 'Times New Roman',
                    'Verdana,Geneva,sans-serif': 'Verdana',
                    "'Open Sans Condensed',sans-serif": 'Open Sans Condensed',
                    "'Century Gothic', Futura, sans-serif": 'Century Gothic'
                }
            } );
            $(document).on('change','select[name=id_course]',function(){
                var id = $(this).val()
                $.ajax({
                    url: '/materias_tereas/'+id,
                    type: 'get',
                    success:function(dato){
                        var html = ''
                        $(dato).each(function(k,v){
                            html += `<option value="${v.id}">${v.subjects} - ${v.teacher} ${v.last_name}</option>`
                        })
                        console.log(html)
                    }
                })
            })
        </script>
    </body>
</html>
