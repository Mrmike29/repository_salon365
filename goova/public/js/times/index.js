'use strict';

/** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
(function( $ ){
    $.fn.mValid = function(data) {
        data.text = $.trim($(this).val()) === ''? data.text : '';
        $(this).parents('div.input-effect').siblings('span').text(data.text);
        console.log($(this).val());
        return ($.trim($(this).val()) === '');
    };
})( jQuery );
/** Mi función, la utilizo para hacer mis inputs de tipo number */
(function( $ ){ $.fn.mNumber = function() { $(this).bind('paste input',function(){ $(this).val ( $(this).val().replace (/[A-Za-zàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝäëïöüÿÄËÏÖÜŸ !@%&`":´¨<>ºªñÑçÇ;·~€¬/='¿¡[\]{}()*+?,\\^$|#\s-]/g ,"")) }); }; })( jQuery );

let del = [],
    page = 1,
    next = $('#next'),
    previous = $('#previous'),
    search = $('#search_times');

const filterTimes = (search, previous, next) => {

    if(previous.attr('data-id')*1 === 0){ previous.addClass('n-t-s'); }
    else { previous.removeClass('n-t-s'); }

    let nxt = next.attr('data-id'),
        prev = previous.attr('data-id');

    $.ajax({
        type: 'GET',
        url: '/get-times-list',
        data: { search, prev, nxt },
        success: (data) => {
            let html = '',
                times = data.times,
                timesC = data.counter,
                contPags = 0,
                contHelper = 0,
                htmlPager = '';

            for (let i = 1; i <= timesC; i++) {
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

            if(next.attr('data-id')*20 >= timesC){ next.addClass('n-t-s'); }
            else{ next.removeClass('n-t-s'); }

            $('#table_info').text(`Mostrando registros del ${ (timesC !== 0)? parseInt(previous.attr('data-id') ) + 1 : 0 } al ${ parseInt(previous.attr('data-id') ) + times.length } de un total de ${ timesC } registros`)

            if(timesC !== 0) {

                times.forEach((item) => {
                    html +=
                        '<tr>' +
                        '<td>' +
                        item.name +
                        '</td>' +
                        '<td>' +
                        item.time_start +
                        '</td>' +
                        '<td>' +
                        item.time_end +
                        '</td>' +
                        '<td>' +
                        item.duration +
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

            $('#tbody_times').html(html);
        }
    });
},
paranoia = (number) => {
    page = number;
    previous.attr('data-id', (page-1)*20);
    next.attr('data-id', page*20);
    filterTimes($.trim(search.val()), previous, next);
},
mDate = (date, format = "") => {
    let d = [],
        oN = [],
        oS = [],
        dN = 0, mN = 0, yN = 0,
        cS = 0, fS = "", sS = "",
        r = "", e = false,
        eM = "Formato invalido.";

    d['D'] = date.getDate();
    d['M'] = date.getMonth()+1;
    d['Y'] = date.getFullYear();

    if(format !== ""){
        for (let i = 0; i < format.length; i++) {
            if (i === 0) oN.push(format.charAt(i).toUpperCase());
            if (format.charAt(i) === 'd' || format.charAt(i) === 'D') dN++;
            if (format.charAt(i) === 'm' || format.charAt(i) === 'M') mN++;
            if (format.charAt(i) === 'y' || format.charAt(i) === 'Y') yN++;
            if (format.charAt(i) === '/' || format.charAt(i) === '-'){
                switch(cS) {
                    case 0: fS = format.charAt(i); oS.push(format.charAt(i)); oN.push(format.charAt(i+1).toUpperCase()); cS++; break;
                    case 1: sS = format.charAt(i); oS.push(format.charAt(i)); oN.push(format.charAt(i+1).toUpperCase()); cS++; break;
                    default: e = true;
                }
            }
        }

        if (!dN || !mN || !yN) if (cS > 1) e = true;
        if (format.length > 0) if (!dN && !mN && !yN) e = true;
        if (!dN && !mN || !dN && !yN || !mN && !yN) if (cS > 0) e = true;

        if(cS > 2 || dN > 2 || mN > 2 || yN > 4 || yN === 3) e = true;

        if (e) return eM;

        if (dN){ if (dN === 2 && String(d['D']).length < 2){ d['D'] = '0' + d['D'] } }
        if (mN){ if (mN === 2 && String(d['M']).length < 2){ d['M'] = '0' + d['M'] } }
        if (yN){ if (yN === 2)  d['Y'] = String(d['Y']).slice(2); d['Y'] = d['Y']*1; }

        for (let i = 0; i < oN.length; i++){ r += d[oN[i]] + ((oS[i])? oS[i] : ''); }
    }

    return r;
};

$(document).ready(function(){

    filterTimes($.trim(search.val()), previous, next);

    search.keyup(function(e) {
        page = 1;
        next.attr('data-id', 20);
        previous.attr('data-id', 0);
        filterTimes($.trim(search.val()), previous, next);

    });

    previous.click(function(){
        page--;
        next.attr('data-id', previous.attr('data-id'));
        previous.attr('data-id', previous.attr('data-id') - 20);
        filterTimes($.trim(search.val()), previous, next);
    });

    next.click(function(){
        page++;
        previous.attr('data-id', next.attr('data-id'));
        next.attr('data-id', parseInt(next.attr('data-id')) + 20);
        filterTimes($.trim(search.val()), previous, next);
    });
});

function openModalCreateTime() {
    let html =
        '<div class="container-fluid">' +
            '<div class="row">' +
                '<div class="col-lg-12">' +
                    '<div class="warning">' +
                        '<strong>Aviso!</strong> Debe distribuir sus Ciclos/Periodos entre 10 meses.' +
                    '</div>' +
                '</div>' +
                '<div class="col-lg-12">' +
                    '<div class="row mt-25">' +
                        '<div class="col-lg-12" id="sibling_class_div">' +
                            '<div class="input-effect">' +
                                '<input class="primary-input form-control" type="text" name="name_create_time" id="name_create_time">' +
                                '<label>' +
                                    'Nº Periodo *<span></span> ' +
                                '</label>' +
                                '<span class="focus-border"></span>' +
                            '</div>' +
                            '<span class="modal_input_validation red_alert"></span>' +
                        '</div>' +
                    '</div>' +
                    '<div class="row mt-30">' +
                        '<div class="col-lg-6" id="">' +
                            '<div class="no-gutters input-right-icon">' +
                                '<div class="col">' +
                                    '<div class="input-effect date">' +
                                        '<div class="input-group">' +
                                            '<input class="read-only-input primary-input date form-control" id="date_create_time" type="text" readonly="true" autocomplete="off" name="date_create_time" value="' + mDate(new Date(), "YYYY-MM-DD") + '">' +
                                            '<label>' +
                                                'Inicio <span></span> ' +
                                            '</label>' +
                                        '</div>' +
                                    '</div>' +
                                    '<span class="modal_input_validation red_alert"></span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-lg-6" id="">' +
                            '<div class="no-gutters input-right-icon">' +
                                '<div class="col">' +
                                    '<div class="input-effect date">' +
                                        '<div class="input-group">' +
                                            '<input class="read-only-input primary-input date form-control" id="date_end_create_time" type="text" readonly="true" autocomplete="off" name="date_end_create_time" value="' + mDate(new Date(), "YYYY-MM-DD") +'">' +
                                            '<label>' +
                                                'Fin <span></span> ' +
                                            '</label>' +
                                        '</div>' +
                                    '</div>' +
                                    '<span class="modal_input_validation red_alert"></span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-lg-12 text-center">' +
                        '<div class="mt-40 d-flex justify-content-between">' +
                            '<button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>' +
                            '<a href="#" class="primary-btn small goova-bt" onclick="saveNewTime()">' +
                                '<span class="ti-plus pr-2"></span>' +
                                'Guardar' +
                            '</a>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>';

    universalModal('Crear Ciclo/Periodo', html);
    $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
    $('#date_create_time').datepicker({ format: 'yyyy-mm-dd', autoclose: false, setDate: new Date() }).on('changeDate', function (ev) { $(this).focus(); });
    $('#date_end_create_time').datepicker({ format: 'yyyy-mm-dd', autoclose: false, setDate: new Date() }).on('changeDate', function (ev) { $(this).focus(); });
}

function saveNewTime() {
    let pass = true,
        empty = false,
        name = $.trim($('#name_create_time').val()),
        dateStart = $.trim($('#date_create_time').val()),
        dateStartD =  new Date(dateStart),
        dateEnd = $.trim($('#date_end_create_time').val()),
        dateEndD =  new Date(dateEnd),
        duration = (dateEndD.getTime() - dateStartD.getTime()) / (1000 * 3600 * 24);

    empty = $('#name_create_time').mValid({text: 'Nombre no debe quedar vacío.'}); if(empty){ pass = false}
    empty = $('#date_create_time').mValid({text: 'Fecha de inicio no debe quedar vacía.'}); if(empty){ pass = false}
    empty = $('#date_end_create_time').mValid({text: 'Fecha de finalización no debe quedar vacía.'}); if(empty){ pass = false}

    if(pass){
        $.ajax({
            type: 'POST',
            url: '/post-save-time',
            data: {
                _token,
                name,
                dateStart,
                dateEnd,
                duration
            },
            success: (data) => {
                filterTimes();
                $('.modal').modal('hide');
                $("body").overhang({
                    type: "success",
                    message: "Exito! Se creó el Ciclo/Periodo exitosamente!"
                });
            }
        });
    }
}
