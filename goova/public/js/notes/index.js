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

let nextN,
    searchN,
    teacher,
    subject,
    page = 1,
    pageN = 1,
    previousN,
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
            url: '/get-students-list',
            data: { search, course, prev, nxt },
            success: (data) => {
                let html = '',
                    notes = data.notes,
                    notesC = data.counter,
                    contPags = 0,
                    contHelper = 0,
                    htmlPager = '';

                for (let i = 1; i <= notesC; i++) {
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

                if(next.attr('data-id')*1 >= notesC){ next.addClass('n-t-s'); }
                else{ next.removeClass('n-t-s'); }

                $('#table_info').text(`Mostrando registros del ${ (notesC !== 0)? parseInt(previous.attr('data-id') ) + 1 : 0 } al ${ parseInt(previous.attr('data-id') ) + notes.length } de un total de ${ notesC } registros`)

                if(notesC !== 0) {
                    notes.forEach((item) => {
                        html +=
                            '<tr>' +
                            '<td>' +
                            item.course +
                            '</td>' +
                            '<td>' +
                            item.name + ' ' + item.last_name +
                            '</td>' +
                            '<td>' +
                            '<a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="openModalNotes(' + item.id + ')" title="Ver Notas">' +
                            '<span class="ti-eye"></span>' +
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
    teacherFilter = () => {
        $.ajax({
            type: 'GET',
            url: '/get-teacher-filter',
            success: (data) => {
                let html = '<option data-display="Todos Los Profesores" value=""></option>' +
                    '<option value="">Todos Los Profesores</option>',
                    teacher = data.teacher;

                teacher.forEach((item) => { html += '<option value="' + item.id + '">' + item.name + ' ' + item.last_name + '</option>' });

                $('#teacher_filter').html(html).niceSelect('destroy').niceSelect();
            }
        });
    },
    subjectsFilter = () =>  {
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
    openModalNotes = (id) => {
        if (id === 0 || !(isset(id))) return false;

        $.ajax({
            type: 'GET',
            url: '/get-student',
            data: { id }
        }).done((data) => {
            let html =
                `<div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box" id="container_filter" style="border-radius: 10px 10px 0 0;">
                                <div class="row mt-25">
                                    <div class="col-12">
                                        <div class="dataTables_wrapper no-footer" style="transform: translateY(20px);">
                                            <div class="dataTables_filter">
                                                <label class="" style="width: 100%">
                                                    <i class="ti-search"></i>
                                                    <input type="search" name="search_n" id="search_n" placeholder="Búsqueda rápida">
                                                </label>
                                            </div>
                                        </div>
                                        <span class="modal_input_validation red_alert"></span>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-6">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control" name="subject_filter" id="subject_filter">

                                            </select>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control" name="teacher_filter" id="teacher_filter">

                                            </select>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="white-box" id="container_notes" style="border-radius: 0">
                                <div class="dataTables_wrapper no-footer">
                                    <table id="table_notes" class="table school-table" style="border-radius: 10px; box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8);">
                                    <thead>
                                        <tr>
                                            <th>Asignatura</th>
                                            <th>Profesor</th>
                                            <th>Taller</th>
                                            <th>Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_notes">

                                    </tbody>
                                </table>
                                    <div class="dataTables_info" id="table_info_n" role="status" aria-live="polite">

                                    </div>
                                    <div class="dataTables_paginate paging_simple_numbers" id="table_notes_paginate">
                                        <a class="paginate_button previous n-t-s" data-id="0" tabindex="0" id="previous_n">
                                            <span class="ti-angle-left"></span>
                                        </a>
                                        <span id="pagination_number_notes">

                                        </span>
                                        <a class="paginate_button next n-t-s" data-id="20" tabindex="0" id="next_n">
                                            <span class="ti-angle-right"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="white-box" id="container_footer" style="border-radius: 0 0 10px 10px;">
                            </div>
                        </div>
                    </div>
                </div>`;

            universalModal('Notas de <strong>' + data.s.name + ' ' + data.s.last_name + '</strong>', html, '', 'modal-xlg');
            teacherFilter(); subjectsFilter();
            $('#search_n').on('focus', function () { $('.dataTables_filter > label').addClass('jquery-search-label'); }).on('blur', function () { $('.dataTables_filter > label').removeClass('jquery-search-label'); });

            pageN = 1; searchN = $('#search_n'); teacher = $('#teacher_filter'); subject = $('#subject_filter'); previousN = $('#previous_n'); nextN = $('#next_n');

            filterNotes(searchN.val(), teacher.val(), subject.val(), previousN, nextN, id)

            searchN.keyup(function(e) {
                pageN = 1;
                nextN.attr('data-id', 20);
                previousN.attr('data-id', 0);
                filterNotes($.trim(searchN.val()), teacher.val(), subject.val(), previousN, nextN, id);
            });

            teacher.change(() => {
                pageN = 1;
                nextN.attr('data-id', 20);
                previousN.attr('data-id', 0);
                filterNotes($.trim(searchN.val()), teacher.val(), subject.val(), previousN, nextN, id);
            })

            subject.change(() => {
                pageN = 1;
                nextN.attr('data-id', 20);
                previousN.attr('data-id', 0);
                filterNotes($.trim(searchN.val()), teacher.val(), subject.val(), previousN, nextN, id);
            })

            previousN.click(function(){
                pageN--;
                nextN.attr('data-id', previousN.attr('data-id'));
                previousN.attr('data-id', previousN.attr('data-id') - 20);
                filterNotes($.trim(searchN.val()), teacher.val(), subject.val(), previousN, nextN, id);
            });

            nextN.click(function(){
                pageN++;
                previousN.attr('data-id', nextN.attr('data-id'));
                nextN.attr('data-id', parseInt(nextN.attr('data-id')) + 20);
                filterNotes($.trim(searchN.val()), teacher.val(), subject.val(), previousN, nextN, id);
            });
        }).fail(() => {
            $("body").overhang({
                type: "error",
                message: "Oops! Se detectó un problema, intenta más tarde.",
                closeConfirm: true
            });
        })
    },
    filterNotes = (search, teacher, subject, previous, next,id_student) => {

        if(previous.attr('data-id')*1 === 0){ previous.addClass('n-t-s'); }
        else { previous.removeClass('n-t-s'); }

        let nxt = next.attr('data-id'),
            prev = previous.attr('data-id');

        $.ajax({
            type: 'GET',
            url: '/get-notes-list',
            data: { search, teacher, subject, prev, nxt , id_student},
            success: (data) => {
                let html = '',
                    notes = data.homework,
                    notesC = data.homeworkCounter,
                    contPags = 0,
                    contHelper = 0,
                    htmlPager = '';
                for (let i = 1; i <= notesC; i++) {
                    contHelper++;
                    if (contHelper === 20){ contPags++; contHelper = 0; }
                }

                if (contHelper > 0){ contPags++; }

                let id = pageN, until = pageN;

                if (id+9 >= contPags && contPags >= 10) { id = contPags-9; until = pageN+9 }
                else if(id <= 9) { id = 1; until = 10; }
                else { id = pageN-5; until = pageN+5; }

                if (contPags > 0){
                    for (let i = id; i <= until; i++){
                        if (i <= contPags){
                            htmlPager +=
                                '<a class="paginate_button m-page-notes ' + ((i === pageN)? "current" : "") + '" data-id="pager_notes_' + i + '" tabindex="0">' +
                                i +
                                '</a>';
                        }
                    }
                }

                $('#pagination_number_notes').html(htmlPager);

                $('.m-page-notes').click(function () {
                    paranoia($(this).data('id').split("_").pop()*1);
                });

                if(next.attr('data-id')*1 >= notesC){ next.addClass('n-t-s'); }
                else{ next.removeClass('n-t-s'); }

                $('#table_info_n').text(`Mostrando registros del ${ (notesC !== 0)? parseInt(previous.attr('data-id') ) + 1 : 0 } al ${ parseInt(previous.attr('data-id') ) + notes.length } de un total de ${ notesC } registros`)

                if(notesC !== 0) {
                    notes.forEach((item) => {
                        html +=
                            '<tr>' +
                            '<td>' +
                            item.subject_name +
                            '</td>' +
                            '<td>' +
                            item.teacher_name + ' ' + item.teacher_lastname +
                            '</td>' +
                            '<td>' +
                            item.work+
                            '</td>' +
                            '<td>' +
                            item.value+
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

                $('#tbody_notes').html(html);
                $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
            }
        });
    },
    paranoia = (number) => {
        page = number;
        previous.attr('data-id', (page-1)*20);
        next.attr('data-id', page*20);
        filterStudents($.trim(search.val()), course.val(), previous, next);
    },
    paranoiaN = (number) => {
        pageN = number;
        previousN.attr('data-id', (pageN-1)*20);
        nextN.attr('data-id', pageN*20);
        filterNotes($.trim(searchN.val()), teacher.val(), subject.val(), previous, next);
    };

$(document).ready(function(){

    filterStudents($.trim(search.val()), course.val(), previous, next)

    search.keyup(function(e) {
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
