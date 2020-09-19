<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body class="admin">
		<div class="main-wrapper">
    		<!-- Sidebar  -->
    		@include('includes.sidebar')
            <div id="main-content">
    		    @include('includes.header')
                <section class="sms-breadcrumb mb-40 white-box">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <div class="main-title">
                                    <h1>Areas</h1>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#!" class="primary-btn small goova-bt create_area" data-toggle="tooltip" title="" data-original-title="Agregar Area">
                                    <span class="ti-plus"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="show-table" class="admin-visitor-area up_st_admin_visitor mt-40">
                    <div class="container-fluid p-0">
                        <div class="row m-0">
                            <div class="p-0 col-md-12">
                                <div class="white-box mt-10">
                                    <table id="table_users" class="school-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th class="noExport">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="modal fade admin-query" id="CreateAreas" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">CREAR AREA</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <div class="row no-gutters input-right-icon">
                                <div class="col">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control" type="text" name="name" value="" required>
                                        <label>Nombre <span>*</span></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancelar</button>
                            <button class="primary-btn goova-bt" id="submit">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade admin-query" id="EditAreas" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">EDITAR AREA</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="">
                            <div class="row no-gutters input-right-icon">
                                <div class="col">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control" type="text" name="name" value="" required>
                                        <label>Nombre <span>*</span></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancelar</button>
                            <button class="primary-btn goova-bt" id="submit">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
        <script>
            var table = $('#table_users').DataTable({
                            bLengthChange: false,
                            processing: true,
                            language: {
                                search: "<i class='ti-search'></i>",
                                searchPlaceholder: 'Búsqueda rápida',
                                decimal: ",",
                                thousands: ".",
                                info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                                infoPostFix: "",
                                infoFiltered: "(filtrado de un total de _MAX_ registros)",
                                loadingRecords: "Cargando...",
                                lengthMenu: "Mostrar _MENU_ registros",
                                paginate: {
                                    first: "Primero",
                                    last: "Último",
                                    next: "Siguiente",
                                    previous: "Anterior"
                                },
                                processing: "Procesando...",
                                zeroRecords: "No se encontraron resultados",
                                emptyTable: "Ningún dato disponible en esta tabla",
                                aria: {
                                    sortAscending:  ": Activar para ordenar la columna de manera ascendente",
                                    sortDescending: ": Activar para ordenar la columna de manera descendente"
                                }
                            },
                            ajax: {
                                url: "/view_areas",
                                dataSrc: ""
                            },
                            columns: [
                                { data: "name" },
                                { 
                                    data: "id",
                                    render: function (data, type, row, meta) {
                                        return  `<div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        Seleccionar
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item edit_area" data-id="${data}" href="#!">Editar</a>
                                                    </div>
                                                </div>`
                                    }
                                }
                            ],
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'copyHtml5',
                                    text: '<i class="fa fa-files-o"></i>',
                                    titleAttr: 'Copiar',
                                    title : $("#logo_title").val(),
                                    exportOptions: {
                                        columns: ':visible',
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel-o"></i>',
                                    titleAttr: 'Excel',
                                    title : $("#logo_title").val(),
                                    exportOptions: {
                                        columns: ':visible',
                                        order: 'applied'
                                    }
                                },
                                {
                                    extend: 'csvHtml5',
                                    text: '<i class="fa fa-file-text-o"></i>',
                                    titleAttr: 'CSV',
                                    title : $("#logo_title").val(),
                                    exportOptions: {
                                        columns: ':visible',
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"></i>',
                                    titleAttr: 'PDF',
                                    exportOptions: {
                                        columns: "thead th:not(.noExport)",
                                        order: 'applied',
                                        columnGap: 20
                                    },
                                    pageSize: 'A4',
                                    fontSize:10,
                                    alignment: 'center',
                                    header: true,
                                    title : $("#logo_title").val(),
                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i>',
                                    titleAttr: 'Imprimir',
                                    title : $("#logo_title").val(),
                                    exportOptions: {
                                        columns: ':visible',
                                    }
                                },
                                {
                                    extend: 'colvis',
                                    text: '<i class="fa fa-columns"></i>',
                                    postfixButtons: ['colvisRestore']
                                }
                            ],
                            columnDefs: [{
                                visible: false
                            }],
                            responsive: true,
                        });
            $(document).on('click','a.create_area',function(){
                $('#CreateAreas').modal('show')
            })
            $(document).on('click','#CreateAreas button#submit',function(){
                $.ajax({
                    url: '/store_areas',
                    type: 'post',
                    data: $('#CreateAreas form').serialize(),
                    success:function(dato){
                        table.ajax.reload()
                        $('#CreateAreas').modal('hide')
                    }
                })
            })
            $(document).on('click','a.edit_area',function(){
                var id = $(this).data('id')
                $.ajax({
                    url: '/edit_area/'+id,
                    type: 'get',
                    success:function(dato){
                        $('#EditAreas form input[name=id]').val(dato.id)
                        $('#EditAreas form input[name=name]').val(dato.name)
                        $('#EditAreas').modal('show')
                    }
                })
            })
            $(document).on('click','#EditAreas button#submit',function(){
                $.ajax({
                    url: '/update_area',
                    type: 'post',
                    data: $('#EditAreas form').serialize(),
                    success:function(dato){
                        table.ajax.reload()
                        $('#EditAreas').modal('hide')
                    }
                })
            })
        </script>
    </body>
</html>