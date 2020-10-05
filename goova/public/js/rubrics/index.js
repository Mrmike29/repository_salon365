'use strict';

/** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
(function( $ ){ $.fn.mValid = function(data) { data.text = $.trim($(this).val()) === ''? data.text : ''; $(this).parents('div.input-effect').siblings('span').text(data.text); return ($.trim($(this).val()) === ''); }; })( jQuery );
/** Mi función, la utilizo para hacer mis inputs de tipo number */
(function( $ ){ $.fn.mNumber = function() { $(this).bind('paste input',function(){ $(this).val ( $(this).val().replace (/[A-Za-zàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝäëïöüÿÄËÏÖÜŸ !@%&`":´¨<>ºªñÑçÇ;·~€¬/='¿¡[\]{}()*+?,\\^$|#\s-]/g ,"")) }); }; })( jQuery );

let del = [],
    page = 1,
    next = $('#next'),
    previous = $('#previous'),
    search = $('#search_rubric');

const
    filterRubrics = (search, previous, next) => {

        if(previous.attr('data-id')*1 === 0){ previous.addClass('n-t-s'); }
        else { previous.removeClass('n-t-s'); }

        let nxt = next.attr('data-id'),
            prev = previous.attr('data-id');

        $.ajax({
            type: 'GET',
            url: '/get-rubrics-list',
            data: { search, prev, nxt },
            success: (data) => {
                let html = '',
                    rubrics = data.rubrics,
                    rubricsC = data.counter,
                    contPags = 0,
                    contHelper = 0,
                    htmlPager = '';

                for (let i = 1; i <= rubricsC; i++) {
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

                if(next.attr('data-id')*1 >= rubricsC){ next.addClass('n-t-s'); }
                else{ next.removeClass('n-t-s'); }

                $('#table_info').text(`Mostrando registros del ${ (rubricsC !== 0)? parseInt(previous.attr('data-id') ) + 1 : 0 } al ${ parseInt(previous.attr('data-id') ) + rubrics.length } de un total de ${ rubricsC } registros`)

                if(rubricsC !== 0) {
                    rubrics.forEach((item) => {
                        html +=
                            '<tr>' +
                            '<td>' +
                            item.name +
                            '</td>' +
                            '<td>' +
                            '<a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="openModalEditRubric(' + item.id + ')" title="Editar Rúbrica">' +
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

                $('#tbody_rubrics').html(html);
                $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
            }
        })
    },
    paranoia = (number) => {
        page = number;
        previous.attr('data-id', (page-1)*20);
        next.attr('data-id', page*20);
        filterRubrics($.trim(search.val()), previous, next);
    };

$(document).ready(function(){

    filterRubrics($.trim(search.val()), previous, next);

    search.keyup(function(e) {
        if($(this).val().length > 0 && $(this).val().length < 4) return false;
        page = 1;
        next.attr('data-id', 20);
        previous.attr('data-id', 0);
        filterRubrics($.trim(search.val()), previous, next);

    });

    previous.click(function(){
        page--;
        next.attr('data-id', previous.attr('data-id'));
        previous.attr('data-id', previous.attr('data-id') - 20);
        filterRubrics($.trim(search.val()), previous, next);
    });

    next.click(function(){
        page++;
        previous.attr('data-id', next.attr('data-id'));
        next.attr('data-id', parseInt(next.attr('data-id')) + 20);
        filterRubrics($.trim(search.val()), previous, next);
    });
});

let act = 0,
    momtE = 0;

function openModalCreateRubric() {
    act = 0; momtE = 0;

    let html =
        '<div class="container-fluid">' +
            '<div class="row">' +
                '<div class="col-lg-12">' +
                    '<table style="width: 100%" class="the-border text-center">' +
                        '<tr>' +
                            '<td colspan="1" class="the-border">' +
                                'Nombre &nbsp;' +
                            '</td>' +
                            '<td colspan="4">' +
                                '<input style="width: 100%; border: none;" type="text" name="name_create_rubric" id="name_create_rubric">' +
                            '</td>' +
                        '</tr>' +
                        '<tr class="the-border">' +
                            '<td class="the-border">Tipo de Actividad</td>' +
                            '<td>' +
                                'Actividad Individual &nbsp;' +
                                '<input type="checkbox" name="activity" id="activity1" value="1">' +
                            '</td>' +
                            '<td colspan="3" class="text-center">' +
                                'Actividad Colaborativa &nbsp;' +
                                '<input type="checkbox" name="activity" id="activity2" value="2">' +
                            '</td>' +
                        '</tr>' +
                        '<tr class="the-border">' +
                            '<td class="the-border">Momento de la Evaluación</td>' +
                            '<td>' +
                                'Inicial &nbsp;' +
                                '<input type="checkbox" name="moment_evaluation" id="moment_evaluation1" value="1">' +
                            '</td>' +
                            '<td>' +
                                'Intermedia, Unidad &nbsp;' +
                                '<input type="checkbox" name="moment_evaluation" id="moment_evaluation2" value="2">' +
                            '</td>' +
                            '<td colspan="3" class="text-center">' +
                                'Final &nbsp;' +
                                '<input type="checkbox" name="moment_evaluation" id="moment_evaluation3" value="3">' +
                            '</td>' +
                        '</tr>' +
                        '<tr class="the-border">' +
                            '<td rowspan="2" class="the-border">Aspectos Evaluados</td>' +
                            '<td colspan="3" class="text-center">Niveles de desempeño de la actividad individual</td>' +
                            '<td rowspan="2" colspan="2" class="the-border">Puntaje</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td>Valoración Alta</td>' +
                            '<td>Valoración Media</td>' +
                            '<td>Valoración Baja</td>' +
                        '</tr>' +
                        '<tr id="tr_desc_1">' +
                            '<td rowspan="2" class="the-border">' +
                                '<textarea class="textarea-m" name="to_value_create_1" id="to_value_create_1" cols="10" rows="5"></textarea>' +
                            '</td>' +
                            '<td class="the-border">' +
                                '<textarea class="textarea-m" name="high_valoration_create_1" id="high_valoration_create_1" cols="10" rows="5"></textarea>' +
                            '</td>' +
                            '<td class="the-border">' +
                                '<textarea class="textarea-m" name="medium_valoration_create_1" id="medium_valoration_create_1" cols="10" rows="5"></textarea>' +
                            '</td>' +
                            '<td class="the-border">' +
                                '<textarea class="textarea-m" name="low_valoration_create_1" id="low_valoration_create_1" cols="10" rows="5"></textarea>' +
                            '</td>' +
                            '<td rowspan="2" id="total_create_1" class="the-border text-center">0</td>' +
                            '<td rowspan="2" class="the-border text-center"></td>' +
                        '</tr>' +
                        '<tr id="tr_values_1">' +
                            '<td class="the-border">(Hasta <input type="text" class="m-number" name="high_points_create_1" id="high_points_create_1" style="width: 20%;"> Puntos)</td>' +
                            '<td class="the-border">(Hasta <input type="text" class="m-number" name="medium_points_create_1" id="medium_points_create_1" style="width: 20%;"> Puntos)</td>' +
                            '<td class="the-border">(Hasta <input type="text" class="m-number" name="low_points_create_1" id="low_points_create_1" style="width: 20%;"> Puntos)</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td class="the-border" colspan="4">Calificación Final</td>' +
                            '<td class="the-border" id="total_create_rubric" colspan="1"></td>' +
                            '<td class="the-border" colspan="1">' +
                                '<a href="#" class="primary-btn small goova-bt" style="padding: 0 10px" data-toggle="tooltip" onclick="addOptionRubric(`create`)" title="" data-original-title="Nuevo Registro">' +
                                    '<span class="ti-plus"></span>' +
                                '</a>' +
                            '</td>' +
                        '</tr>' +
                    '</table>' +
                '</div>' +
            '</div>' +
        '</div>',
        footer =
            '<div class="col-lg-12 text-center">' +
                '<div class="mt-40 d-flex justify-content-between">' +
                    '<button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>' +
                    '<a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="saveRubric()" title="Guardar">' +
                        '<span class="ti-save"></span>' +
                    '</a>' +
                '</div>' +
            '</div>';

    universalModal('Crear Rúbrica', html, footer, 'modal-lg');
    $('.m-number').mNumber();
    $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
    $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
    $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });

    $("input:checkbox").on('click', function() {
        let $box = $(this);

        if ($box.is(":checked")) {
            let group = "input:checkbox[name='" + $box.attr("name") + "']";

            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    $('input[name="activity"]').click(function(){ act = ($(this).prop("checked"))? $(this).val()*1 : 0; });
    $('input[name="moment_evaluation"]').click(function(){ momtE = ($(this).prop("checked"))? $(this).val()*1 : 0; });

    $('#high_points_create_1').change(function () { $(`#total_create_1`).text($(this).val()); doCalculate('create'); })
}

function addOptionRubric(type){
    let c, html = '', q = $('[id^="tr_desc_"]');
    c = (q.length + 1);

    html =
        `<tr id="tr_desc_${c}">` +
            `<td rowspan="2" class="the-border">` +
                ((type === 'edit')? `<input type="hidden" id="id_${type}_rubric_${c}" value="0">` : ``) +
                `<textarea class="textarea-m" name="to_value_${type}_${c}" id="to_value_${type}_${c}" cols="10" rows="5"></textarea>` +
            `</td>` +
            `<td class="the-border">` +
                `<textarea class="textarea-m" name="high_valoration_${type}_${c}" id="high_valoration_${type}_${c}" cols="10" rows="5"></textarea>` +
            `</td>` +
            `<td class="the-border">` +
                `<textarea class="textarea-m" name="medium_valoration_${type}_${c}" id="medium_valoration_${type}_${c}" cols="10" rows="5"></textarea>` +
            `</td>` +
            `<td class="the-border">` +
                `<textarea class="textarea-m" name="low_valoration_${type}_${c}" id="low_valoration_${type}_${c}" cols="10" rows="5"></textarea>` +
            `</td>` +
            `<td rowspan="2" id="total_${type}_${c}" class="the-border text-center">0</td>` +
            `<td rowspan="2" class="the-border text-center">` +
                `<a href="#" class="primary-btn small goova-bt" style="padding: 0 10px" data-toggle="tooltip" onclick="removeOptionRubric(${c}, '${type}')" title="" data-original-title="Eliminar Registro">` +
                    `<span class="ti-minus"></span>` +
                `</a>` +
            `</td>` +
        `</tr>` +
        `<tr id="tr_values_${c}">` +
            `<td class="the-border">(Hasta <input type="text" class="m-number" name="high_points_${type}_${c}" id="high_points_${type}_${c}" style="width: 20%;"> Puntos)</td>` +
            `<td class="the-border">(Hasta <input type="text" class="m-number" name="medium_points_${type}_${c}" id="medium_points_${type}_${c}" style="width: 20%;"> Puntos)</td>` +
            `<td class="the-border">(Hasta <input type="text" class="m-number" name="low_points_${type}_${c}" id="low_points_${type}_${c}" style="width: 20%;"> Puntos)</td>` +
        `</tr>`;

    $(html).insertAfter(`#tr_values_${q.length}`);
    $('.m-number').mNumber();
    $(`[name^="option_${type}_rubric"]`).change(function () { doCalculate(type) });
    $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
    $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
    $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
    $('[id^="high_points_"]').change(function () { $(`#total_${type}_${c}`).text($(this).val()); doCalculate(type); })
}

function removeOptionRubric(id, type, idE = 0, exists = false) {
    if(id*1 === 0) return false;

    if(exists) {
        if (idE === 0) return false;

        let html =
            '<tr class="the-border text-center" id="restore_' + idE + '">' +
                '<td colspan="5">' +
                    '<a class="restore" onclick="restoreRule(' + id + ', ' + idE + ')">' +
                        'Restablecer' +
                    '</a>' +
                '</td>' +
            '</tr>';

        del.push({idE});
        $(html).insertAfter(`#tr_values_${id}`);
        $(`#tr_desc_${id}`).remove();
        $(`#tr_values_${id}`).remove();
    } else {
        let q = $('[id^="tr_desc_"]');
        for (let i = id; i <= q.length; i++){
            if($('#tr_desc_' + (i+1)).length){
                $(`#to_value_${type}_${i}`).val($(`#to_value_${type}_` + (i+1)).val())
                $(`#high_valoration_${type}_${i}`).val($(`#high_valoration_${type}_` + (i+1)).val())
                $(`#medium_valoration_${type}_${i}`).val($(`#medium_valoration_${type}_` + (i+1)).val())
                $(`#low_valoration_${type}_${i}`).val($(`#low_valoration_${type}_` + (i+1)).val())
                $(`#high_points_${type}_${i}`).val($(`#high_points_${type}_` + (i+1)).val())
                $(`#medium_points_${type}_${i}`).val($(`#medium_points_${type}_` + (i+1)).val())
                $(`#low_points_${type}_${i}`).val($(`#low_points_${type}_` + (i+1)).val())
            }
        }
        $(`#tr_desc_${q.length}`).remove();
        $(`#tr_values_${q.length}`).remove();
        setTimeout(function(){ $('.tooltip.fade.show.bs-tooltip-bottom').remove(); }, 50);
    }

    doCalculate(type);
}

function restoreRule(id, idE) {
    if(id*1 === 0 || idE*1 === 0) return false;

    $.ajax({
        type: 'GET',
        url: '/get-rule-rubric',
        data: { idE }
    }).done(function(data) {
        let html = '',
            rule = data.rule,
            index = del.findIndex((dl) => dl.idE === idE);

        if(index !== -1){
            del.splice(index, 1)[0];
            html +=
                '<tr id="tr_desc_' + id + '">' +
                    '<td rowspan="2" class="the-border">' +
                        '<input type="hidden" id="id_edit_rubric_' + id + '" value="' + idE + '">' +
                        '<textarea class="textarea-m" name="to_value_edit_' + id + '" id="to_value_edit_' + id + '" cols="10" rows="5">' + rule.to_value + '</textarea>' +
                    '</td>' +
                    '<td class="the-border">' +
                        '<textarea class="textarea-m" name="high_valoration_edit_' + id + '" id="high_valoration_edit_' + id + '" cols="10" rows="5">' + rule.high_text + '</textarea>' +
                    '</td>' +
                    '<td class="the-border">' +
                        '<textarea class="textarea-m" name="medium_valoration_edit_' + id + '" id="medium_valoration_edit_' + id + '" cols="10" rows="5">' + rule.medium_text + '</textarea>' +
                    '</td>' +
                    '<td class="the-border">' +
                        '<textarea class="textarea-m" name="low_valoration_edit_' + id + '" id="low_valoration_edit_' + id + '" cols="10" rows="5">' + rule.low_text + '</textarea>' +
                    '</td>' +
                    '<td rowspan="2" id="total_edit_' + id + '" class="the-border text-center">' + rule.high_points + '</td>' +
                    '<td rowspan="2" class="the-border text-center">' +
                        '<a href="#" class="primary-btn small goova-bt" style="padding: 0 10px" data-toggle="tooltip" onclick="removeOptionRubric(' + id + ', `edit`, ' + idE + ', true)" title="" data-original-title="Eliminar Registro">' +
                            '<span class="ti-minus"></span>' +
                        '</a>' +
                    '</td>' +
                '</tr>' +
                '<tr id="tr_values_' + id + '">' +
                    '<td class="the-border">(Hasta <input type="text" class="m-number" name="high_points_edit_' + id + '" id="high_points_edit_' + id + '" style="width: 20%;" value="' + rule.high_points + '"> Puntos)</td>' +
                    '<td class="the-border">(Hasta <input type="text" class="m-number" name="medium_points_edit_' + id + '" id="medium_points_edit_' + id + '" style="width: 20%;" value="' + rule.medium_points + '"> Puntos)</td>' +
                    '<td class="the-border">(Hasta <input type="text" class="m-number" name="low_points_edit_' + id + '" id="low_points_edit_' + id + '" style="width: 20%;" value="' + rule.low_points + '"> Puntos)</td>' +
                '</tr>';

            $(html).insertAfter(`#restore_${idE}`);
            $(`#restore_${idE}`).remove();
            doCalculate('edit');
        }
    }).fail( function(data) {
        $("body").overhang({
            type: "error",
            message: data.responseJSON.error,
            closeConfirm: true
        });
    });
}

function doCalculate(type) {
    let nV = 0, q = $('[id^="tr_desc_"]');
    for (let i = 1; i <= q.length; i++){
        if($(`#total_${type}_${i}`).text()*1 !== 0 && !Number.isNaN($(`#total_${type}_${i}`).text()*1)){
            nV += $(`#total_${type}_${i}`).text()*1;
        }
    }
    $(`#total_${type}_rubric`).text(nV);
}

function distributeValue(type) {
    let q, iV = $(`#total_${type}_rubric`).val();
    if(iV*1 === 0) return false;
    q = $(`[name^="option_${type}_rubric"]`).length; iV = iV/q;
    for (let i = 1; i <= $('[class^="row mt-25 t-d-"]').length; i++){
        if(!Number.isNaN($(`#option_${type}_rubric_${i}`).val()*1)){
            $(`#option_${type}_rubric_${i}`).val(iV).addClass('has-content');
        }
    }
}

function saveRubric() {
    let obj = {},
        pass = true,
        empty = false,
        name = $.trim($('#name_create_rubric').val()),
        options = $('[name^="to_value_create_"]');

    empty = $('#name_create_rubric').mValid({text: 'Nombre no debe quedar vacío.'}); if(empty){ pass = false}

    for (let i = 0; i < options.length; i++){
        obj[i] = {
            to_value: $.trim($('#to_value_create_' + (i + 1)).val()),
            high_text: $.trim($('#high_valoration_create_' + (i + 1)).val()),
            med_text: $.trim($('#medium_valoration_create_' + (i + 1)).val()),
            low_text: $.trim($('#low_valoration_create_' + (i + 1)).val()),
            high_points: $.trim($('#high_points_create_' + (i + 1)).val()),
            med_points: $.trim($('#medium_points_create_' + (i + 1)).val()),
            low_points: $.trim($('#low_points_create_' + (i + 1)).val())
        }
        empty = $('#to_value_create_' + (i + 1)).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
        empty = $('#high_valoration_create_' + (i + 1)).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
        empty = $('#medium_valoration_create_' + (i + 1)).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
        empty = $('#low_valoration_create_' + (i + 1)).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
        empty = $('#high_points_create_' + (i + 1)).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
        empty = $('#medium_points_create_' + (i + 1)).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
        empty = $('#low_points_create_' + (i + 1)).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
    }

    empty = (act !== 1 && act !== 2); if(empty){ pass = false }
    empty = (momtE !== 1 && momtE !== 2 && momtE !== 3); if(empty){ pass = false }

    if (pass){
        $.ajax({
            type: 'POST',
            url: '/post-save-rubric',
            data: { _token, name, act, momtE, obj }
        }).done(function(data) {
            filterRubrics( $.trim($('search_rubric').val()), $('#previous'), $('#next') );
            $("body").overhang({
                type: "success",
                message: data.message
            });
        }).fail( function(data) {
            $("body").overhang({
                type: "error",
                message: data.responseJSON.error,
                closeConfirm: true
            });
        }).always(function() {
            $('.modal').modal('hide');
        });
    } else {
        $("body").overhang({
            type: "error",
            message: 'Todos los campos deben estar llenos.',
            closeConfirm: true
        });
    }
}

function openModalEditRubric(id){
    if(id*1 === 0) return false;

    act = 0; momtE = 0; del = [];

    $.ajax({
        type: 'GET',
        url: '/get-data-edit-rubric',
        data: { id }
    }).done(function(data) {

        let rules = '',
            totalValue = 0,
            rubric = data.rubric,
            rubricRules = data.rubricRules;

        act = rubric.activity; momtE = rubric.moment;

        rubricRules.forEach((item, key) => {
            key++;
            totalValue += parseInt(item.high_points);

            rules +=
                '<tr id="tr_desc_' + key + '">' +
                    '<td rowspan="2" class="the-border">' +
                        '<input type="hidden" id="id_edit_rubric_' + key + '" value="' + item.id + '">' +
                        '<textarea class="textarea-m" name="to_value_edit_' + key + '" id="to_value_edit_' + key + '" cols="10" rows="5">' + item.to_value + '</textarea>' +
                    '</td>' +
                    '<td class="the-border">' +
                        '<textarea class="textarea-m" name="high_valoration_edit_' + key + '" id="high_valoration_edit_' + key + '" cols="10" rows="5">' + item.high_text + '</textarea>' +
                    '</td>' +
                    '<td class="the-border">' +
                        '<textarea class="textarea-m" name="medium_valoration_edit_' + key + '" id="medium_valoration_edit_' + key + '" cols="10" rows="5">' + item.medium_text + '</textarea>' +
                    '</td>' +
                    '<td class="the-border">' +
                        '<textarea class="textarea-m" name="low_valoration_edit_' + key + '" id="low_valoration_edit_' + key + '" cols="10" rows="5">' + item.low_text + '</textarea>' +
                    '</td>' +
                    '<td rowspan="2" id="total_edit_' + key + '" class="the-border text-center">' + item.high_points + '</td>' +
                    ((key === 1)?
                        '<td rowspan="2" class="the-border text-center"></td>' :
                        '<td rowspan="2" class="the-border text-center">' +
                            '<a href="#" class="primary-btn small goova-bt" style="padding: 0 10px" data-toggle="tooltip" onclick="removeOptionRubric(' + key + ', `edit`, ' + item.id + ', true)" title="" data-original-title="Eliminar Registro">' +
                                '<span class="ti-minus"></span>' +
                            '</a>' +
                        '</td>'
                    ) +
                '</tr>' +
                '<tr id="tr_values_' + key + '">' +
                    '<td class="the-border">(Hasta <input type="text" class="m-number" name="high_points_edit_' + key + '" id="high_points_edit_' + key + '" style="width: 20%;" value="' + item.high_points + '"> Puntos)</td>' +
                    '<td class="the-border">(Hasta <input type="text" class="m-number" name="medium_points_edit_' + key + '" id="medium_points_edit_' + key + '" style="width: 20%;" value="' + item.medium_points + '"> Puntos)</td>' +
                    '<td class="the-border">(Hasta <input type="text" class="m-number" name="low_points_edit_' + key + '" id="low_points_edit_' + key + '" style="width: 20%;" value="' + item.low_points + '"> Puntos)</td>' +
                '</tr>'
        })

        let html =
            '<div class="container-fluid">' +
                '<div class="row">' +
                    '<div class="col-lg-12">' +
                        '<table style="width: 100%" class="the-border text-center">' +
                            '<tr>' +
                                '<td colspan="1" class="the-border">' +
                                    'Nombre &nbsp;' +
                                '</td>' +
                                '<td colspan="4">' +
                                    '<input style="width: 100%; border: none;" type="text" name="name_edit_rubric" id="name_edit_rubric" value="' + rubric.name + '">' +
                                '</td>' +
                            '</tr>' +
                            '<tr class="the-border">' +
                                '<td class="the-border">Tipo de Actividad</td>' +
                                '<td>' +
                                    'Actividad Individual &nbsp;' +
                                    '<input type="checkbox" ' + ((rubric.activity === 1)? 'checked' : '') + ' name="activity" id="activity1" value="1">' +
                                '</td>' +
                                '<td colspan="3" class="text-center">' +
                                    'Actividad Colaborativa &nbsp;' +
                                    '<input type="checkbox" ' + ((rubric.activity === 2)? 'checked' : '') + ' name="activity" id="activity2" value="2">' +
                                '</td>' +
                            '</tr>' +
                            '<tr class="the-border">' +
                                '<td class="the-border">Momento de la Evaluación</td>' +
                                '<td>' +
                                    'Inicial &nbsp;' +
                                    '<input type="checkbox" ' + ((rubric.moment === 1)? 'checked' : '') + ' name="moment_evaluation" id="moment_evaluation1" value="1">' +
                                '</td>' +
                                '<td>' +
                                    'Intermedia, Unidad &nbsp;' +
                                    '<input type="checkbox" ' + ((rubric.moment === 2)? 'checked' : '') + ' name="moment_evaluation" id="moment_evaluation2" value="2">' +
                                '</td>' +
                                '<td colspan="3" class="text-center">' +
                                    'Final &nbsp;' +
                                    '<input type="checkbox" ' + ((rubric.moment === 3)? 'checked' : '') + ' name="moment_evaluation" id="moment_evaluation3" value="3">' +
                                '</td>' +
                            '</tr>' +
                            '<tr class="the-border">' +
                                '<td rowspan="2" class="the-border">Aspectos Evaluados</td>' +
                                '<td colspan="3" class="text-center">Niveles de desempeño de la actividad individual</td>' +
                                '<td rowspan="2" colspan="2" class="the-border">Puntaje</td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td>Valoración Alta</td>' +
                                '<td>Valoración Media</td>' +
                                '<td>Valoración Baja</td>' +
                            '</tr>' +
                            rules +
                            '<tr>' +
                                '<td class="the-border" colspan="4">Calificación Final</td>' +
                                '<td class="the-border" id="total_edit_rubric" colspan="1">' + totalValue + '</td>' +
                                '<td class="the-border" colspan="1">' +
                                    '<a href="#" class="primary-btn small goova-bt" style="padding: 0 10px" data-toggle="tooltip" onclick="addOptionRubric(`edit`)" title="" data-original-title="Nuevo Registro">' +
                                        '<span class="ti-plus"></span>' +
                                    '</a>' +
                                '</td>' +
                            '</tr>' +
                        '</table>' +
                    '</div>' +
                '</div>' +
            '</div>',
            footer =
                '<div class="col-lg-12 text-center">' +
                    '<div class="mt-40 d-flex justify-content-between">' +
                        '<button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>' +
                        '<a href="#" class="primary-btn small goova-bt" data-toggle="tooltip" onclick="saveEditedRubric(' + rubric.id + ')" title="Guardar">' +
                            '<span class="ti-save"></span>' +
                        '</a>' +
                    '</div>' +
                '</div>';

        universalModal('Editar Rúbrica', html, footer, 'modal-xlg');
        $('.m-number').mNumber();
        $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
        $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
        $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });

        $("input:checkbox").on('click', function() {
            let $box = $(this);

            if ($box.is(":checked")) {
                let group = "input:checkbox[name='" + $box.attr("name") + "']";

                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });

        $('input[name="activity"]').click(function(){ act = ($(this).prop("checked"))? $(this).val()*1 : 0; });
        $('input[name="moment_evaluation"]').click(function(){ momtE = ($(this).prop("checked"))? $(this).val()*1 : 0; });

        $('[id^="high_points_"]').change(function () {
            let selector = $(this).attr('id').split('_').pop();
            $(`#total_edit_${selector}`).text($(this).val()); doCalculate('edit');
        })

    }).fail( function(data) {
        $("body").overhang({
            type: "error",
            message: data.responseJSON.error,
            closeConfirm: true
        });
    }).always(function() {
        $('.modal').modal('hide');
    });
}

function saveEditedRubric(id) {
    if(id*1 === 0) return false;

    let idE, to_value,
        high_text, med_text,
        low_text, high_points,
        med_points, low_points,
        type,
        pass = true,
        fields = [],
        empty = false,
        q = $('[name^="to_value_edit_"]').length,
        name = $.trim($('#name_edit_rubric').val());

    empty = $('#name_edit_rubric').mValid({text: 'Nombre no debe quedar vacío.'}); if(empty){ pass = false}

    for (let i = 1; i <= q; i++) {
        if($.trim($(`#to_value_edit_${i}`).val() !== '')) {

            idE = $(`#id_edit_rubric_${i}`).val()*1;
            to_value = $(`#to_value_edit_${i}`).val();
            high_text = $(`#high_valoration_edit_${i}`).val();
            med_text = $(`#medium_valoration_edit_${i}`).val();
            low_text = $(`#low_valoration_edit_${i}`).val();
            high_points = $(`#high_points_edit_${i}`).val();
            med_points = $(`#medium_points_edit_${i}`).val();
            low_points = $(`#low_points_edit_${i}`).val();
            type = (idE === 0)? 'i' : 'u';

            fields.push({idE, to_value, high_text, med_text, low_text, high_points, med_points, low_points, type});

            empty = $('#to_value_edit_' + i).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
            empty = $('#high_valoration_edit_' + i).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
            empty = $('#medium_valoration_edit_' + i).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
            empty = $('#low_valoration_edit_' + i).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
            empty = $('#high_points_edit_' + i).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
            empty = $('#medium_points_edit_' + i).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
            empty = $('#low_points_edit_' + i).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
        }
    }

    for (let i = 0; i < del.length; i++){
        fields.push({
            'idE': del[i].idE,
            to_value: '',
            high_text: '',
            med_text: '',
            low_text: '',
            high_points:'',
            med_points: '',
            low_points: '',
            type: 'd'});
    }

    empty = (act !== 1 && act !== 2); if(empty){ pass = false }
    empty = (momtE !== 1 && momtE !== 2 && momtE !== 3); if(empty){ pass = false }

    if (pass){
        $.ajax({
            type: 'PUT',
            url: '/put-save-edited-rubric',
            data: { _token, id, name, act, momtE, fields }
        }).done(function(data) {
            filterRubrics( $.trim($('search_rubric').val()), $('#previous'), $('#next') );
            $("body").overhang({ type: "success", message: data.message });
        }).fail( function(data) {
            $("body").overhang({
                type: "error",
                message: data.responseJSON.error,
                closeConfirm: true
            });
        }).always(function() {
            $('.modal').modal('hide');
            del = [];
        });
    } else {
        $("body").overhang({
            type: "error",
            message: 'Todos los campos deben estar llenos.',
            closeConfirm: true
        });
    }
}
