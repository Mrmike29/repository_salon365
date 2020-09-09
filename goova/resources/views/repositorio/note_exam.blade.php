<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
        <style>
            .common-radio:empty ~ label {
                float: unset !important;
            }
            .common-checkbox + label {
                display: inline-block !important;
                text-transform: capitalize;
                font-weight: 500;
            }
        </style>
    </head>
    <body class="admin">
		<div class="main-wrapper">
    		<!-- Sidebar -->
    		@include('includes.sidebar')
            <div id="main-content">
    		    @include('includes.header')
                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <h1>Validar Examen</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/crear_nota" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_exam" value="{{encrypt($examen->id)}}">
                            <input type="hidden" name="id_students" value="{{encrypt($info->id_users)}}">
                            <input type="hidden" name="id_course" value="{{encrypt($info->id_course)}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <div class="row mb-30">
                                                @foreach($preguntas as $key => $value)
                                                    <div class="form-group col-lg-12">
                                                        <p class="text-uppercase fw-500 mb-0">{{$value->description}}</p>
                                                        <div class="radio-btn-flex ml-40 row">
                                                            @foreach($respuestas as $k => $v)
                                                                @if($v->id_questions == $value->id)
                                                                    @if(!empty($v->description))
                                                                        <span>{{$v->description}}</span> <span>{{$v->status}}</span><br>
                                                                    @else
                                                                        <div class="col-lg-8">
                                                                            <span>{{$v->answer}}</span>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                                <select class="niceSelect w-100 bb form-control valid-request" name="status[{{$v->id}}]" id="st">
                                                                                    <option data-display="Seleccionar Tipo de Pregunta *" value="">Select</option>
                                                                                    <option value="t">Verdadera</option>
                                                                                    <option value="f">Falsa</option>
                                                                                </select>
                                                                                <span class="focus-border"></span>
                                                                            </div>
                                                                            <span class="modal_input_validation red_alert"></span>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="primary-btn goova-bt" id="submit-all" data-toggle="tooltip" title="">
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
            /** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
            (function( $ ){ 
                $.fn.mValid = function(data) { 
                    console.log($(this).attr('name') + ' = ' + $(this).val());

                    data.text = $.trim($(this).val()) === ''? data.text : ''; 
                    $(this).parents('div.input-effect').siblings('span').text(data.text); 
                    return ($.trim($(this).val()) === ''); 
                }; 
            })( jQuery );
            $('form.form-horizontal').submit(function(e){
                var res = false
                $('select.valid-request').each(function(){
                    var sel =   $(this).mValid({
                                    text: 'Campo vacío'
                                })
                    if(sel == true){
                        res = true
                    }
                })
                if(res){
                    e.preventDefault()
                }
            })
        </script>
    </body>
</html>