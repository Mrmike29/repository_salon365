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
                                    <h1>Ciclo O Periodo</h1>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#" class="primary-btn small fix-gr-bg" data-toggle="tooltip" onclick="openModalCreateTime()" title="Agregar Ciclo/Periodo">
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
                                    @if(1 === 1)
                                    <div class="row mt-25">
                                        <div class="col-lg-4" id="sibling_class_div">
                                            <div class="input-effect">
                                                <input class="primary-input form-control" type="text" name="name_create_event" id="name_create_event">
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
                                <div class="white-box" id="container_times" style="border-radius: 0">
                                    <table id="table_times" class="table school-table" style="border-radius: 10px; box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8);">
                                        <thead>
                                            <tr>
                                                <th>Nº Periodo/Ciclo</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>Duración</th>
                                                @if(1 === 1) <th>Institución</th> @endif
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_times">

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

            const filterTimes = () => {
                $.ajax({
                    type: 'GET',
                    url: '/get-times-list',
                    success: (data) => {
                        let html = '',
                            times = data.times;

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
                                    '<td>' +
                                        item.id_entity +
                                    '</td>' +
                                '</tr>'
                        });

                        $('#tbody_times').html(html);
                    }
                });
            };

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
                                                        '<input class="read-only-input primary-input date form-control" id="date_create_time" type="text" readonly="true" autocomplete="off" name="date_create_time" value="{{ date("Y-m-d") }}">' +
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
                                                        '<input class="read-only-input primary-input date form-control" id="date_end_create_time" type="text" readonly="true" autocomplete="off" name="date_end_create_time" value="{{ date("Y-m-d") }}">' +
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
                                        '<a href="#" class="primary-btn small fix-gr-bg" onclick="saveNewTime()">' +
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
                            "_token": "{{ csrf_token() }}",
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

            filterTimes();
        </script>
    </body>
</html>
