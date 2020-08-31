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
                            <h1>Responder Foro</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/crear_respuest_foro" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_answer" value="{{$contenido->id_user}}">
                            <input type="hidden" name="id_foro" value="{{$contenido->id_foro}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <div class="row mb-30">
                                                <div class="form-group col-lg-12">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div><br>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <div class="form-group" id="textarea">
                                                            <textarea id="texto" name="descriptions" id="description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="primary-btn fix-gr-bg" id="submit-all" data-toggle="tooltip" title="">
                                                    <span class="ti-check"></span>
                                                    Guardar
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
        <script>
            Dropzone.autoDiscover = false;
            jQuery(document).ready(function() {
                var uploadedDocumentMap = {}
                $("div#my-awesome-dropzone").dropzone({
                    url: "/archivo",
                    dictDefaultMessage: "Agrege los archivos",
                    addRemoveLinks: true,
                    dictRemoveFile: "Eliminar archivo",
                    // maxfilesexceeded: 5024,
                    maxFilesize: 5,
                    dictFileTooBig: "El tamaño maximo de archivos es de 5MB.",
                    // autoProcessQueue: false,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (file, response) {
                        $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                        uploadedDocumentMap[file.name] = response.name
                    },
                    removedfile: function (file) {

                        var name = ''
                        if (typeof file.file_name !== 'undefined') {
                            name = file.file_name
                        } else {
                            name = uploadedDocumentMap[file.name]
                        }

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            type: 'POST',
                            url: '/delete_archivo',
                            data: {filename: name},
                            success: function (data){
                                console.log("File deleted successfully!!");
                            },
                            error: function(e) {
                                console.log(e);
                            }
                        });
                        file.previewElement.remove()

                        $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                    }
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
                },
                imageUploadParam: 'file' ,
                imageUploadURL: '/upload_image' ,
                imageUploadParams: { id : 'my_editor' },
                imageUploadMethod: 'POST' ,
                imageMaxSize: 5 * 1024 * 1024 ,
                imageAllowedTypes: [ 'jpeg' , 'jpg' , 'png' ]
            } );
        </script>
    </body>
</html>