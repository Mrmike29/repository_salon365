'use strict';
let edId = 0;

/** Isset */
const isset = (v) => { return (typeof v != "undefined" && v != null); }
/** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
(function( $ ){
    $.fn.mValid = function(data) {
        data.text = $.trim($(this).val()) === ''? data.text : '';
        $(this).parents('div.input-effect').siblings('span').text(data.text);
        return ($.trim($(this).val()) === '');
    };
})( jQuery );

let page = 1,
    next = $('#next'),
    time = $('#times_filter'),
    previous = $('#previous'),
    search = $('#search_theme'),
    subject = $('#subject_filter');


const
    filterThemes = (search, subject, time, previous, next) => {

        if(previous.attr('data-id')*1 === 0){ previous.addClass('n-t-s'); }
        else { previous.removeClass('n-t-s'); }

        let nxt = next.attr('data-id'),
        prev = previous.attr('data-id');

        $.ajax({
            type: 'GET',
            url: '/get-themes-list',
            data: { search, subject, time, prev, nxt },
            success: (data) => {
                let html = '',
                    themes = data.themes,
                    themesC = data.counter,
                    contPags = 0,
                    contHelper = 0,
                    htmlPager = '';

                for (let i = 1; i <= themesC; i++) {
                    contHelper++;
                    if (contHelper === 20){ contPags++; contHelper = 0; }
                }

                if (contHelper > 0){ contPags++; }

                let id = page, until = page;

                if (id+9 >= contPags && contPags >= 10) { id = contPags-9; until = page+9 }
                else if(id <= 9) { id = 1; until = 10; }
                else { id = page-5; until = page+5; }

                if (contPags > 0){
                    for (let i = id; i <= until; i++){
                        if (i <= contPags){
                            htmlPager +=
                                '<a class="paginate_button m-page ' + ((i === page)? "current" : "") + '" data-id="pager_' + i + '" tabindex="0">' +
                                i +
                                '</a>';
                        }
                    }
                }

                $('#pagination_number').html(htmlPager);

                $('.m-page').click(function () {
                    paranoia($(this).data('id').split("_").pop()*1);
                });

                if(next.attr('data-id')*20 >= themesC){ next.addClass('n-t-s'); }
                else{ next.removeClass('n-t-s'); }

                $('#table_info').text(`Mostrando registros del ${ (themesC !== 0)? parseInt(previous.attr('data-id') ) + 1 : 0 } al ${ parseInt(previous.attr('data-id') ) + themes.length } de un total de ${ themesC } registros`)

                if(themesC !== 0) {
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
                } else {
                    html +=
                        '<tr class="odd">' +
                        '<td colspan="4" class="dataTables_empty" style="text-align: center">' +
                        'No se encontraron resultados' +
                        '</td>' +
                        '</tr>';
                }

                $('#tbody_themes').html(html);
                $('[data-toggle="tooltip"]').tooltip();
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
    },
    paranoia = (number) => {
        page = number;
        previous.attr('data-id', (page-1)*20);
        next.attr('data-id', page*20);
        filterThemes($.trim(search.val()), subject.val(), time.val(), previous, next);
    };

$(document).ready(function(){

    filterThemes($.trim(search.val()), '', '', previous, next);

    search.keyup(function(e) {
        if($(this).val().length > 0 && $(this).val().length < 4) return false;
        page = 1;
        next.attr('data-id', 20);
        previous.attr('data-id', 0);
        filterThemes($.trim(search.val()), subject.val(), time.val(), previous, next);
    });

    subject.change(() => {
        page = 1;
        next.attr('data-id', 20);
        previous.attr('data-id', 0);
        filterThemes($.trim(search.val()), subject.val(), time.val(), previous, next);
    })

    time.change(() => {
        page = 1;
        next.attr('data-id', 20);
        previous.attr('data-id', 0);
        filterThemes($.trim(search.val()), subject.val(), time.val(), previous, next);
    })

    previous.click(function(){
        page--;
        next.attr('data-id', previous.attr('data-id'));
        previous.attr('data-id', previous.attr('data-id') - 20);
        filterThemes($.trim(search.val()), subject.val(), time.val(), previous, next);
    });

    next.click(function(){
        page++;
        previous.attr('data-id', next.attr('data-id'));
        next.attr('data-id', parseInt(next.attr('data-id')) + 20);
        filterThemes($.trim(search.val()), subject.val(), time.val(), previous, next);
    });
});

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
                _token,
                subject,
                course,
                time,
                name,
                description
            },
            success: (data) => {
                filterThemes($.trim(search.val()), window.subject.value, window.time.value, previous, next);
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
    if (id === 0 || !(isset(id))) return false;

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
                _token,
                id,
                subject,
                course,
                time,
                name,
                description
            },
            success: (data) => {
                if(data.theme){
                    filterThemes($.trim(search.val()), window.subject.value, window.time.value, previous, next);
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
