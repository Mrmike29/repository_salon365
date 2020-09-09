
<div class="modal fade admin-query" id="universal_modal"></div>

<!-- ================End Footer Area ================= -->
<script type="text/javascript" src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jquery.data-tables.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/buttons.flash.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/buttons.print.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/dataTables.rowReorder.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/dataTables.responsive.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/buttons.colVis.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/popper.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/nice-select.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jquery.magnific-popup.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/fastselect.standalone.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/raphael-min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/morris.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/ckeditor.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/ckeditor.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/bootstrap_datetimepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/fullcalendar.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/fullcalendar-lang-es.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/main.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/registration_custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/developer.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/overhang.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/socket.io.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/message.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
<script src="<?php echo e(asset('js/froala_editor.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/application-18caf78ea729799d396faaacacecde7c.js')); ?>"></script>
<script src="<?php echo e(asset('js/goova-template.js')); ?>"></script>
<script type="text/javascript">

    function universalModal(title, body, footer = "") {
        let html =
            '<div class="modal-dialog modal-dialog-centered">' +
                '<div class="modal-content">' +
                    '<div class="modal-header">' +
                        '<h4 class="modal-title">' + title + '</h4>' +
                        '<button type="button" class="close" data-dismiss="modal">×</button>' +
                    '</div>' +
                    '<div class="modal-body" style="height: 355px; overflow-y: auto;">' +
                        body +
                    '</div>' +
                    '<div class="modal-footer">' +
                        footer +
                    '</div>' +
                '</div>' +
            '</div>'
        $('#universal_modal').html(html).modal('show');
    }
</script>
<script type="text/javascript">
    //$('table').parent().addClass('table-responsive pt-4');
    // for select2 multiple dropdown in send email/Sms in Individual Tab
    $("#selectStaffss").select2();
    $("#checkbox").click(function () {
        if ($("#checkbox").is(':checked')) {
            $("#selectStaffss > option").prop("selected", "selected");
            $("#selectStaffss").trigger("change");
        } else {
            $("#selectStaffss > option").removeAttr("selected");
            $("#selectStaffss").trigger("change");
        }
    });
    <?php if(!empty($_SESSION['sala'])): ?>
        window.location.href = "https://goova.co/ingresar/sala/<?php echo e($_SESSION['sala']); ?>";
    <?php endif; ?>

    // for select2 multiple dropdown in send email/Sms in Class tab
    $("#selectSectionss").select2();
    $("#checkbox_section").click(function () {
        if ($("#checkbox_section").is(':checked')) {
            $("#selectSectionss > option").prop("selected", "selected");
            $("#selectSectionss").trigger("change");
        } else {
            $("#selectSectionss > option").removeAttr("selected");
            $("#selectSectionss").trigger("change");
        }
    });


</script>
<script>
    $('.close_modal').on('click', function() {
        $('.custom_notification').removeClass('open_notification');
    });
    $('.notification_icon').on('click', function() {
        $('.custom_notification').addClass('open_notification');
    });
    $(document).click(function(event) {
        if (!$(event.target).closest(".custom_notification").length) {
            $("body").find(".custom_notification").removeClass("open_notification");
        }
    });



</script>
<script src="<?php echo e(asset('js/search.js')); ?>"></script>
<script type="text/javascript"></script>
<script type="text/javascript">
    function barChart(idName) {
        window.barChart = Morris.Bar({
            element: 'commonBarChart',
            data: [ { day: '01', income: 0, expense:0 },{ day: '02', income: 0, expense:0 },{ day: '03', income: 0, expense:0 },{ day: '04', income: 0, expense:0 },{ day: '05', income: 0, expense:0 },{ day: '06', income: 0, expense:0 },{ day: '07', income: 0, expense:0 },{ day: '08', income: 0, expense:0 },{ day: '09', income: 200, expense:0 },{ day: '10', income: 574, expense:0 },{ day: '11', income: 0, expense:0 },{ day: '12', income: 324, expense:0 },{ day: '13', income: 300, expense:0 },{ day: '14', income: 0, expense:0 },{ day: '15', income: 0, expense:0 },{ day: '16', income: 300, expense:150 },{ day: '17', income: 200, expense:0 },{ day: '18', income: 929, expense:0 },{ day: '19', income: 2638, expense:0 },{ day: '20', income: 1100, expense:0 },{ day: '21', income: 4100, expense:0 },{ day: '22', income: 1000, expense:0 },{ day: '23', income: 0, expense:0 },{ day: '24', income: 4661, expense:0 },{ day: '25', income: 0, expense:0 },{ day: '26', income: 0, expense:0 },{ day: '27', income: 0, expense:0 }, ],
            xkey: 'day',
            ykeys: ['income', 'expense'],
            labels: ['Income', 'Expense'],
            barColors: ['#8a33f8', '#f25278'],
            resize: true,
            redraw: true,
            gridTextColor: 'var(--g-second)',
            gridTextSize: 12,
            gridTextFamily: '"Poppins", sans-serif',
            barGap: 4,
            barSizeRatio: 0.3
        });
    }



    const monthNames = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];

    function areaChart() {
        window.areaChart = Morris.Area({
            element: 'commonAreaChart',
            data: [ { y: '01', income: 0, expense:0 },{ y: '02', income: 0, expense:0 },{ y: '03', income: 0, expense:0 },{ y: '04', income: 0, expense:0 },{ y: '05', income: 0, expense:0 },{ y: '06', income: 0, expense:0 },{ y: '07', income: 16326, expense:119263 }, ],
            xkey: 'y',
            parseTime: false,
            ykeys: ['income', 'expense'],
            labels: ['Income', 'Expense'],
            xLabelFormat: function (x) {
                var index = parseInt(x.src.y);
                return monthNames[index];
            },
            xLabels: "month",
            labels: ['Income', 'Expense'],
            hideHover: 'auto',
            lineColors: ['rgba(124, 50, 255, 0.5)', 'rgba(242, 82, 120, 0.5)'],
        });
    }

</script>
<script type="application/javascript" id="global_js_goova">
    location.pathname.substr(1) !== '' ? (($('#' + location.pathname.substr(1)).length != 0) ? $('#' + location.pathname.substr(1)).addClass('active') : $('[href="/' + location.pathname.substr(1) + '"]').parent('li').parent('ul.list-unstyled').siblings('a.dropdown-toggle').addClass('active') , $(".dropdown-toggle.active").click(), $('[href="/' + location.pathname.substr(1) + '"]').addClass('active')) : $('#admin-dashboard').addClass('active');
    let elmts, uls = $('nav#sidebar').find($("ul.collapse.list-unstyled"));
    for (let i = 0; i < uls.length; i++) { elmts = $('#' + uls[i].attributes["id"].nodeValue).find($('li').children('a.active')); if(elmts.length > 0){ $('[href="#' + uls[i].attributes["id"].nodeValue + '"]').addClass('active'); $(".dropdown-toggle.active").click(); $('#' + uls[i].attributes["id"].nodeValue).find('a.dropdown-toggle.collapsed').click(); i = uls.length; }}
</script>

<?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/includes/footer.blade.php ENDPATH**/ ?>