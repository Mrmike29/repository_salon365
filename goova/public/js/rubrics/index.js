'use strict';

/** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
(function( $ ){ $.fn.mValid = function(data) { data.text = $.trim($(this).val()) === ''? data.text : ''; $(this).parents('div.input-effect').siblings('span').text(data.text); return ($.trim($(this).val()) === ''); }; })( jQuery );
/** Mi función, la utilizo para hacer mis inputs de tipo number */
(function( $ ){ $.fn.mNumber = function() { $(this).bind('paste input',function(){ $(this).val ( $(this).val().replace (/[A-Za-zàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝäëïöüÿÄËÏÖÜŸ !@%&`":´¨<>ºªñÑçÇ;·~€¬/='¿¡[\]{}()*+?,\\^$|#\s-]/g ,"")) }); }; })( jQuery );

let del = [],
    page = 1,
    next = $('#next'),
    previous = $('#previous'),
    search = $('#search_rubric'),
    searchButton = $('#search_button');

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

                if(next.attr('data-id')*20 >= rubricsC){ next.addClass('n-t-s'); }
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
                            item.entity +
                            '</td>' +
                            '<td>' +
                            '<a href="#" class="primary-btn small fix-gr-bg" data-toggle="tooltip" onclick="openModalEditRubric(' + item.id + ')" title="Editar Rúbrica">' +
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
                $('[data-toggle="tooltip"]').tooltip();
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

    searchButton.click(function (){
        page = 1;
        next.attr('data-id', 20);
        previous.attr('data-id', 0);
        filterRubrics(search.val(), previous, next);
    });

    search.keypress(function(e) {
        if(e.which === 13) {
            page = 1;
            next.attr('data-id', 20);
            previous.attr('data-id', 0);
            filterRubrics($.trim(search.val()), previous, next);
        }
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

function openModalCreateRubric() {
    let html =
        '<div class="container-fluid">' +
        '<div class="row">' +
        '<div class="col-lg-12">' +
        '<div class="row mt-25">' +
        '<div class="col-10">' +
        '<div class="input-effect">' +
        '<input class="primary-input form-control" type="text" name="name_create_rubric" id="name_create_rubric">' +
        '<label>' +
        'Nombre *<span></span> ' +
        '</label>' +
        '<span class="focus-border"></span>' +
        '</div>' +
        '<span class="modal_input_validation red_alert"></span>' +
        '</div>' +
        '<div class="col-2">' +
        '<div class="col-lg-12 text-right">' +
        '<a href="#" class="primary-btn small fix-gr-bg" style="padding: 0 10px" data-toggle="tooltip" onclick="addOptionRubric(`create`)" title="Nueva Regla">' +
        '<span class="ti-plus"></span>' +
        '</a>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="row mt-25 t-d-1">' +
        '<div class="divider"><span></span><span>Regla 1</span><span></span></div>' +
        '<div class="col-6">' +
        '<div class="input-effect">' +
        '<input class="primary-input form-control m-number" type="text" name="option_create_rubric_1" id="option_create_rubric_1">' +
        '<label>' +
        'Puntos *<span></span> ' +
        '</label>' +
        '<span class="focus-border"></span>' +
        '</div>' +
        '<span class="modal_input_validation red_alert"></span>' +
        '</div>' +
        '<div class="col-6">' +
        '<div class="input-effect">' +
        '<textarea class="primary-input form-control textarea-m" name="description_create_rubric_1" id="description_create_rubric_1" cols="30" rows="3"></textarea>' +
        '<label>' +
        'Descripción *<span></span> ' +
        '</label>' +
        '<span class="focus-border"></span>' +
        '</div>' +
        '<span class="modal_input_validation red_alert"></span>' +
        '</div>' +
        '</div>' +
        '<div class="row mt-25">' +
        '<div class="divider"><span></span><span>Puntaje Total</span><span></span></div>' +
        '<div class="col-10">' +
        '<div class="input-effect">' +
        '<input class="primary-input form-control m-number" type="text" name="total_create_rubric" id="total_create_rubric">' +
        '<label>' +
        'Total <span></span> ' +
        '</label>' +
        '<span class="focus-border"></span>' +
        '</div>' +
        '<span class="modal_input_validation red_alert"></span>' +
        '</div>' +
        '<div class="col-2">' +
        '<a href="#" class="primary-btn small fix-gr-bg" style="padding: 0 10px" data-toggle="tooltip" onclick="distributeValue(`create`)" title="Distribuir">' +
        '<span class="ti-view-list"></span>' +
        '</a>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>',
        footer =
            '<div class="col-lg-12 text-center">' +
            '<div class="mt-40 d-flex justify-content-between">' +
            '<button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>' +
            '<a href="#" class="primary-btn small fix-gr-bg" data-toggle="tooltip" onclick="saveRubric()" title="Guardar">' +
            '<span class="ti-save"></span>' +
            '</a>' +
            '</div>' +
            '</div>';

    universalModal('Crear Rúbrica', html, footer);
    $('.m-number').mNumber();
    $('[name^="option_create_rubric"]').change(function () { doCalculate('create') });
    $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
    $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
    $('[data-toggle="tooltip"]').tooltip();
}

function addOptionRubric(type){
    let c, html = '', q = $('[class^="row mt-25 t-d-"]');
    c = (q.length + 1);

    html =
        `<div class="row mt-25 t-d-${c}">` +
        `<div class="divider"><span></span><span>Regla ${c}</span><span></span></div>` +
        `<div class="col-5">` +
        ((type === 'edit')? `<input type="hidden" id="id_${type}_rubric_${c}" value="0">` : ``) +
        `<div class="input-effect">` +
        `<input class="primary-input form-control m-number" type="text" name="option_${type}_rubric_${c}" id="option_${type}_rubric_${c}">` +
        `<label>` +
        `Puntos *<span></span> ` +
        `</label>` +
        `<span class="focus-border"></span>` +
        `</div>` +
        `<span class="modal_input_validation red_alert"></span>` +
        `</div>` +
        `<div class="col-5">` +
        `<div class="input-effect">` +
        `<textarea class="primary-input form-control textarea-m" name="description_${type}_rubric_${c}" id="description_${type}_rubric_${c}" cols="30" rows="3"></textarea>` +
        `<label>` +
        `Descripción *<span></span> ` +
        `</label>` +
        `<span class="focus-border"></span>` +
        `</div>` +
        `<span class="modal_input_validation red_alert"></span>` +
        `</div>` +
        `<div class="col-2">` +
        `<button type="button" class="close" onclick="removeOptionRubric(${c}, '${type}')">×</button>` +
        `</div>` +
        `</div>`;

    $(html).insertAfter(`.t-d-${q.length}`);
    $('.m-number').mNumber();
    $(`[name^="option_${type}_rubric"]`).change(function () { doCalculate(type) });
    $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
    $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
    $('[data-toggle="tooltip"]').tooltip();
}

function removeOptionRubric(id, type, idE = 0, exists = false) {
    if(id*1 === 0) return false;

    if(exists) {
        if (idE === 0) return false;

        let html =
            '<div class="col-12" style="text-align: center;">' +
            '<a class="restore" onclick="restoreRule(' + id + ', ' + idE + ')">' +
            'Restablecer' +
            '</a>' +
            '</div>';

        del.push({idE});
        $(`.t-d-${id} [class^="col-"]`).remove();
        $(html).insertAfter(`.t-d-${id} .divider`);
    } else {
        let q = $('[class^="row mt-25 t-d-"]');
        for (let i = id; i <= q.length; i++){
            if($('.t-d-' + (i+1)).length){
                $(`#option_${type}_rubric_${i}`).val($(`#option_${type}_rubric_` + (i+1)).val())
                $(`#description_${type}_rubric_${i}`).val($(`#description_${type}_rubric_` + (i+1)).val())
            }
        }
        $(`.t-d-${q.length}`).remove();
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
                '<div class="col-5">' +
                '<input type="hidden" id="id_edit_rubric_' + id + '" value="' + idE + '">' +
                '<div class="input-effect">' +
                '<input class="primary-input form-control m-number has-content" type="text" name="option_edit_rubric_' + id + '" id="option_edit_rubric_' + id + '" value="' + rule.score + '">' +
                '<label>' +
                'Puntos *<span></span> ' +
                '</label>' +
                '<span class="focus-border"></span>' +
                '</div>' +
                '<span class="modal_input_validation red_alert"></span>' +
                '</div>' +
                '<div class="col-5">' +
                '<div class="input-effect">' +
                '<textarea class="primary-input form-control textarea-m has-content" name="description_edit_rubric_'  + id +  '" id="description_edit_rubric_'  + id +  '" cols="30" rows="3">' + rule.description + '</textarea>' +
                '<label>' +
                'Descripción *<span></span> ' +
                '</label>' +
                '<span class="focus-border"></span>' +
                '</div>' +
                '<span class="modal_input_validation red_alert"></span>' +
                '</div>' +
                '<div class="col-2">' +
                '<button type="button" class="close" onclick="removeOptionRubric(' + id + ', `edit`, ' + idE + ', true)">×</button>' +
                '</div>';

            $(`.t-d-${id} [class^="col-"]`).remove();
            $(html).insertAfter(`.t-d-${id} .divider`);
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
    let nV = 0, q = $('[class^="row mt-25 t-d-"]');
    for (let i = 1; i <= q.length; i++){
        if($(`#option_${type}_rubric_${i}`).val()*1 !== 0 && !Number.isNaN($(`#option_${type}_rubric_${i}`).val()*1)){
            nV += $(`#option_${type}_rubric_${i}`).val()*1;
        }
    }
    $(`#total_${type}_rubric`).val(nV).addClass('has-content');
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
        options = $('[name^="option_create_rubric"]');

    empty = $('#name_create_rubric').mValid({text: 'Nombre no debe quedar vacío.'}); if(empty){ pass = false}

    for (let i = 0; i < options.length; i++){
        obj[i] = {
            value: $.trim($('#option_create_rubric_' + (i + 1)).val()),
            desc: $.trim($('#description_create_rubric_' + (i + 1)).val())
        }

        empty = $('#option_create_rubric_' + (i + 1)).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
        empty = $('#description_create_rubric_' + (i + 1)).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
    }

    if (pass){
        $.ajax({
            type: 'POST',
            url: '/post-save-rubric',
            data: { _token, name, obj }
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
    }
}

function openModalEditRubric(id){
    if(id*1 === 0) return false;

    del = [];

    $.ajax({
        type: 'GET',
        url: '/get-data-edit-rubric',
        data: { id }
    }).done(function(data) {

        let rules = '',
            totalValue = 0,
            rubric = data.rubric,
            rubricRules = data.rubricRules;

        rubricRules.forEach((item, key) => {
            key++;
            totalValue += parseInt(item.score);

            rules +=
                '<div class="row mt-25 t-d-' + key + '">' +
                '<div class="divider"><span></span><span>Regla ' + key + '</span><span></span></div>' +
                '<div class="col-' + ((key === 1)? '6' : '5') + '">' +
                '<input type="hidden" id="id_edit_rubric_' + key + '" value="' + item.id + '">' +
                '<div class="input-effect">' +
                '<input class="primary-input form-control m-number has-content" type="text" name="option_edit_rubric_' + key + '" id="option_edit_rubric_' + key + '" value="' + item.score + '">' +
                '<label>' +
                'Puntos *<span></span> ' +
                '</label>' +
                '<span class="focus-border"></span>' +
                '</div>' +
                '<span class="modal_input_validation red_alert"></span>' +
                '</div>' +
                '<div class="col-' + ((key === 1)? '6' : '5') + '">' +
                '<div class="input-effect">' +
                '<textarea class="primary-input form-control textarea-m has-content" name="description_edit_rubric_' + key + '" id="description_edit_rubric_' + key + '" cols="30" rows="3">' + item.description + '</textarea>' +
                '<label>' +
                'Descripción *<span></span> ' +
                '</label>' +
                '<span class="focus-border"></span>' +
                '</div>' +
                '<span class="modal_input_validation red_alert"></span>' +
                '</div>' +
                ((key === 1)? '' :
                    '<div class="col-2">' +
                    '<button type="button" class="close" onclick="removeOptionRubric(' + key + ', `edit`, ' + item.id + ', true)">×</button>' +
                    '</div>') +
                '</div>'
        })

        let html =
            '<div class="container-fluid">' +
            '<div class="row">' +
            '<div class="col-lg-12">' +
            '<div class="row mt-25">' +
            '<div class="col-10">' +
            '<div class="input-effect">' +
            '<input class="primary-input form-control has-content" type="text" name="name_edit_rubric" id="name_edit_rubric" value="' + rubric.name + '">' +
            '<label>' +
            'Nombre *<span></span> ' +
            '</label>' +
            '<span class="focus-border"></span>' +
            '</div>' +
            '<span class="modal_input_validation red_alert"></span>' +
            '</div>' +
            '<div class="col-2">' +
            '<div class="col-lg-12 text-right">' +
            '<a href="#" class="primary-btn small fix-gr-bg" style="padding: 0 10px" data-toggle="tooltip" onclick="addOptionRubric(`edit`)" title="Nueva Regla">' +
            '<span class="ti-plus"></span>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            rules +
            '<div class="row mt-25">' +
            '<div class="divider"><span></span><span>Puntaje Total</span><span></span></div>' +
            '<div class="col-10">' +
            '<div class="input-effect">' +
            '<input class="primary-input form-control m-number has-content" type="text" name="total_edit_rubric" id="total_edit_rubric" value="' + totalValue + '">' +
            '<label>' +
            'Total <span></span> ' +
            '</label>' +
            '<span class="focus-border"></span>' +
            '</div>' +
            '<span class="modal_input_validation red_alert"></span>' +
            '</div>' +
            '<div class="col-2">' +
            '<a href="#" class="primary-btn small fix-gr-bg" style="padding: 0 10px" data-toggle="tooltip" onclick="distributeValue(`edit`)" title="Distribuir">' +
            '<span class="ti-view-list"></span>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>',
            footer =
                '<div class="col-lg-12 text-center">' +
                '<div class="mt-40 d-flex justify-content-between">' +
                '<button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>' +
                '<a href="#" class="primary-btn small fix-gr-bg" data-toggle="tooltip" onclick="saveEditedRubric(' + rubric.id + ')" title="Guardar">' +
                '<span class="ti-save"></span>' +
                '</a>' +
                '</div>' +
                '</div>';

        universalModal('Editar Rúbrica', html, footer);
        $('.m-number').mNumber();
        $('[name^="option_edit_rubric"]').change(function () { doCalculate('edit') });
        $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
        $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
        $('[data-toggle="tooltip"]').tooltip();
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

    let idE, val,
        desc, type,
        pass = true,
        fields = [],
        empty = false,
        q = $('[class^="row mt-25 t-d-"]').length,
        name = $.trim($('#name_edit_rubric').val());

    empty = $('#name_edit_rubric').mValid({text: 'Nombre no debe quedar vacío.'}); if(empty){ pass = false}

    for (let i = 1; i <= q; i++) {
        if(!Number.isNaN($(`#option_edit_rubric_${i}`).val()*1)) {
            idE = $(`#id_edit_rubric_${i}`).val()*1;
            val = $(`#option_edit_rubric_${i}`).val();
            desc = $(`#description_edit_rubric_${i}`).val();
            type = (idE === 0)? 'i' : 'u';

            fields.push({idE, val, desc, type});

            empty = $('#option_edit_rubric_' + i).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
            empty = $('#description_edit_rubric_' + i).mValid({text: 'Campo obligatorio.'}); if(empty){ pass = false}
        }
    }

    for (let i = 0; i < del.length; i++){
        fields.push({'idE': del[i].idE, val: '', desc: '', type: 'd'});
    }

    if (pass){
        $.ajax({
            type: 'PUT',
            url: '/put-save-edited-rubric',
            data: { _token, id, name, fields }
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
    }
}
