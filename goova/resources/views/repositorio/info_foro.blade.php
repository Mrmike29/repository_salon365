<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
        <style>
            .admin-visitor-area {
                position: absolute;
                width: 78%;
                height: 80%;
                overflow-y: scroll;
                padding: 0px 5px;
            }
            .icofont {
                font-size: 17px;
            }
        </style>
    </head>
    <body class="admin">
		<div class="main-wrapper">
    		<!-- Sidebar  -->
    		@include('includes.sidebar')
            <div id="main-content">
    		    @include('includes.header')
                {{-- <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <h1>Ver Foros</h1>
                        </div>
                    </div>
                </section> --}}
                <section id="show-table" class="admin-visitor-area up_st_admin_visitor">
                    <div class="container-fluid p-0">
                        @foreach($contenido as $key => $val)
                            <div class="row m-0 @if(Auth::user()->id == $val->id){{'d-flex justify-content-end'}}@endif">
                                <div class="p-0 col-md-7 col-md-offset-4">
                                    <div class="white-box mt-10" style="padding: 20px 20px;">
                                        <h5 style="text-transform: uppercase;"><b>{{$val->name}} {{$val->last_name}}</b> ({{$val->rol}}) a <b>{{$val->answer_name}} {{$val->answer_last_name}}</b></h5>
                                        <?= $val->content ?>
                                        @if(!$archivos->isEmpty())
                                            <span class="text-primary">Archivos adjuntos</span>
                                            @foreach($archivos as $k => $v)
                                                @if($val->id_content == $v->id_content_foro)
                                                    <a href="/archives/{{$v->description}}" download data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Clic para descargar">
                                                        @php $exts=explode(".",$v->description); $exts=strtolower(end($exts)); @endphp
                                                        @if($exts == "jpg" || $exts == "jpeg")
                                                            <i class="icofont icofont-file-jpg"></i>
                                                        @elseif($exts == "png")
                                                            <i class="icofont icofont-file-png"></i>
                                                        @elseif($exts == "gif")
                                                            <i class="icofont icofont-file-gif"></i>
                                                        @elseif($exts == "psd")
                                                            <i class="icofont icofont-file-psd"></i>
                                                        @elseif($exts == "pdf")
                                                            <i class="icofont icofont-file-pdf"></i>
                                                        @elseif($exts == "zip" || $exts == "rar")
                                                            <i class="icofont icofont-file-zip"></i>
                                                        @elseif($exts == "docx" || $exts == "docm" || $exts == "dotx" || $exts == "dotm" || $exts == "doc" || $exts == "dot")
                                                            <i class="icofont icofont-file-word"></i>
                                                        @elseif($exts == "xlsx" || $exts == "xlsm" || $exts == "xlsb" || $exts == "xltx" || $exts == "xltm" || $exts == "xls" || $exts == "xlt" || $exts == "xml" || $exts == "xlam" || $exts == "xla" || $exts == "xlw" || $exts == "xlr")
                                                            <i class="icofont icofont-file-excel"></i>
                                                        @else
                                                            <i class="icofont icofont-file-alt"></i>
                                                        @endif
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif
                                        <div class="reply" style="display: flex; justify-content: flex-end;">
                                            <a href="/info_foro_responder/{{$val->id_content_foro}}" style="text-decoration: underline;">Responder</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
        @include('includes.footer')
        <script>
            $('a[download]').popover();
        </script>
    </body>
</html>