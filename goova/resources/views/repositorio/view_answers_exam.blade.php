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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="white-box">
                                    <div class="">
                                        <div class="row mb-30">
                                            @foreach($preguntas as $key => $value)
                                                <div class="form-group col-lg-12">
                                                    <p class="text-uppercase fw-500 mb-0">{{$value->description}}</p>
                                                    @if($value->id_type_question == 1)
                                                        <span class="mb-10" style="display: block;"><i>Por favor selecciona @if($value->max_answer == 1){{$value->max_answer}} {{'opción'}}@else{{$value->max_answer}} {{'opciones'}}@endif</i> @if($value->status == 't') <i class="icofont icofont-ui-check" style="color: green"></i> @else <i class="icofont icofont-ui-close" style="color: red"></i> @endif </span>
                                                        <div class="radio-btn-flex ml-40">
                                                            @foreach($preguntas_multiples as $k => $v)
                                                                @if($v->id_question == $value->id)
                                                                    <div class="mr-30">
                                                                        <input @if($v->answer){{'checked'}}@endif type="checkbox" id="section{{$v->id}}" data-id="{{$value->id}}" data-max="{{$value->max_answer}}" class="common-checkbox form-control valid-limit-{{$value->id}}" name="respuesta[{{$value->id}}][]" value="{{$v->id}}">
                                                                        <label for="section{{$v->id}}">{{$v->description}}</label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @elseif($value->id_type_question == 2)
                                                        <span class="mb-10" style="display: block;"><i>Por favor selecciona @if($value->max_answer == 1){{$value->max_answer}} {{'opción'}}@else{{$value->max_answer}} {{'opciones'}}@endif</i> @if($value->status == 't') <i class="icofont icofont-ui-check" style="color: green"></i> @else <i class="icofont icofont-ui-close" style="color: red"></i> @endif </span>
                                                        <div class="radio-btn-flex ml-40">
                                                            @foreach($preguntas_multiples as $k => $v)
                                                                @if($v->id_question == $value->id)
                                                                    <div class="mr-30">
                                                                        <input @if($v->answer){{'checked="checked"'}}@endif type="radio" name="respuesta[{{$value->id}}][]" id="relation{{$v->id}}" value="{{$v->id}}" class="common-radio relationButton" required>
                                                                        <label for="relation{{$v->id}}">{{$v->description}}</label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @elseif($value->id_type_question == 3)
                                                        @foreach($respuestas as $k => $v)
                                                            @if($v->id_questions == $value->id)
                                                                <span class="mb-10" style="display: block;"><i>Respuesta</i>@if($v->status == 't') <i class="icofont icofont-ui-check" style="color: green"></i> @else <i class="icofont icofont-ui-close" style="color: red"></i>@endif</span>
                                                                <div class="radio-btn-flex ml-40">
                                                                    @if(!empty($v->description))
                                                                        <span>{{$v->description}}</span> <span>{{$v->status}}</span><br>
                                                                    @else
                                                                        <div class="col-lg-8">
                                                                            <span>{{$v->answer}}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                            <div class="form-group col-lg-12">
                                                <center>
                                                    <h2>Nota {{$nota->value}}</h2>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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