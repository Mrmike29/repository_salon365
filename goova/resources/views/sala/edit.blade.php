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
                            <h1>Editar Sala</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area up_st_admin_visitor">
                    <div class="container-fluid p-0">
                        <form method="POST" action="{{route('editarSala')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @foreach($room as $key => $value)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="white-box">
                                            <div class="">
                                                <div class="row mb-30">
                                                    <input type="hidden" value="{{encrypt($value->id_video_chat)}}" name="id_video_chat">
                                                    <input type="hidden" value="{{encrypt($value->id)}}" name="id_room">
                                                    <div class="form-group col-lg-6 ">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <input class="read-only-input primary-input date form-control" type="text" readonly="true" value="{{date('Y-m-d',strtotime($value->start_date))}}" min="{{date('Y-m-d')}}" id="datetime_create_event" name="start_date">
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6 ">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <input class=" primary-input  form-control" type="time"  name="hora">
                                                            <label>Hora Inicio </label>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <select class="niceSelect w-100 bb form-control" name="id_list_students" id="classSelectStudent" required>
                                                                <option data-display="Escoger listado *" value="">Select</option>
                                                                @foreach($lista as $key => $val)
                                                                    <option value="{{$val->id}}" @if($value->id_list_students == $val->id) selected @endif>{{$val->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <select class="niceSelect w-100 bb form-control" name="id_subject" id="classSelectStudent" required>
                                                                <option data-display="Escoger asignatura *" value="">Select</option>
                                                                @foreach($asignatura as $key => $val)
                                                                    <option value="{{$val->id}}" @if($value->id_subject == $val->id) selected @endif>{{$val->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <div class="row no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                                    <textarea class="primary-input form-control" rows="4" name="description"  required="">{{$value->description}}</textarea>
                                                                    <label>Descripción <span>*</span></label>
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row mt-40">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="primary-btn goova-bt" data-toggle="tooltip" title="">
                                                        <span class="ti-check"></span>
                                                        Guardar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </section>
            </div>
        </div>
        @include('includes.footer')
        <script>

        </script>
    </body>
</html>
