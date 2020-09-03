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
                            <h1>Sala</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area up_st_admin_visitor">
                    <div class="container-fluid p-0">
                        <form method="POST" action="{{route('crearSala')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <div class="row mb-30">
                                                <!-- <div class="form-group col-lg-6 ">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <input class="read-only-input primary-input date form-control" type="text" readonly="true" value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}" id="datetime_create_event" name="start_date">
                                                        
                                                    </div>
                                                </div> -->
                                                <div class="form-group col-lg-6 ">
                                                    <div class="no-gutters input-right-icon"> 
                                                        <div class="col"> 
                                                            <div class="input-effect date"> 
                                                                <div class="input-group"> 
                                                                    <input class="read-only-input primary-input  form-control" id="date_create_event" type="text" readonly="true" autocomplete="off" name="start_date" value="{{ date("Y-m-d") }}"> 
                                                                    <input class="read-only-input primary-input  form-control" id="datetime_create_event" type="text" autocomplete="off" name="hora"> 
                                                                </div> 
                                                            </div> 
                                                            <span class="modal_input_validation red_alert"></span> 
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <!-- <div class="form-group col-lg-6 ">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <input class=" primary-input  form-control" type="time"  name="hora">
                                                        <label>Hora Inicio </label>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div> -->
                                                <div class="form-group col-lg-6 ">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_list_students" id="classSelectStudent" required>
                                                            <option data-display="Escoger listado *" value="">Select</option>
                                                            @foreach($lista as $key => $val)
                                                                <option value="{{$val->id}}">{{$val->name}}</option>
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
                                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <textarea class="primary-input form-control" rows="4" name="description" value="" ></textarea>
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
                        </form>
                    </div>
                </section>
            </div>
        </div>
        @include('includes.footer')
        <script>
            $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
            $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
            $('#date_create_event').datepicker({ format: 'yyyy-mm-dd', autoclose: false, setDate: new Date() }).on('changeDate', function (ev) { $(this).focus(); });
            $("#datetime_create_event").datetimepicker({format: 'HH:mm' }).val("00:00");
        </script>
    </body>
</html>
