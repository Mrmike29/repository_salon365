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
                            <h1>Examen</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/crear_realizar_examen" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_exam" value="{{encrypt($examen->id)}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <div class="row mb-30">
                                                @foreach($preguntas as $key => $value)
                                                    <div class="form-group col-lg-12">
                                                        <p class="text-uppercase fw-500 mb-0">{{$value->description}}</p>
                                                        @if($value->id_type_question == 1)
                                                            <span class="mb-10" style="display: block;"><i>Por favor selecciona @if($value->max_answer == 1){{$value->max_answer}} {{'opción'}}@else{{$value->max_answer}} {{'opciones'}}@endif</i></span>
                                                            <div class="radio-btn-flex ml-40 valids" data-p="1" data-max="{{$value->max_answer}}">
                                                                @foreach($preguntas_multiples as $k => $v)
                                                                    @if($v->id_question == $value->id)
                                                                        <div class="mr-30">
                                                                            <input type="checkbox" id="section{{$v->id}}" data-id="{{$value->id}}" data-max="{{$value->max_answer}}" class="common-checkbox form-control valid-limit-{{$value->id}}" name="respuesta[{{$value->id}}][]" value="{{$v->id}}">
                                                                            <label for="section{{$v->id}}">{{$v->description}}</label>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <span class="modal_input_validation red_alert"></span>
                                                        @elseif($value->id_type_question == 2)
                                                            <span class="mb-10" style="display: block;"><i>Por favor selecciona @if($value->max_answer == 1){{$value->max_answer}} {{'opción'}}@else{{$value->max_answer}} {{'opciones'}}@endif</i></span>
                                                            <div class="radio-btn-flex ml-40 valids" data-p="2" data-max="{{$value->max_answer}}">
                                                                @foreach($preguntas_multiples as $k => $v)
                                                                    @if($v->id_question == $value->id)
                                                                        <div class="mr-30">
                                                                            <input type="radio" name="respuesta[{{$value->id}}][]" id="relation{{$v->id}}" value="{{$v->id}}" class="common-radio relationButton" required>
                                                                            <label for="relation{{$v->id}}">{{$v->description}}</label>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <span class="modal_input_validation red_alert"></span>
                                                        @elseif($value->id_type_question == 3)
                                                            <div class="radio-btn-flex ml-40">
                                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                                    <textarea class="primary-input form-control valid-request" cols="0" rows="5" name="respuesta[{{$value->id}}][]" id="guardians_address" required></textarea>
                                                                    <label>Respuesta <span></span> </label>
                                                                    <span class="focus-border textarea"></span>
                                                                </div>
                                                                <span class="modal_input_validation red_alert"></span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                                <button type="button" class="primary-btn goova-bt" id="submit-all" data-toggle="tooltip" title="">
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
        <div class="modal fade admin-query" id="examCourseModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center" id="descripcion">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade admin-query" id="Modal-confirmacion" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirmar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h3>Estas seguro que deseas Finalizar y Guardar?</h3>
                            <h4>Recuerde que después de guardar no podrá modificar las respuestas del examen</h4>
                        </div>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancelar</button>
                            <button class="primary-btn goova-bt" id="submit">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
        <script>
            /** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
            (function( $ ){ 
                $.fn.mValid = function(data) {
                    data.text = $.trim($(this).val()) === ''? data.text : ''; 
                    $(this).parents('div.input-effect').siblings('span').text(data.text); 
                    return ($.trim($(this).val()) === ''); 
                }; 
            })( jQuery );
            $(document).on('click','input.common-checkbox',function(){
                var id = $(this).data('id')
                var max = $(this).data('max')
                var i = 0
                $('.valid-limit-'+id).each(function(){
                    if($(this).is(':checked')) {  
                        i++  
                    }
                })
                if(i > max){
                    $(this).prop('checked', false);  
                }
            })
            function valid_questions(){
                var status = false
                $('.valids').each(function(){
                    var pre = $(this).data('p')
                    var max = $(this).data('max')
                    // if(pre == 1){
                        var i = 0
                        $(this).find('input[name^=respuesta]').each(function(){
                            if($(this).is(':checked')){
                                i++
                            }
                        })
                    // }
                    if(max != i){
                        status = true
                        $(this).parent().find('span.modal_input_validation.red_alert').html('Falta una o mas respuestas verdaderas').show()
                    }else{
                        $(this).parent().find('span.modal_input_validation.red_alert').html('').hide()
                    }
                })
                return status
            }
            $(document).on('click','#submit-all',function(){
                var res = false
                $('textarea.valid-request').each(function(){
                    var sel =   $(this).mValid({
                                    text: 'Campo vacío'
                                })
                    if(sel == true){
                        res = true
                    }
                })
                var valid = valid_questions()
                if(res || valid){
                    e.preventDefault()
                }else{
                    $('#Modal-confirmacion').modal('show')
                }
            })
            $(document).on('click','#Modal-confirmacion button#submit',function(){
                $('form.form-horizontal').submit()
            })
        </script>
    </body>
</html>