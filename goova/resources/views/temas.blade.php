<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')

        <style>
            .white-box { padding: 25px 30px; }
            table.table.school-table thead tr th { padding: 10px; }
            table.table.school-table tbody tr td { padding: 15px; }
            .datepicker.dropdown-menu td { padding: 2px 11px; }

            .warning {
                padding: 20px;
                color: #b58105;
                background-color: #fff8db;
                border-radius: .28571429rem;
                box-shadow: 0 0 0 1px #c9ba9b inset,0 0 0 0 transparent;
                -webkit-box-shadow: 0 0 0 1px #c9ba9b inset,0 0 0 0 transparent;
            }
        </style>
    </head>
    <body class="admin">

        <div class="main-wrapper" style="min-height: 600px">
            <!-- Sidebar  -->
            @include('includes.sidebar')
            <div id="main-content">
                @include('includes.header')

                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <div class="main-title">
                                    <h1>Gestionar Temas</h1>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#" class="primary-btn small fix-gr-bg" onclick="openModalCreateTheme()" title="Agregar Ciclo/Periodo">
                                    <span class="ti-plus pr-2"></span>
                                    Agregar
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mt-50">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="white-box" id="container_filter" style="border-radius: 10px 10px 0 0;">
                                    @if(1 === 1)
                                        <div class="row mt-25">
                                            <div class="col-lg-4">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control" type="text" name="search_theme" id="search_theme">
                                                    <label>
                                                        Buscar
                                                    </label>
                                                    <span class="focus-border"></span>
                                                </div>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white-box" id="container_themes" style="border-radius: 0">
                                    <table id="table_times" class="table school-table" style="border-radius: 10px; box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8);">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Asignatura</th>
                                            <th>Curso</th>
                                            <th>Nº Periodo/Ciclo</th>
                                            <th>Descripción</th>
                                            @if(1 === 1) <th>Institución</th> @endif
                                        </tr>
                                        </thead>
                                        <tbody id="tbody_themes">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white-box" id="container_footer" style="border-radius: 0 0 10px 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        @include('includes.footer')

        <script type="text/javascript">
            /** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
            (function( $ ){
                $.fn.mValid = function(data) {
                    data.text = $.trim($(this).val()) === ''? data.text : '';
                    $(this).parents('div.input-effect').siblings('span').text(data.text);
                    console.log($(this).val());
                    return ($.trim($(this).val()) === '');
                };
            })( jQuery );

            const filterThemes = () => {
                $.ajax({
                    type: 'GET',
                    url: '/get-themes-list',
                    success: (data) => {
                        let html = '',
                            themes = data.themes;

                        themes.forEach((item) => {
                            html +=
                                '<tr>' +
                                    '<td>' +
                                        item.name +
                                    '</td>' +
                                    '<td>' +
                                        item.id_subject +
                                    '</td>' +
                                    '<td>' +
                                        item.id_course +
                                    '</td>' +
                                    '<td>' +
                                        item.id_time +
                                    '</td>' +
                                    '<td>' +
                                        item.description +
                                    '</td>' +
                                    '<td>' +
                                        item.id_entity +
                                    '</td>' +
                                '</tr>'
                        });

                        $('#tbody_themes').html(html);
                    }
                });
            };

            function openModalCreateTheme() {
                let html =
                    '<div class="container-fluid">' +
                        '<div class="row">' +
                            '<div class="col-lg-12">' +
                                '<div class="row mt-25">' +
                                    '<div class="col-lg-6">' +
                                        '<div class="input-effect">' +
                                            '<input class="primary-input form-control" type="text" name="name_create_theme" id="name_create_theme">' +
                                            '<label>' +
                                                'Nombre *<span></span> ' +
                                            '</label>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                        '<span class="modal_input_validation red_alert"></span>' +
                                    '</div>' +
                                    '<div class="col-lg-6">' +
                                        '<div class="input-effect">' +
                                            '<select class="niceSelect w-100 bb form-control" name="subject" id="subject">' +
                                                '<option data-display="Seleccionar Asignatura" value="">Select</option>' +
                                                '<option value="1">Matemáticas</option>' +
                                                '<option value="2">Sociales</option>' +
                                            '</select>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                        '<span class="modal_input_validation red_alert"></span>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="row mt-25">' +
                                    '<div class="col-lg-6">' +
                                        '<div class="input-effect">' +
                                            '<select class="niceSelect w-100 bb form-control" name="course" id="course">' +
                                                '<option data-display="Seleccionar Curso" value="">Select</option>' +
                                                '<option value="1">11-1</option>' +
                                            '</select>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                        '<span class="modal_input_validation red_alert"></span>' +
                                    '</div>' +
                                    '<div class="col-lg-6">' +
                                        '<div class="input-effect">' +
                                            '<select class="niceSelect w-100 bb form-control" name="time" id="time">' +
                                                '<option data-display="Seleccionar Ciclo/Periodo" value="">Select</option>' +
                                                '<option value="3">1</option>' +
                                            '</select>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                        '<span class="modal_input_validation red_alert"></span>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="row mt-25">' +
                                    '<div class="col-lg-12">' +
                                        '<div class="input-effect">' +
                                            '<textarea class="primary-input form-control" name="description_theme" id="description_theme" cols="30" rows="10"></textarea>' +
                                            '<label>' +
                                                'Descripción *<span></span> ' +
                                            '</label>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                        '<span class="modal_input_validation red_alert"></span>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-12 text-center">' +
                                    '<div class="mt-40 d-flex justify-content-between">' +
                                        '<button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>' +
                                        '<a href="#" class="primary-btn small fix-gr-bg" onclick="saveNewTheme()">' +
                                            '<span class="ti-plus pr-2"></span>' +
                                            'Guardar' +
                                        '</a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                universalModal('Crear Tema', html);
                $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
                $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                $('.niceSelect').niceSelect();
            }

            function saveNewTheme() {
                let pass = true,
                    empty = false,
                    subject = $.trim($('#subject').val()),
                    course = $.trim($('#course').val()),
                    time =  $.trim($('#time').val()),
                    name = $.trim($('#name_create_theme').val()),
                    description = $.trim($('#description_theme').val());

                empty = $('#subject').mValid({text: 'Asignatura no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#course').mValid({text: 'Curso no debe quedar vacío.'}); if(empty){ pass = false}
                empty = $('#time').mValid({text: 'Ciclo/Periodo no debe quedar vacío.'}); if(empty){ pass = false}
                empty = $('#name_create_theme').mValid({text: 'Nombre no debe quedar vacío.'}); if(empty){ pass = false}
                empty = $('#description_theme').mValid({text: 'Descripción no debe quedar vacía.'}); if(empty){ pass = false}

                if(pass){
                    $.ajax({
                        type: 'POST',
                        url: '/post-save-theme',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            subject,
                            course,
                            time,
                            name,
                            description
                        },
                        success: (data) => {
                            filterThemes();
                            $('.modal').modal('hide');
                            $("body").overhang({
                                type: "success",
                                message: "Exito! Se creó el Ciclo/Periodo exitosamente!"
                            });
                        }
                    });
                }
            }

            filterThemes();
        </script>
    </body>
</html>
