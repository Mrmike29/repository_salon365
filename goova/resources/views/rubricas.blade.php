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

            .textarea-m {
                overflow-y: auto;
                scrollbar-width: thin;
                scrollbar-color: #8032fd #d9dce8;
            }


            .textarea-m::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
                border-radius: 15px;
            }

            .textarea-m::-webkit-scrollbar {
                width: 5px;
                background-color: #F5F5F5;
            }

            .textarea-m::-webkit-scrollbar-thumb {
                border-radius: 10px;
                background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.50, rgb(124, 50, 255)), color-stop(0.15, rgb(199, 56, 216)));
            }

            .divider {								/* minor cosmetics */
                display: table;
                font-size: 15px;
                text-align: center;
                width: 100%;
                margin: 15px auto;				/* spacing above/below */
            }
            .divider span { display: table-cell; position: relative; }
            .divider span:first-child, .divider span:last-child {
                width: 50%;
                top: 13px;							/* adjust vertical align */
                -moz-background-size: 100% 2px; 	/* line width */
                background-size: 100% 2px; 			/* line width */
                background-position: 0 0, 0 100%;
                background-repeat: no-repeat;
            }
            .divider span:first-child {				/* color changes in here */
                background-image: -webkit-gradient(linear, 0 0, 0 100%, from(transparent), to(#7d32fe));
                background-image: -webkit-linear-gradient(180deg, transparent, #7d32fe);
                background-image: -moz-linear-gradient(180deg, transparent, #7d32fe);
                background-image: -o-linear-gradient(180deg, transparent, #7d32fe);
                background-image: linear-gradient(90deg, transparent, #7d32fe);
            }
            .divider span:nth-child(2) {
                color: #828bb2; padding: 0px 5px; width: auto; white-space: nowrap;
            }
            .divider span:last-child {				/* color changes in here */
                background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#7d32fe), to(transparent));
                background-image: -webkit-linear-gradient(180deg, #7d32fe, transparent);
                background-image: -moz-linear-gradient(180deg, #7d32fe, transparent);
                background-image: -o-linear-gradient(180deg, #7d32fe, transparent);
                background-image: linear-gradient(90deg, #7d32fe, transparent);
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button .disabled,
            .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
            .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
                color: #fff !important;
            }

            .n-t-s { display: none !important; }

            #search_button {
                cursor: pointer;
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
                                    <h1>Gestionar Rubricas</h1>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#" class="primary-btn small fix-gr-bg" data-toggle="tooltip" onclick="openModalCreateRubric()" title="Crear Rúbrica">
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
                                        <div class="col-lg-4">
                                            <div class="dataTables_wrapper no-footer">
                                                <div class="dataTables_filter">
                                                    <label class="">
                                                        <input type="search" name="search_rubric" id="search_rubric" placeholder="Búsqueda rápida">
                                                        <a id="search_button">
                                                            <span class="ti-search"></span>
                                                        </a>
                                                    </label>
                                                </div>
                                            </div>
                                            <span class="modal_input_validation red_alert"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white-box" id="container_rubrics" style="border-radius: 0">
                                    <div class="dataTables_wrapper no-footer">
                                        <table id="table_rubrics" class="table school-table" style="border-radius: 10px; box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8);">
                                            <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                @if(1 === 1) <th>Institución</th> @endif
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody_rubrics">

                                            </tbody>
                                        </table>
                                        <div class="dataTables_info" id="table_info" role="status" aria-live="polite">

                                        </div>
                                        <div class="dataTables_paginate paging_simple_numbers" id="table_rubrics_paginate">
                                            <a class="paginate_button previous n-t-s" data-id="0" tabindex="0" id="previous">
                                                <span class="ti-angle-left"></span>
                                            </a>
                                            <span id="pagination_number">

                                            </span>
                                            <a class="paginate_button next n-t-s" data-id="20" tabindex="0" id="next">
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
                    </div>
                </section>
            </div>
        </div>

        @include('includes.footer')

        <script type="text/javascript">
            /** Mi función, la utilizo para hacer mis validaciones y la voy a patentar */
            (function( $ ){ $.fn.mValid = function(data) { data.text = $.trim($(this).val()) === ''? data.text : ''; $(this).parents('div.input-effect').siblings('span').text(data.text); return ($.trim($(this).val()) === ''); }; })( jQuery );
            /** Mi función, la utilizo para hacer mis inputs de tipo number */
            (function( $ ){ $.fn.mNumber = function() { $(this).bind('paste input',function(){ $(this).val ( $(this).val().replace (/[A-Za-zàèìòùÀÈÌÒÙáéíóúÁÉÍÓÚ !@%&`":´<>ºªñÑçÇ;·~€¬/='¿¡[\]{}()*+?,\\^$|#\s-]/g ,"")) }); }; })( jQuery );

            let page = 1,
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
                let c, html = '', q = $(`[name^="option_${type}_rubric"]`);
                c = (q.length + 1);

                html =
                    `<div class="row mt-25 t-d-${c}">` +
                        `<div class="divider"><span></span><span>Regla ${c}</span><span></span></div>` +
                        `<div class="col-5">` +
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
                            `<button type="button" class="close" onclick="removeOptionRubric(${c})">×</button>` +
                        `</div>` +
                    `</div>`;

                $(html).insertAfter(`.t-d-${q.length}`);
                $('.m-number').mNumber();
                $(`[name^="option_${type}_rubric"]`).change(function () { doCalculate(type) });
                $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } });
                $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                $('[data-toggle="tooltip"]').tooltip();
            }

            function removeOptionRubric(id) {
                if (id === '') return false;

                let q = $('[name^="option_create_rubric"]');
                for (let i = id; i <= q.length; i++){
                    if($('.t-d-' + (i+1)).length){
                        $('#option_create_rubric_' + i).val($('#option_create_rubric_' + (i+1)).val())
                        $('#description_create_rubric_' + i).val($('#description_create_rubric_' + (i+1)).val())
                    }
                }
                $(`.t-d-${q.length}`).remove(); doCalculate();
            }

            function doCalculate(type) {
                let nV = 0, q = $(`[name^="option_${type}_rubric"]`);
                for (let i = 1; i <= q.length; i++){ if($(`#option_${type}_rubric_${i}`).val()*1 !== 0){ nV += $(`#option_${type}_rubric_${i}`).val()*1; } }
                $(`#total_${type}_rubric`).val(nV).addClass('has-content');
            }

            function distributeValue(type) {
                let q, iV = $(`#total_${type}_rubric`).val();
                if(iV*1 === 0) return false;
                q = $(`[name^="option_${type}_rubric"]`).length; iV = iV/q;
                for (let i = 1; i <= q; i++){ $(`#option_${type}_rubric_${i}`).val(iV).addClass('has-content'); }
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
                        data: { "_token": "{{ csrf_token() }}", name, obj }
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
                if (id === '') return false;

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
                                '<div class="row mt-25 t-d-1">' +
                                    '<div class="divider"><span></span><span>Regla ' + key + '</span><span></span></div>' +
                                    '<div class="col-6">' +
                                        '<div class="input-effect">' +
                                            '<input class="primary-input form-control m-number has-content" type="text" name="option_edit_rubric_' + key + '" id="option_edit_rubric_' + key + '" value="' + item.score + '">' +
                                            '<label>' +
                                                'Puntos *<span></span> ' +
                                            '</label>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                        '<span class="modal_input_validation red_alert"></span>' +
                                    '</div>' +
                                    '<div class="col-6">' +
                                        '<div class="input-effect">' +
                                            '<textarea class="primary-input form-control textarea-m has-content" name="description_edit_rubric_1" id="description_edit_rubric_1" cols="30" rows="3">' + item.description + '</textarea>' +
                                            '<label>' +
                                                'Descripción *<span></span> ' +
                                            '</label>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                        '<span class="modal_input_validation red_alert"></span>' +
                                    '</div>' +
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
                                '<a href="#" class="primary-btn small fix-gr-bg" data-toggle="tooltip" onclick="saveRubric()" title="Guardar">' +
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
        </script>
    </body>
</html>
