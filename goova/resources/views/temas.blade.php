<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')

        <style>
            .white-box { padding: 25px 30px; }
            table.table.school-table thead tr th { padding: 10px; }
            table.table.school-table tbody tr td { padding: 15px; }
            .datepicker.dropdown-menu td { padding: 2px 11px; }

            /*.tooltip > .tooltip-inner {background: linear-gradient(90deg, var(--g-third) 0%, var(--g-first) 51%, var(--g-third) 100%);}*/
            /*.tooltip > .tooltip-arrow {border-bottom-color:#f00;}*/

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
                                <a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="openModalCreateTheme()" title="Agregar Tema">
                                    <span class="ti-plus"></span>
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
                                    <div class="row mt-25">
                                    @if(1 === 1)
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
                                    @endif
                                        <div class="col-lg-4">
                                            <div class="input-effect">
                                                <select class="niceSelect w-100 bb form-control" name="subject_filter" id="subject_filter">

                                                </select>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-effect">
                                                <select class="niceSelect w-100 bb form-control" name="times_filter" id="times_filter">

                                                </select>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                    </div>
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
                                            <th>Acciones</th>
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
            let edId = 0;

            /** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
            (function( $ ){
                $.fn.mValid = function(data) {
                    data.text = $.trim($(this).val()) === ''? data.text : '';
                    $(this).parents('div.input-effect').siblings('span').text(data.text);
                    return ($.trim($(this).val()) === '');
                };
            })( jQuery );

            $('#search_theme').change(() => { filterThemes( $('#search_theme').val(), $('#subject_filter').val(), $('#times_filter').val() ); })
            $('#subject_filter').change(() => { filterThemes( $('#search_theme').val(), $('#subject_filter').val(), $('#times_filter').val() ); })
            $('#times_filter').change(() => { filterThemes( $('#search_theme').val(), $('#subject_filter').val(), $('#times_filter').val() ); })

            const
                filterThemes = (search, subject, time) => {
                    $.ajax({
                        type: 'GET',
                        url: '/get-themes-list',
                        data: { search, subject, time },
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
                                            item.subject +
                                        '</td>' +
                                        '<td>' +
                                            item.course +
                                        '</td>' +
                                        '<td>' +
                                            'Nº ' + item.time +
                                        '</td>' +
                                        '<td>' +
                                            item.description +
                                        '</td>' +
                                        '<td>' +
                                            item.entity +
                                        '</td>' +
                                        '<td>' +
                                            '<a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="openModalEditTheme(' + item.id + ')" title="Editar Tema">' +
                                                '<span class="ti-pencil-alt"></span>' +
                                            '</a>' +
                                        '</td>' +
                                    '</tr>'
                            });

                            $('#tbody_themes').html(html);
                            $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
                        }
                    });
                },
                subjectsFilter = () => {
                    $.ajax({
                        type: 'GET',
                        url: '/get-subject-filter',
                        success: (data) => {
                            let html = '<option data-display="Todas Las Asignaturas" value=""></option>' +
                                        '<option value="">Todas Las Asignaturas</option>',
                                subjects = data.subjects;

                            subjects.forEach((item) => { html += '<option value="' + item.id + '">' + item.name + '</option>' });

                            $('#subject_filter').html(html).niceSelect('destroy').niceSelect();
                        }
                    });
                },
                timesFilter = () => {
                    $.ajax({
                        type: 'GET',
                        url: '/get-times-filter',
                        success: (data) => {
                            let html = '<option data-display="Todos Los Periodos" value=""></option>' +
                                        '<option value="">Todos Los Periodos</option>',
                                times = data.times;

                            times.forEach((item) => { html += '<option value="' + item.id + '">Nº ' + item.name + '</option>' });

                            $('#times_filter').html(html).niceSelect('destroy').niceSelect();
                        }
                    });
                };

            function openModalCreateTheme() {
                $.ajax({
                    type: 'GET',
                    url: '/get-data-create-theme',
                    success: (data) => {
                        let html = '',
                            subjects = data.subjects,
                            courses = data.courses,
                            times = data.times;
                        html =
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
                                                    '<option data-display="Seleccionar Asignatura" value="">Select</option>';
                                                    subjects.forEach((item) => {
                                                        html += '<option value="' + item.id + '">' + item.name + '</option>'
                                                    })
                                            html +=
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
                                                    '<option data-display="Seleccionar Curso" value="">Select</option>';
                                                    courses.forEach((item) => {
                                                        html += '<option value="' + item.id + '">' + item.name + '</option>'
                                                    })
                                            html +=
                                                '</select>' +
                                                '<span class="focus-border"></span>' +
                                            '</div>' +
                                            '<span class="modal_input_validation red_alert"></span>' +
                                        '</div>' +
                                        '<div class="col-lg-6">' +
                                            '<div class="input-effect">' +
                                                '<select class="niceSelect w-100 bb form-control" name="time" id="time">' +
                                                    '<option data-display="Seleccionar Ciclo/Periodo" value="">Select</option>';
                                                    times.forEach((item) => {
                                                        html += '<option value="' + item.id + '">Nº ' + item.name + '</option>'
                                                    })
                                            html +=
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
                                            '<a href="#" class="primary-btn small goova-bt" onclick="saveNewTheme()">' +
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
                        $('#subject').niceSelect(); $('#course').niceSelect(); $('#time').niceSelect();
                    }
                });
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
                            filterThemes( $('search_theme').val(), $('subject_filter').val(), $('times_filter').val() );
                            $('.modal').modal('hide');
                            $("body").overhang({
                                type: "success",
                                message: "Exito! Se creó el Tema exitosamente!"
                            });
                        }
                    });
                }
            }

            function openModalEditTheme(id) {
                $.ajax({
                    type: 'GET',
                    url: '/get-data-edit-theme',
                    data: { id },
                    success: (data) => {
                        let html = '',
                            subjects = data.subjects,
                            courses = data.courses,
                            times = data.times,
                            theme = data.theme;

                        edId = theme.id;

                        html =
                        '<div class="container-fluid">' +
                            '<div class="row">' +
                                '<div class="col-lg-12">' +
                                    '<div class="row mt-25">' +
                                        '<div class="col-lg-6">' +
                                            '<div class="input-effect">' +
                                                '<input class="primary-input form-control has-content" type="text" name="name_edit_theme" id="name_edit_theme" value="' + theme.name +'">' +
                                                '<label>' +
                                                    'Nombre *<span></span> ' +
                                                '</label>' +
                                                '<span class="focus-border"></span>' +
                                            '</div>' +
                                            '<span class="modal_input_validation red_alert"></span>' +
                                        '</div>' +
                                        '<div class="col-lg-6">' +
                                            '<div class="input-effect">' +
                                                '<select class="niceSelect w-100 bb form-control has-content" name="subject" id="subject">' +
                                                    '<option data-display="Seleccionar Asignatura" value="">Select</option>';
                                                    subjects.forEach((item) => {
                                                        html += '<option value="' + item.id + '" ' + ((theme.id_subject === item.id)? 'selected' : '') + '>' + item.name + '</option>'
                                                    })
                                            html +=
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
                                                    '<option data-display="Seleccionar Curso" value="">Select</option>';
                                                    courses.forEach((item) => {
                                                        html += '<option value="' + item.id + '" ' + ((theme.id_course === item.id)? 'selected' : '') + '>' + item.name + '</option>'
                                                    })
                                            html +=
                                                '</select>' +
                                                '<span class="focus-border"></span>' +
                                            '</div>' +
                                            '<span class="modal_input_validation red_alert"></span>' +
                                        '</div>' +
                                        '<div class="col-lg-6">' +
                                            '<div class="input-effect">' +
                                                '<select class="niceSelect w-100 bb form-control" name="time" id="time">' +
                                                    '<option data-display="Seleccionar Ciclo/Periodo" value="">Select</option>';
                                                    times.forEach((item) => {
                                                        html += '<option value="' + item.id + '" ' + ((theme.id_time === item.id)? 'selected' : '') + '>Nº ' + item.name + '</option>'
                                                    })
                                            html +=
                                                '</select>' +
                                                '<span class="focus-border"></span>' +
                                            '</div>' +
                                            '<span class="modal_input_validation red_alert"></span>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row mt-25">' +
                                        '<div class="col-lg-12">' +
                                            '<div class="input-effect">' +
                                                '<textarea class="primary-input form-control has-content" name="description_theme" id="description_theme" cols="30" rows="10">' + theme.description +'</textarea>' +
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
                                            '<a href="#" class="primary-btn small goova-bt" onclick="saveEditedTheme()">' +
                                                '<span class="ti-plus pr-2"></span>' +
                                                'Guardar' +
                                            '</a>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>';

                        universalModal('Editar Tema', html);
                        $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
                        $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                        $('#subject').niceSelect(); $('#course').niceSelect(); $('#time').niceSelect();
                    }
                });
            }

            function saveEditedTheme() {
                let id = edId,
                    pass = true,
                    empty = false,
                    subject = $.trim($('#subject').val()),
                    course = $.trim($('#course').val()),
                    time =  $.trim($('#time').val()),
                    name = $.trim($('#name_edit_theme').val()),
                    description = $.trim($('#description_theme').val());

                empty = $('#subject').mValid({text: 'Asignatura no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#course').mValid({text: 'Curso no debe quedar vacío.'}); if(empty){ pass = false}
                empty = $('#time').mValid({text: 'Ciclo/Periodo no debe quedar vacío.'}); if(empty){ pass = false}
                empty = $('#name_edit_theme').mValid({text: 'Nombre no debe quedar vacío.'}); if(empty){ pass = false}
                empty = $('#description_theme').mValid({text: 'Descripción no debe quedar vacía.'}); if(empty){ pass = false}

                if(pass){
                    $.ajax({
                        type: 'PUT',
                        url: '/put-edit-theme',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id,
                            subject,
                            course,
                            time,
                            name,
                            description
                        },
                        success: (data) => {
                            if(data.theme){
                                filterThemes( $('search_theme').val(), $('subject_filter').val(), $('times_filter').val() );
                                $('.modal').modal('hide');
                                $("body").overhang({
                                    type: "success",
                                    message: "Exito! Se editó el Tema exitosamente!"
                                });
                            } else {
                                $("body").overhang({
                                    type: "error",
                                    message: "Oops! Se detectó un problema, intenta más tarde."
                                });
                            }
                        }
                    }).fail( function() {
                        $('.modal').modal('hide');
                        $("body").overhang({
                            type: "error",
                            message: "Oops! Se detectó un problema, intenta más tarde.",
                            closeConfirm: true
                        });
                    });
                }
            }

            subjectsFilter();
            timesFilter();
            filterThemes('', '', '');
        </script>
    </body>
</html>
