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
                                        <div class="white-box">
                                            <div class="common-calendar fc fc-unthemed fc-ltr">
                                                <div class="fc-toolbar fc-header-toolbar">

                                                </div>
                                            </div>
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

                                        <a href="#" data-toggle="modal" class="primary-btn small fix-gr-bg" data-target="#add_to_do" title="Add To Do" data-modal-size="modal-md">
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

                                            <div class="toDoList">
                                                <?php foreach ($dates as $date){
                                                    $date1 = new DateTime($date->date); $date1 = $date1->format('Y-m-d');
                                                    if (date('Y-m-d') < $date1) {
                                                ?>

                                                    <div class="single-to-do d-flex justify-content-between toDoList" id="to_do_list_div26">
                                                        <div onclick="openModal(1)" style="cursor: pointer;">
                                                            <h5 class="d-inline"><?= $date->name ?></h5>
                                                            <p>
                                                                <?= $date1 ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php } } ?>

                                            </div>


                                            <div class="toDoListsCompleted" style="display: none;">
                                                <?php foreach ($dates as $date){
                                                    $date1 = new DateTime($date->date); $date1 = $date1->format('Y-m-d');
                                                    if (date('Y-m-d') > $date1) {
                                                ?>
                                                    <div class="single-to-do d-flex justify-content-between" id="to_do_list_div1">
                                                        <div>
                                                            <h5 class="d-inline"><?= $date->name ?></h5>
                                                            <p class="">
                                                                <?= $date1 ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php } } ?>
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
            $(document).ready(function() {
                window.onbeforeunload = Call;

                function Call() {
                    return $.ajax({
                        type: 'GET',
                        async: false,
                        url: '/prueba',
                        data: 'id=1'
                    });
                }
            });

            function openModal(){

                $.ajax({
                    type: 'GET',
                    async: false,
                    url: '/prueba',
                    data: 'id=1'
                });
                let html =
                    '<div class="container-fluid">' +
                        '<div class="row">' +
                            '<div class="col-lg-12">' +
                                '<div class="row mt-25">' +
                                    '<div class="col-lg-12" id="sibling_class_div">' +
                                        '<div class="input-effect">' +
                                            '<input class="primary-input form-control" type="text" name="todo_title" id="todo_title">' +
                                            '<label>' +
                                                'To Do Title *<span></span> ' +
                                            '</label>' +
                                            '<span class="focus-border"></span>' +
                                            '<span class="modal_input_validation red_alert"></span>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="row mt-30">' +
                                    '<div class="col-lg-12" id="">' +
                                        '<div class="no-gutters input-right-icon">' +
                                            '<div class="col">' +
                                                '<div class="input-effect">' +
                                                    '<input class="read-only-input primary-input date form-control" id="startDate" type="text" autocomplete="off" readonly="true" name="date" value="07/27/2020">' +
                                                    '<label>' +
                                                        'Date <span></span> ' +
                                                    '</label>' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="col-auto">' +
                                                '<button class="" type="button">' +
                                                    '<i class="ti-calendar" id="start-date-icon"></i>' +
                                                '</button>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-12 text-center">' +
                                    '<div class="mt-40 d-flex justify-content-between">' +
                                        '<button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>' +
                                        '<a class="primary-btn small fix-gr-bg" onclick="message()">' +
                                            '<span class="ti-plus pr-2"></span>' +
                                            'ar' +
                                        '</a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
                universalModal('title', html)
            }

            function message() {
                addMessage('', 'Titulo', $('#todo_title').val())
                $('#add_to_do').modal('hide');
            }
        </script>
    </body>
</html>
