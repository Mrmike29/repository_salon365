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
                            <h1>Crear Usuario</h1>
                        </div>
                    </div>
                </section>
                <section class="admin-visitor-area up_st_admin_visitor">
                    <div class="container-fluid p-0">
                        <form method="POST" action="/store_usuarios" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="formularioImagen">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="white-box">
                                        <div class="">
                                            <div class="row mb-30">
                                                <div class="form-group col-lg-6" >
                                                    <div class="col-lg-6 col-sm-6 col-xs-6 col-6">Imagen perfil</div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6 col-6" style="text-align: unset;">
                                                        <div style="text-align:center;display: none;width: 55%;height: 150px;border: 1px solid gainsboro;margin-bottom: 10px;margin-left: 20px;" id="imgPrev2"><img class="img_a" src="" style="width: auto;height: 145px;"></div>
                                                        <label class="filebutton"><span><input onchange="$(this).parents('tr').find('b').html('Archivo cargado');" type="file" id="id1" name="picture" style="display: none;"></span><b id="1" class="btn btn-primary btn-sm" style="width: 100%"><i class="tam fa fa-upload"></i> Seleccionar Archivo...</b></label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_type_document" id="classSelectStudent" required>
                                                            <option data-display="Tipo de Documento *" value="">Select</option>
                                                            @foreach($type_document as $key => $val)
                                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="number" name="document" value="" required>
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
                                                                <input class="primary-input form-control" type="text" name="name" value="" required>
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
                                                                <input class="primary-input form-control" type="text" name="last_name" value="" required>
                                                                <label>Apellidos <span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6" id="rols">
                                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                                        <select class="niceSelect w-100 bb form-control" name="id_rol" id="classSelectStudent" required>
                                                            <option data-display="Tipo de Rol *" value="">Select</option>
                                                            @foreach($roles as $key => $val)
                                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="list_students">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                                <input class="primary-input form-control" type="email" name="email" value="" required>
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
                                                                <input class="primary-input form-control" type="password" name="password" value="" required>
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
                                                                <input class="primary-input form-control" type="password" name="c-password" value="" required>
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
                                                                <input class="primary-input form-control" type="number" name="phone" value="">
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
                                                                <input class="primary-input form-control" type="text" name="address" value="">
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
            $(document).on('change','input[name=picture]',function(){
                $.ajax({
                    url:'/previsualizarImagen',
                    type:'POST',
                    data: new FormData($('#formularioImagen')[0]),
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data.nm2)
                        if (data.nm2!="") {
                            $('#imgPrev2').html(`<img class="img_a" src="${data.nm2}" style="width: auto;height: 145px;">`)
                            $('#imgPrev2').css('display','block')
                        }
                    }
                })
            })
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
                    $('#list_students').html(html).addClass('col-md-6')
                    $('select[name=id_list_students]').niceSelect();
                }else{
                    $('#list_students').removeClass('col-md-6').html("")
                }
            })
            
            $('[name="id_rol"]').change(function () {

                $('#parent_students').remove();

                if ($(this).val()*1 !== 6) return false;

                let c = 1;

                let html =
                    '<div class="form-group col-12" style="height: 300px; max-height: 300px; overflow-y: auto;" id="parent_students">' +
                        '<div style="display: flex">' +
                            '<div class="form-group col-5">' +
                                '<div class="row no-gutters input-right-icon">' +
                                    '<div class="col">' +
                                        '<div class="input-effect sm2_mb_20 md_mb_20">' +
                                            '<select class="niceSelect w-100 bb form-control" name="course_' + c + '" id="course_' + c + '" required>' +
                                                '<option data-display="Seleccione Curso" value="">Seleccione Curso</option>' +
                                                '<option value="1">11</option>' +
                                            '</select>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="form-group col-5">' +
                                '<div class="row no-gutters input-right-icon">' +
                                    '<div class="col">' +
                                        '<div class="input-effect sm2_mb_20 md_mb_20">' +
                                            '<select class="niceSelect w-100 bb form-control" name="student_' + c + '" id="student_' + c + '" required>' +

                                            '</select>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="form-group col-2">' +

                            '</div>' +
                        '</div>' +
                    '</div>';

                $(html).insertAfter($('#rols'));
                $('#course_' + c).niceSelect('destroy').niceSelect();
                $('#student_' + c).niceSelect('destroy').niceSelect();

                $('[id^="course_"]').change(function () {
                    searchStudents($(this).attr('id').split('_').pop());
                })
            });

            const searchStudents = (id) => {
                $.ajax({
                    type: 'GET',
                    url: '/get-students-per-course',
                    data: { id }
                }).done((data) => {
                    
                })
            }
        </script>
    </body>
</html>
