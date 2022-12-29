<!-- basic scripts -->

<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write(
        "<script src='/template/assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");

</script>

<!-- Page scripts -->
<script src="/template/assets/js/chosen.jquery.min.js"></script>
<script src="/template/assets/js/bootstrap.min.js"></script>
<script src="/template/assets/js/jquery-ui.custom.min.js"></script>
<script src="/template/assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="/template/assets/js/bootstrap-datepicker.min.js"></script>
<script src="/template/assets/js/bootstrap.min.js"></script>
<script src="/template/assets/js/jquery.dataTables.min.js"></script>
<script src="/template/assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="/template/assets/js/dataTables.buttons.min.js"></script>
<script src="/template/assets/js/buttons.flash.min.js"></script>
<script src="/template/assets/js/buttons.html5.min.js"></script>
<script src="/template/assets/js/buttons.print.min.js"></script>
<script src="/template/assets/js/buttons.colVis.min.js"></script>
<script src="/template/assets/js/dataTables.select.min.js"></script>



<!-- ace scripts -->
<script src="/template/assets/js/ace-elements.min.js"></script>
<script src="/template/assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    var base_url = "http://127.0.0.1:8000";
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    jQuery(function ($) {

        //-----------------------------------------script tanggal -----------------------------------------//
        $('.date-picker').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true
        })

        $(document).one('ajaxloadstart.page', function (e) {
            autosize.destroy('textarea[class*=autosize]')

        });

        //-----------------------------------------script tabs -----------------------------------------//	
        $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            //if($(e.target).attr('href') == "#home") doSomethingNow();
        })

        //-----------------------------------------script combo box -----------------------------------------//
        $('.chosen-select').chosen({
            allow_single_deselect: true
        });
        //resize the chosen on window resize

        $(window)
            .off('resize.chosen')
            .on('resize.chosen', function () {
                $('.chosen-select').each(function () {
                    var $this = $(this);
                    $this.next().css({
                        'width': $this.parent().width()
                    });
                })
            }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function () {
                var $this = $(this);
                $this.next().css({
                    'width': $this.parent().width()
                });
            })
        });

        $('#chosen-multiple-style .btn').on('click', function (e) {
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
            else $('#form-field-select-4').removeClass('tag-input-style');
        });

        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if (ace.vars['touch'] && ace.vars['android']) {
            $('#tasks').on('touchstart', function (e) {
                var li = $(e.target).closest('#tasks li');
                if (li.length == 0) return;
                var label = li.find('label.inline').get(0);
                if (label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation();
            });
        }
        $('#tasks').sortable({
            opacity: 0.8,
            revert: true,
            forceHelperSize: true,
            placeholder: 'draggable-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            stop: function (event, ui) {
                //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                $(ui.item).css('z-index', 'auto');
            }
        });
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function () {
            if (this.checked) $(this).closest('li').addClass('selected');
            else $(this).closest('li').removeClass('selected');
        });


        //show the dropdowns on top or bottom depending on window height and menu position
        $('#task-tab .dropdown-hover').on('mouseenter', function (e) {
            var offset = $(this).offset();

            var $w = $(window)
            if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
                $(this).addClass('dropup');
            else $(this).removeClass('dropup');
        });

        /*
|--------------------------------------------------------------------------
| Notification Script
|--------------------------------------------------------------------------
|
*/
        $(document).ready(function () {
            getNewConcierge();
        });

        function getNewConcierge() {
            setInterval(function () {
                $.ajax({
                    type: 'GET',
                    url: '/new_concierge',
                    //data : '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['new_concierge'] !== 0) {
                            $('.concierge_badge').html(data['new_concierge']);
                        }
                        getNewComplain();
                    }
                });
            }, 1000);
        }

        function getNewComplain() {
            $.ajax({
                type: 'GET',
                url: '/new_complain',
                success: function (data) {
                    if (data['new_complain'] !== 0) {
                        $('.complain_badge').html(data['new_complain']);
                    }
                    getTotalBadge();
                }
            });
        }

        function getTotalBadge() {
            if ($('.concierge_badge').html() !== '') {
                var badge_concierge = parseInt($('.concierge_badge').html());
            } else {
                var badge_concierge = 0;
            }
            if ($('.complain_badge').html() !== '') {
                var badge_complain = parseInt($('.complain_badge').html());
            } else {
                var badge_complain = 0;
            }
            var total_badge = parseInt(badge_concierge + badge_complain);
            if (total_badge !== 0) {
                $('.total_badge').html(total_badge);
            }
        }

        $(function () {
            $(".ribuan").blur(function () {
                $(this).val(numberWithCommas($(this).val()));
            });

            $(".ribuan").focus(function () {
                $(this).val(removeCommas($(this).val()));
            })
        })

        

        function removeCommas(x) {
            return x.replace(/,/g, "");
        }

        String.prototype.removeCommas = function () {
            return removeCommas(this);
        };



    });

    $(function () {
        $('#datetimepicker1').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
    });

    $(function () {
        $('#datetimepicker2').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
    });

    $(function () {
        $('#datetimepicker3').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
    });

    $(function () {
        $('#datetimepicker4').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
    });

    $(function () {
        $('#datetimepicker5').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
    });

</script>
