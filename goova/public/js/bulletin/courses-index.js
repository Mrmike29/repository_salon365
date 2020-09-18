'use strict';
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

let period,
    subject,
    page = 1,
    next = $('#next'),
    search = $('#search_s'),
    previous = $('#previous'),
    course = $('#course_filter');


const
    filterStudents = (search, course, previous, next) => {

        if(previous.attr('data-id')*1 === 0){ previous.addClass('n-t-s'); }
        else { previous.removeClass('n-t-s'); }

        let nxt = next.attr('data-id'),
            prev = previous.attr('data-id');

        $.ajax({
            type: 'GET',
            url: '/get-students-bulletin',
            data: { search, course, prev, nxt },
            success: (data) => {
                let html = '',
                    students = data.students,
                    studentsC = data.counter,
                    contPags = 0,
                    contHelper = 0,
                    htmlPager = '';

                for (let i = 1; i <= studentsC; i++) {
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

                if(next.attr('data-id')*1 >= studentsC){ next.addClass('n-t-s'); }
                else{ next.removeClass('n-t-s'); }

                $('#table_info').text(`Mostrando registros del ${ (studentsC !== 0)? parseInt(previous.attr('data-id') ) + 1 : 0 } al ${ parseInt(previous.attr('data-id') ) + students.length } de un total de ${ studentsC } registros`)

                if(studentsC !== 0) {
                    students.forEach((item) => {
                        html +=
                            '<tr>' +
                            '<td class="left-aligned">' +
                            item.course +
                            '</td>' +
                            '<td class="center-aligned">' +
                            item.name + ' ' + item.last_name +
                            '</td>' +
                            '<td class="right-aligned">' +
                            '<a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="openModalObservations(' + item.id + ')" title="Generar Reporte">' +
                            '<span class="ti-receipt"></span>' +
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

                $('#tbody_students').html(html);
                $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });

            }
        });
    },
    courseFilter = () => {
        $.ajax({
            type: 'GET',
            url: '/get-course-filter',
            success: (data) => {
                let html = '<option data-display="Todos Los Cursos" value=""></option>' +
                    '<option value="">Todos Los Cursos</option>',
                    course = data.course;

                course.forEach((item) => { html += '<option value="' + item.id + '">' + item.name + '</option>' });

                $('#course_filter').html(html).niceSelect('destroy').niceSelect();
            }
        });
    },
    openModalObservations = (id) => {
        if (id === 0 || !(isset(id))) return false;

        $.ajax({
            type: 'GET',
            url: '/get-student-to-report',
            data: { id }
        }).done((data) => {
            let student = data.student,
                periods = data.periods,
                html = `
                    <section class="sms-breadcrumb mb-40 white-box">
                        <div class="container-fluid">
                            <div class="col-lg-12" style="box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8); border-radius: 5px; padding: 15px; ">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control" name="period_filter" id="period_filter">`;
            periods.forEach((item, key) => {
                html +=                         `
                                                ${(key === 0)? `<option value="${item.id}">${item.name}</option>` : ``}
                                                <option value="${item.id}">${item.name}</option>
                                                `
            })
                html +=                      `</select>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="sms-breadcrumb mb-40 white-box">
                        <div class="container-fluid">
                            <div class="col-lg-12" id="container_reports" style="box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8); border-radius: 5px; padding: 15px; ">

                            </div>
                        </div>
                    </section>`;

            universalModal('Generar Reporte a <strong>' + student.name + ' ' + student.last_name + '</strong>', html, '', 'modal-xlg');
            $('#period_filter').niceSelect('destroy').niceSelect();

            period = $('#period_filter');

            filterReports(id, period.val());

            period.change(() => {
                filterReports(id, period.val());
            })
        }).fail(() => {
            $("body").overhang({
                type: "error",
                message: "Oops! Se detectó un problema, intenta más tarde.",
                closeConfirm: true
            });
        })
    },
    filterReports = (id, period) => {
        $.ajax({
            type: 'GET',
            url: '/get-reports-student',
            data: { id, period }
        }).done((data) => {
            let html = ``,
                theresSomething = false,
                subjects = data.subjects,
                reports = data.reports;

            subjects.forEach((item, key) => {
                theresSomething = (isset(reports[item.id]));
            html += `
                    ${(key !== 0)? `<div style="width: 100%; background: rgba(150, 150, 150, 0.3); height: 1px;"></div>` : `` }
                    <div class="row">
                        <div class="col-11">
                            <div class="main-title">
                                <h1>${item.subject}</h1>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="button" class="primary-btn small icon-only" id="subject_o_${item.id}" data-mp="${item.id}">
                                <span class="m-subject-o"></span>
                            </button>
                        </div>
                        <div class="white-box" id="subject_d_${item.id}" style="display: none;">
                            <div class="row">
                                <div class="col-4">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control ${(theresSomething)? `has-content` : `` }" name="cognitive_performance_${item.id}" id="cognitive_performance_${item.id}" cols="30" rows="10">${(theresSomething)? reports[item.id].cognitive_observation : `` }</textarea>
                                        <label>
                                            Desempeño Cognitivo
                                        </label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control ${(theresSomething)? `has-content` : `` }" name="personal_performance_${item.id}" id="personal_performance_${item.id}" cols="30" rows="10">${(theresSomething)? reports[item.id].personal_observation : `` }</textarea>
                                        <label>
                                            Desempeño Personal
                                        </label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control ${(theresSomething)? `has-content` : `` }" name="social_performance_${item.id}" id="social_performance_${item.id}" cols="30" rows="10">${(theresSomething)? reports[item.id].social_observation : `` }</textarea>
                                        <label>
                                            Desempeño Social
                                        </label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 right-aligned">
                                    <button type="button" class="primary-btn small icon-only" id="save_b_${item.id}" onclick="${(theresSomething)? `editReport(`+ reports[item.id].id + ',' + item.id + `)` : `saveReport(`+ id + ',' + item.id + ',' + period + `)`}">
                                        <span class="ti-save"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`
            })

            $('#container_reports').html(html);
            $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
            slideToggle('subject_o_', 'subject_d_');
        }).fail(() => {
            $("body").overhang({
                type: "error",
                message: "Oops! Se detectó un problema, intenta más tarde.",
                closeConfirm: true
            });
        })
    },
    paranoia = (number) => {
        page = number;
        previous.attr('data-id', (page-1)*20);
        next.attr('data-id', page*20);
        filterStudents($.trim(search.val()), course.val(), previous, next);
    },
    slideToggle = (clickBtn, toggleDiv) => {
        $(`[id^="${clickBtn}"]`).click(function () {
            let id = $(this).attr('data-mp');
            $(this).children('span.m-subject-o').toggleClass('active');
            $(`#${toggleDiv + id}`).stop().slideToggle('slow');
        });
    },
    saveReport = (student, subject, time) => {
        let cognitivePerformance = $(`#cognitive_performance_${subject}`).val(),
            personalPerformance = $(`#personal_performance_${subject}`).val(),
            socialPerformance = $(`#social_performance_${subject}`).val();

        $.ajax({
            type: 'POST',
            url: '/post-save-report',
            data: {
                _token,
                student,
                subject,
                time,
                cognitivePerformance,
                personalPerformance,
                socialPerformance
            }
        }).done((data) => {
            $(`#subject_d_${subject}`).append('<div class="success-ajax"><span class="ti-check"></span></div>');
            setTimeout(() => { $('.success-ajax').remove(); }, 3000)
            $(`#save_b_${subject}`).attr(`onclick`, `editReport(${data.data + ',' + subject})`);
        }).fail(() => {
            $("body").overhang({
                type: "error",
                message: "Oops! Se detectó un problema, intenta más tarde.",
                closeConfirm: true
            });
        })
    },
    editReport = (id, subject) => {
        let cognitivePerformance = $(`#cognitive_performance_${subject}`).val(),
            personalPerformance = $(`#personal_performance_${subject}`).val(),
            socialPerformance = $(`#social_performance_${subject}`).val();

        $.ajax({
            type: 'PUT',
            url: '/put-save-report',
            data: {
                _token,
                id,
                subject,
                cognitivePerformance,
                personalPerformance,
                socialPerformance
            }
        }).done((data) => {
            $(`#subject_d_${subject}`).append('<div class="success-ajax"><span class="ti-check"></span></div>');
            setTimeout(() => { $('.success-ajax').remove(); }, 3000)
        }).fail(() => {
            $("body").overhang({
                type: "error",
                message: "Oops! Se detectó un problema, intenta más tarde.",
                closeConfirm: true
            });
        })
    };

$(document).ready(function(){

    filterStudents($.trim(search.val()), course.val(), previous, next)

    search.keyup(function(e) {
        if($(this).val().length > 0 && $(this).val().length < 4) return false;
        page = 1;
        next.attr('data-id', 20);
        previous.attr('data-id', 0);
        filterStudents($.trim(search.val()), course.val(), previous, next);
    });

    course.change(() => {
        page = 1;
        next.attr('data-id', 20);
        previous.attr('data-id', 0);
        filterStudents($.trim(search.val()), course.val(), previous, next);
    })

    previous.click(function(){
        page--;
        next.attr('data-id', previous.attr('data-id'));
        previous.attr('data-id', previous.attr('data-id') - 20);
        filterStudents($.trim(search.val()), course.val(), previous, next);
    });

    next.click(function(){
        page++;
        previous.attr('data-id', next.attr('data-id'));
        next.attr('data-id', parseInt(next.attr('data-id')) + 20);
        filterStudents($.trim(search.val()), course.val(), previous, next);
    });
});

courseFilter();
