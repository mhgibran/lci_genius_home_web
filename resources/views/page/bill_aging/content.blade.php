<div class="col-xs-12">
    <div class="width=auto">
        <h1 class="header smaller lighter blue">
            <center><b>BILL AGING INFORMATION</b></center>
        </h1>
        @if(\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{\Session::get('success')}}
        </div>
        @endif
        <div class="clearfix">
            <div>
                @if(Auth::user()->priv_status ==1 || Auth::user()->priv_status ==4 || Auth::user()->priv_status ==5)
                <a href='/BillingAgingExportExcel'>
                    <button id="export_button" type="button" class="btn btn-success">Export to Excel</button>
                </a>
                @endif
                <div class="pull-right tableTools-container">
                    <!-- @if(Auth::user()->priv_status ==1 || Auth::user()->priv_status ==4 || Auth::user()->priv_status
                    ==5)
                    <a href='bill_owner/create' class="btn btn-success no-radius" title="Add New" data-placement="bottom">
                        <i class="ace-icon fa fa-plus"></i>
                    </a>
                    @endif -->
                </div>
            </div>
        </div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">Unit Owner Name</th>
                        <th class="center">
                            <= 0 Days</th> <th class="center">1 - 30 Days
                        </th>
                        <th class="center">31 - 60 Days</th>
                        <th class="center">61 - 90 Days</th>
                        <th class="center">3 Months</th>
                        <th class="center">Outstanding Amount</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->nama_title}}. {{$item->nama_depan}} {{$item->nama_belakang}}</td>
                        <td class="center">{{number_format($item->type1)}}</td>
                        <td class="center">{{number_format($item->type2)}}</td>
                        <td class="center">{{number_format($item->type3)}}</td>
                        <td class="center">{{number_format($item->type4)}}</td>
                        <td class="center">{{number_format($item->type5)}}</td>
                        <td class="center">{{number_format($item->typeall)}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-----------------------------------------script ------------------------------------>
<script type="text/javascript">
    jQuery(function ($) {
        var myTable =
            $('#dynamic-table')
            .DataTable({
                bAutoWidth: true,
                "aoColumns": [{
                        "bSortable": true
                    },
                    null, null, null, null, null,
                    {
                        "bSortable": false
                    }
                ],
                "aaSorting": [],
                "aaSorting": [],
                "sScrollX": "100%",
                "sScrollXInner": "120%",
                "bScrollCollapse": true,
                select: {
                    style: 'multi'
                }
            });
        $.fn.dataTable.Buttons.defaults.dom.container.className =
            'dt-buttons btn-overlap btn-group btn-overlap';

        new $.fn.dataTable.Buttons(myTable, {
            buttons: [{
                    "extend": "colvis",
                    "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    columns: ':not():not(:last)'
                },
                {
                    // "extend": "print",
                    // "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                    // "className": "btn btn-white btn-primary btn-bold",
                    // autoPrint: false
                }
            ]
        });
        myTable.buttons().container().appendTo($('.tableTools-container'));
        //style the message box
        var defaultCopyAction = myTable.button(1).action();
        myTable.button(1).action(function (e, dt, button, config) {
            defaultCopyAction(e, dt, button, config);
            $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
        });
        var defaultColvisAction = myTable.button(0).action();
        myTable.button(0).action(function (e, dt, button, config) {
            defaultColvisAction(e, dt, button, config);
            if ($('.dt-button-collection > .dropdown-menu').length == 0) {
                $('.dt-button-collection')
                    .wrapInner(
                        '<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />'
                    )
                    .find('a').attr('href', '#').wrap("<li />")
            }
            $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
        });
        setTimeout(function () {
            $($('.tableTools-container')).find('a.dt-button').each(function () {
                var div = $(this).find(' > div').first();
                if (div.length == 1) div.tooltip({
                    container: 'body',
                    title: div.parent().text()
                });
                else $(this).tooltip({
                    container: 'body',
                    title: $(this).text()
                });
            });
        }, 500);
    });

</script>
