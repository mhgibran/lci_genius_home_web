<div class="col-xs-12">
    <div class="width=auto">
        <h1 class="header smaller lighter blue">
            <center><b>PAYMENT OWNER LIST</b></center>
        </h1>
        @if(\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{\Session::get('success')}}
        </div>
        @endif
        <div class="clearfix">
            <div class="pull-right tableTools-container">
                <!-- @if(Auth::user()->priv_status ==1 || Auth::user()->priv_status ==4 || Auth::user()->priv_status ==5)
                <a href='payment_owner/create' class="btn btn-success no-radius" title="Add New" data-placement="bottom">
                    <i class="ace-icon fa fa-plus"></i>
                </a>
                @endif -->
            </div>
        </div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">Payment No.</th>
                        <th class="center">Billing No.</th>
                        <th class="center">Unit No.</th>
                        <th class="center">Amount of Bill</th>
                        <th class="center">Payment Date</th>
                        <th class="center">Paid</th>
                        <th class="hidden-480"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="center">{{$item->kode_payment}}</td>
                        <td class="center">{{$item->kode_billing}}</td>
                        <td class="center">{{$item->kode_tower}}{{$item->no_floor}}{{$item->no_unit_apart}}</td>
                        <td class="center">{{number_format($item->total_tagihan_all)}}</td>
                        <td class="center">{{$item->periode_bayar}}</td>
                        <td class="center">{{number_format($item->jml_bayar)}}</td>
                        <td class="center">
                            <div class="hidden-sm hidden-xs action-buttons">
                            <a href='/receipt/{{$item->id_payment_owner}}' title="CREATE RECEIPT" data-placement="bottom">
                                    <i class="ace-icon fa fa-print bigger-130"></i>
                                </a>
                                &nbsp;
                            </div>
                        </td>
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
                    bAutoWidth: false,
                    "aoColumns": [{
                            "bSortable": true
                        },
                            null, null, null, null, null,
                        {
                            "bSortable": false
                        }
                    ],
                    "aaSorting": [],

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
