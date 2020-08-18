<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
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
                            <h1>Fechas Importantes</h1>
                        </div>
                    </div>
                </section>

                <section class="mt-50">
                    <div class="container-fluid p-0">
                        <div class="row">

                            <div class="col-lg-7 col-xl-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title">


                                            <div id="eventContent" title="Event Details" style="display:none;">
                                                Start: <span id="startTime"></span><br>
                                                End: <span id="endTime"></span><br><br>
                                                <p id="eventInfo"></p>
                                                <p><strong><a id="eventLink" href="" target="_blank">Read More</a></strong></p>
                                            </div>


                                            <h3 class="mb-30">Calendario</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="white-box" id="container_calendar">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-xl-4 mt-50-md md_infix_50">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="main-title">
                                            <h3 class="mb-30">Eventos</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 text-right col-md-6 col-6">

                                        <a href="#" class="primary-btn small fix-gr-bg" onclick="openModalCreateEvent()" title="Agregar Evento">
                                            <span class="ti-plus pr-2"></span>
                                            Agregar
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="white-box school-table">
                                            <div class="row to-do-list mb-20">
                                                <div class="col-md-6 col-6">
                                                    <button class="primary-btn small fix-gr-bg" id="toDoList">Pendientes</button>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <button class="primary-btn small tr-bg" id="toDoListsCompleted">Realizadas</button>
                                                </div>
                                            </div>

                                            <input type="hidden" id="url" value="http://demo.infixedu.com">

                                            <div class="toDoList" id="listPendingEvent">

                                            </div>

                                            <div class="toDoListsCompleted" id="listHeldEvents" style="display: none;">

                                            </div>
                                        </div>
                                    </div>
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
                    return ($.trim($(this).val()) === '');
                };
            })( jQuery );

            const
                getPendingEvents = () => {
                    $.ajax({
                        type: 'GET',
                        url: '/get-pending-events',
                        success: (data) => {
                            let html = '',
                                dates = data.dates

                            dates.forEach((item) => {
                                html +=
                                    '<div class="single-to-do d-flex justify-content-between toDoList" id="event_date_' + item.id + '">' +
                                        '<div onclick="openModalEvent(' + item.id + ')" style="cursor: pointer;">' +
                                            '<h5 class="d-inline">' + item.name + '</h5>' +
                                            '<p>' +
                                                item.date.slice(0, -3) + ' - ' + item.end.slice(0, -3) +
                                            '</p>' +
                                        '</div>' +
                                    '</div>'
                            })

                            $('#listPendingEvent').html(html);
                        }
                    });
                },
                getHeldEvents = () => {
                    $.ajax({
                        type: 'GET',
                        url: '/get-held-events',
                        success: (data) => {
                            let html = '',
                                dates = data.dates

                            dates.forEach((item) => {
                                html +=
                                    '<div class="single-to-do d-flex justify-content-between toDoList" id="event_held_date_' + item.id + '">' +
                                        '<div style="cursor: pointer;">' +
                                            '<h5 class="d-inline">' + item.name + '</h5>' +
                                            '<p>' +
                                                item.date.slice(0, -3) + ' - ' + item.end.slice(0, -3) +
                                            '</p>' +
                                        '</div>' +
                                    '</div>'
                            })

                            $('#listHeldEvents').html(html);
                        }
                    });
                },
                getCalendarEvents = () => {

                    $.ajax({
                        type: 'GET',
                        url: '/get-calendar-events',
                        success: (data) => {
                            let dates = data.dates;

                            $('#container_calendar').html(
                                '<div class="common-calendar fc fc-unthemed fc-ltr">' +
                                    '<div class="fc-toolbar fc-header-toolbar">' +
                                    '</div>' +
                                '</div>'
                            );

                            $('.common-calendar').fullCalendar({
                                lang: 'es',
                                header: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'month,agendaWeek,agendaDay'
                                },
                                eventClick: function (event, jsEvent, view) {
                                    let id = event.id;
                                    $.ajax({
                                        type: 'GET',
                                        url: '/get-event',
                                        data: {id},
                                        success: (data) => {
                                            let dateTimeStart,
                                                dateTimeEnd,
                                                event = data.event;

                                            dateTimeStart = event.date.split(" ")[1];
                                            event.date = event.date.split(" ")[0];
                                            dateTimeEnd = event.end.split(" ")[1];
                                            event.end = event.end.split(" ")[0];

                                            let html =
                                                '<div class="container-fluid">' +
                                                    '<div class="row">' +
                                                        '<div class="col-lg-12">' +
                                                            '<div class="row mt-25">' +
                                                                '<div class="col-lg-12">' +
                                                                    '<div class="input-effect">' +
                                                                        '<input class="primary-input form-control has-content" readonly type="text" value="' + event.name + '">' +
                                                                        '<label>' +
                                                                            'Nombre *<span></span> ' +
                                                                        '</label>' +
                                                                        '<span class="focus-border"></span>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<div class="row mt-25">' +
                                                                '<div class="col-lg-12" id="sibling_class_div">' +
                                                                    '<div class="input-effect">' +
                                                                        '<textarea class="primary-input form-control has-content" readonly cols="30" rows="10">' + event.description + '</textarea>' +
                                                                        '<label>' +
                                                                            'Descripción *<span></span> ' +
                                                                        '</label>' +
                                                                        '<span class="focus-border"></span>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<div class="row mt-30">' +
                                                                '<div class="col-lg-6" id="">' +
                                                                    '<div class="no-gutters input-right-icon">' +
                                                                        '<div class="col">' +
                                                                            '<div class="input-effect date">' +
                                                                                '<div class="input-group">' +
                                                                                    '<input class="read-only-input primary-input date form-control" type="text" readonly="true" value="' + event.date + '">' +
                                                                                    '<input class="read-only-input primary-input date form-control" type="text" readonly="true" value="' + dateTimeStart + '">' +
                                                                                    '<label>' +
                                                                                        'Inicio <span></span> ' +
                                                                                    '</label>' +
                                                                                '</div>' +
                                                                            '</div>' +
                                                                        '</div>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<div class="col-lg-6" id="">' +
                                                                    '<div class="no-gutters input-right-icon">' +
                                                                        '<div class="col">' +
                                                                            '<div class="input-effect date">' +
                                                                                '<div class="input-group">' +
                                                                                    '<input class="read-only-input primary-input date form-control" type="text" readonly="true" value="' + event.end + '">' +
                                                                                    '<input class="read-only-input primary-input date form-control" type="text" readonly="true" value="' + dateTimeEnd + '">' +
                                                                                    '<label>' +
                                                                                        'Fin <span></span> ' +
                                                                                    '</label>' +
                                                                                '</div>' +
                                                                            '</div>' +
                                                                        '</div>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<div class="col-lg-12 text-center">' +
                                                                '<div class="mt-40 d-flex justify-content-between">' +
                                                                    '<button style="background: transparent;border: transparent;"></button>' +
                                                                    '<button type="button" class="primary-btn small fix-gr-bg" data-dismiss="modal">Ok</button>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>';

                                            universalModal('Crear Evento', html);
                                        }
                                    });
                                    return false;
                                },
                                height: 650,
                                events: dates,
                            });
                        }
                    });
                };

            function openModalCreateEvent(){
                let html =
                    '<div class="container-fluid">' +
                        '<div class="row">' +
                            '<div class="col-lg-12">' +
                                '<div class="row mt-25">' +
                                    '<div class="col-lg-12" id="sibling_class_div">' +
                                        '<div class="input-effect">' +
                                            '<input class="primary-input form-control" type="text" name="name_create_event" id="name_create_event">' +
                                            '<label>' +
                                                'Nombre *<span></span> ' +
                                            '</label>' +
                                            '<span class="focus-border"></span>' +
                                        '</div>' +
                                        '<span class="modal_input_validation red_alert"></span>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="row mt-25">' +
                                    '<div class="col-lg-12" id="sibling_class_div">' +
                                        '<div class="input-effect">' +
                                            '<textarea class="primary-input form-control" name="description_create_event" id="description_create_event" cols="30" rows="10"></textarea>' +
                                            '<label>' +
                                                'Descripción *<span></span> ' +
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
                                                        '<input class="read-only-input primary-input date form-control" id="date_create_event" type="text" readonly="true" autocomplete="off" name="date_create_event" value="{{ date("Y-m-d") }}">' +
                                                        '<input class="read-only-input primary-input date form-control" id="datetime_create_event" type="text" autocomplete="off" name="datetime_create_event">' +
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
                                                        '<input class="read-only-input primary-input date form-control" id="date_end_create_event" type="text" readonly="true" autocomplete="off" name="date_end_create_event" value="{{ date("Y-m-d") }}">' +
                                                        '<input class="read-only-input primary-input date form-control" id="datetime_end_create_event" type="text" autocomplete="off" name="datetime_end_create_event">' +
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
                                        '<a href="#" class="primary-btn small fix-gr-bg" onclick="saveNewEvent()">' +
                                            '<span class="ti-plus pr-2"></span>' +
                                            'Guardar' +
                                        '</a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                universalModal('Crear Evento', html);
                $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                $('#date_create_event').datepicker({ format: 'yyyy-mm-dd', autoclose: false, setDate: new Date() }).on('changeDate', function (ev) { $(this).focus(); });
                $('#date_end_create_event').datepicker({ format: 'yyyy-mm-dd', autoclose: false, setDate: new Date() }).on('changeDate', function (ev) { $(this).focus(); });
                $("#datetime_create_event").datetimepicker({format: 'HH:mm' }).val("12:00");
                $("#datetime_end_create_event").datetimepicker({format: 'HH:mm' }).val("12:00");
            }

            function saveNewEvent() {
                let pass = true,
                    empty = false,
                    name = $.trim($('#name_create_event').val()),
                    description = $.trim($('#description_create_event').val()),
                    dateStart = $.trim($('#date_create_event').val()),
                    timeStart = $.trim($('#datetime_create_event').val()),
                    dateEnd = $.trim($('#date_end_create_event').val()),
                    timeEnd = $.trim($('#datetime_end_create_event').val());

                empty = $('#name_create_event').mValid({text: 'Nombre no debe quedar vacío.'}); if(empty){ pass = false}
                empty = $('#description_create_event').mValid({text: 'Descripción no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#date_create_event').mValid({text: 'Fecha de inicio no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#datetime_create_event').mValid({text: 'Fecha de inicio no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#date_end_create_event').mValid({text: 'Fecha de finalización no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#datetime_end_create_event').mValid({text: 'Fecha de finalización no debe quedar vacía.'}); if(empty){ pass = false}

                if (pass) {
                    $.ajax({
                        type: 'POST',
                        url: '/post-save-event',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            name,
                            description,
                            dateStart,
                            timeStart,
                            dateEnd,
                            timeEnd
                        },
                        success: (data) => {
                            getCalendarEvents();
                            getPendingEvents();
                            getHeldEvents();
                            $('.modal').modal('hide');
                            $("body").overhang({
                                type: "success",
                                message: "Exito! Se creó el evento exitosamente!"
                            });
                        }
                    });
                }
            }

            function openModalEvent(id){

                $.ajax({
                    type: 'GET',
                    url: '/get-event',
                    data: { id },
                    success: (data) => {
                        let dateTimeStart,
                            dateTimeEnd,
                            event = data.event;

                        dateTimeStart = event.date.split(" ")[1];
                        event.date = event.date.split(" ")[0];
                        dateTimeEnd = event.end.split(" ")[1];
                        event.end = event.end.split(" ")[0];

                        let html =
                            '<div class="container-fluid">' +
                                '<div class="row">' +
                                    '<div class="col-lg-12">' +
                                        '<div class="row mt-25">' +
                                            '<div class="col-lg-12" id="sibling_class_div">' +
                                                '<div class="input-effect">' +
                                                    '<input class="primary-input form-control has-content" type="text" name="name_edit_event" id="name_edit_event" value="' + event.name + '">' +
                                                    '<label>' +
                                                        'Nombre *<span></span> ' +
                                                    '</label>' +
                                                    '<span class="focus-border"></span>' +
                                                '</div>' +
                                                '<span class="modal_input_validation red_alert"></span>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row mt-25">' +
                                            '<div class="col-lg-12" id="sibling_class_div">' +
                                                '<div class="input-effect">' +
                                                    '<textarea class="primary-input form-control has-content" name="description_edit_event" id="description_edit_event" cols="30" rows="10">' + event.description + '</textarea>' +
                                                    '<label>' +
                                                        'Descripción *<span></span> ' +
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
                                                                '<input class="read-only-input primary-input date form-control" id="date_edit_event" type="text" readonly="true" autocomplete="off" name="date_edit_event" value="' + event.date + '">' +
                                                                '<input class="read-only-input primary-input date form-control" id="datetime_edit_event" type="text" autocomplete="off" name="datetime_edit_event" value="' + dateTimeStart + '">' +
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
                                                                '<input class="read-only-input primary-input date form-control" id="date_end_edit_event" type="text" readonly="true" autocomplete="off" name="date_end_edit_event" value="' + event.end + '">' +
                                                                '<input class="read-only-input primary-input date form-control" id="datetime_end_edit_event" type="text" autocomplete="off" name="datetime_end_edit_event" value="' + dateTimeEnd + '">' +
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
                                                '<a href="#" class="primary-btn small fix-gr-bg" onclick="saveChangesEditEvent(' + event.id + ')">' +
                                                    '<span class="ti-save pr-2"></span>' +
                                                    'Guardar' +
                                                '</a>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

                        universalModal('Editar Evento', html);
                        $('input').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                        $('textarea').change(function (){ if($.trim($(this).val()) !== ''){ $(this).addClass('has-content') } else { $(this).removeClass('has-content') } })
                        $('#name_edit_event').change(function (){ if($(this).val() !== ''){ $(this).focus() } })
                        $('#start-date-icon').on('click', function () { $('#date_edit_event').focus(); });
                        $('#date_edit_event').datepicker({ format: 'yyyy-mm-dd', autoclose: false, setDate: new Date() }).on('changeDate', function (ev) { $(this).focus(); });
                        $("#datetime_edit_event").datetimepicker({format: 'HH:mm' });
                        $("#datetime_end_edit_event").datetimepicker({format: 'HH:mm' });
                    }
                });
            }

            function saveChangesEditEvent(id) {
                let pass = true,
                    empty = false,
                    name = $.trim($('#name_edit_event').val()),
                    description = $.trim($('#description_edit_event').val()),
                    dateStart = $.trim($('#date_edit_event').val()),
                    timeStart = $.trim($('#datetime_edit_event').val()),
                    dateEnd = $.trim($('#date_end_edit_event').val()),
                    timeEnd = $.trim($('#datetime_end_edit_event').val());

                empty = $('#name_edit_event').mValid({text: 'Nombre no debe quedar vacío.'}); if(empty){ pass = false}
                empty = $('#description_edit_event').mValid({text: 'Descripción no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#date_edit_event').mValid({text: 'Fecha de inicio no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#datetime_edit_event').mValid({text: 'Fecha de inicio no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#date_end_edit_event').mValid({text: 'Fecha de finalización no debe quedar vacía.'}); if(empty){ pass = false}
                empty = $('#datetime_end_edit_event').mValid({text: 'Fecha de finalización no debe quedar vacía.'}); if(empty){ pass = false}

                if (pass) {
                    $.ajax({
                        type: 'PUT',
                        url: '/put-edit-event',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id,
                            name,
                            description,
                            dateStart,
                            timeStart,
                            dateEnd,
                            timeEnd
                        },
                        success: (data) => {
                            getCalendarEvents();
                            getPendingEvents();
                            getHeldEvents();
                            $('.modal').modal('hide');
                            $("body").overhang({
                                type: "success",
                                message: "Exito! Se editó el evento exitosamente!"
                            });
                        }
                    });
                }
            }

            function message() {
                addMessage('', 'Titulo', 'Algo')
                $('#add_to_do').modal('hide');
            }

            getCalendarEvents();
            getPendingEvents();
            getHeldEvents();

            setTimeout(() => {
                getPendingEvents(); getHeldEvents()
                setInterval(() => { getPendingEvents(); getHeldEvents() }, 60000)
            }, 60000 - (new Date().getSeconds() * 1000));

        </script>
    </body>
</html>
