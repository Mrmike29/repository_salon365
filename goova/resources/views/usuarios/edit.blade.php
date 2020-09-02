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
                            <h1>Editar Usuario</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area up_st_admin_visitor">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/post_usuario" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$usuario->id}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <div class="row mb-30">
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_type_document" id="classSelectStudent" required>
                                                            <option data-display="Tipo de Documento *" value="">Select</option>
                                                            @foreach($type_document as $key => $val)
                                                                @if($val->id == $usuario->id_type_document)
                                                                    <option value="{{$val->id}}" selected>{{$val->name}}</option>
                                                                @else
                                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="number" name="document" value="{{$usuario->document}}" required>
                                                                <label>No° Documento <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="text" name="name" value="{{$usuario->name}}" required>
                                                                <label>Nombres <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="text" name="last_name" value="{{$usuario->last_name}}" required>
                                                                <label>Apellidos <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_rol" id="classSelectStudent" required>
                                                            <option data-display="Tipo de Rol *" value="">Select</option>
                                                            @foreach($roles as $key => $val)
                                                                @if($val->id == $usuario->id_rol)
                                                                    <option value="{{$val->id}}" selected>{{$val->name}}</option>
                                                                @else
                                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group @if($user_list){{'col-lg-6'}}@endif" id="list_students">
                                                    @if($user_list)
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_list_students" id="classSelectStudent" required>
                                                            <option data-display="Seleccionar lista *" value="">Select</option>
                                                            @foreach($list_students as $key => $val)
                                                                @if($user_list->id_list_students == $val->id)
                                                                    <option value="{{$val->id}}" selected>{{$val->name}}</option>
                                                                @else
                                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="email" name="email" value="{{$usuario->email}}" required>
                                                                <label>Correo Electronico<span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="password" name="password" value="">
                                                                <label>Contraseña <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="password" name="c-password" value="">
                                                                <label>Confirmar Contraseña <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="number" name="phone" value="{{$usuario->phone}}">
                                                                <label>Telefono <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="text" name="address" value="{{$usuario->address}}">
                                                                <label>Dirección <span>*</span></label>
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
            var password = true
            $(document).on('change, keyup','input[name=password], input[name=c-password]',function(){
                var pass = $('input[name=password]').val()
                var c_pass = $('input[name=c-password]').val()
                if(pass !== c_pass){
                    password = false
                }else{
                    password = true
                }
            })
            $('form.form-horizontal').submit(function(){
                if(password == true){
                    return true
                }else{
                    $('.invalid-feedback strong').html('Las contraseñas no coinciden')
                    $('.invalid-feedback').removeAttr('style')
                    $('input[name=c-password]').addClass('is-invalid')
                }
                return false
            })
            $(document).on('change','select[name=id_rol]',function(){
                var id = $(this).val()
                var html = `<div class="input-effect sm2_mb_20 md_mb_20">
                                <select class="niceSelect w-100 bb form-control" name="id_list_students" id="classSelectStudent" required>
                                    <option data-display="Seleccionar Curso *" value="">Select</option>
                                    @foreach($list_students as $key => $val)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                    @endforeach
                                </select>
                                <span class="focus-border"></span>
                            </div>`
                if(id == 5){
                    var list_students = $('#list_students').find('.classSelectStudent')
                    if(!list_students.length){
                        $('#list_students').html(html).addClass('col-lg-6')
                        $('select[name=id_list_students]').niceSelect();
                    }
                }else{
                    $('#list_students').removeClass('col-lg-6').html("")
                }
            })
            $('#list_students').trigger('change')
        </script>
    </body>
</html>
