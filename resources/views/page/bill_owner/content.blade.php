<div class="col-xs-12">
    <div class="width=auto">
        <h1 class="header smaller lighter blue">
            <center><b>BILL OWNER INFORMATION</b></center>
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
                <a href='/BillingExportExcel'>
                    <button id="export_button" type="button" class="btn btn-success">Export to Excel</button>
                </a>
                <a href='/BillingExportEfaktur'>
                    <button id="export_button" type="button" class="btn btn-success">Export E-Faktur Format</button>
                </a>
                <a href='#' onclick="invoiceSelected()">
                    <button id="print_button" type="button" class="btn btn-success">Print Selected Bill</button>
                </a>
                @endif
                <div class="pull-right tableTools-container">
                    <a href='#' onclick="SelectAll()" class="btn btn-success no-radius" title="Select All" data-placement="bottom">
                        <span>Select All</span>
                    </a>
                    <a href='#' onclick="deSelectAll()" class="btn btn-success no-radius" title="Deselect All" data-placement="bottom">
                        <span>Deselect All</span>
                    </a>
                    @if(Auth::user()->priv_status ==1 || Auth::user()->priv_status ==4 || Auth::user()->priv_status
                    ==5)
                    <a href='bill_owner/create' class="btn btn-success no-radius" title="Add New" data-placement="bottom">
                        <i class="ace-icon fa fa-plus"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">ID Billing</th>
                        <th class="center">Bill No.</th>
                        <th class="center">Unit Owner Name</th>
                        <th class="center">Unit No.</th>
                        <th class="center">Invoice Date</th>
                        <th class="center">Invoice Due Date</th>
                        <th class="center">Amount Of Bill</th>
                        <th class="center">Forfeit Fee Last Month</th>
                        <th class="center">Over Payment Last Month</th>
                        <th class="center">Status</th>
                        <th class="hidden-480"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="center">{{$item->id_billing_owner}}</td>
                        <td class="center">{{$item->kode_billing}}</td>
                        <td class="center">{{$item->nama_depan}}</td>
                        <td class="center">{{$item->kode_tower}}{{$item->no_floor}}{{$item->no_unit_apart}}</td>
                        <td class="center">{{$item->tgl_cetak}}</td>
                        <td class="center">{{$item->tgl_jatuh_tempo}}</td>
                        <td class="center">{{number_format($item->total_tagihan_all)}}</td>
                        <td class="center">{{number_format($item->total_denda)}}</td>
                        <td class="center">{{number_format($item->total_lebih_bayar)}}</td>
                        @if($item->sisa_tagihan == 0 || $item->total_tagihan_all < $item->jml_bayar)
                            <td class="center">PAID</td>
                        @else
                            <td class="center">OUTSTANDING</td>
                        @endif
                        <td class="center">
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" title="VIEW" data-placement="bottom" href='/bill_owner/{{$item->id_billing_owner}}'>
                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>
                                &nbsp;
                                @if(Auth::user()->priv_status == 1 && $item->sisa_tagihan > 0|| Auth::user()->priv_status == 4 && $item->sisa_tagihan > 0||
                                Auth::user()->priv_status == 5 && $item->sisa_tagihan > 0)
                                {{-- <a class="green" title="EDIT" data-placement="bottom" href='/bill_owner/{{$item->id_billing_owner}}/edit'>
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a> --}}
                                &nbsp;
                                @if($item->sisa_tagihan != 0)
                                <a href='/invoice/{{$item->id_billing_owner}}' title="CREATE INVOICE" data-placement="bottom">
                                    <i class="ace-icon fa fa-print bigger-130"></i>
                                </a>
                                &nbsp;
                                {{-- <a title="SET PAYMENT" data-placement="bottom" href='/bill_owner/{{$item->id_billing_owner}}/set_payment'
                                    target='_blank'>
                                    <i class="ace-icon fa fa-file bigger-130"></i>
                                </a>
                                &nbsp; --}}
                                <a href='/bill_owner/{{$item->id_billing_owner}}/delete' class="red" title="DELETE"
                                    data-placement="bottom">
                                    <i class="ace-icon fa fa-trash bigger-130"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-----------------------------------------script ------------------------------------>
<script type="text/javascript">

var myTable;
    jQuery(function ($) {
         myTable =
            $('#dynamic-table')
            .DataTable({
                bAutoWidth: true,
                "aoColumns": [{
                        "bSortable": true,
                        "visible": false
                    },
                    null, null, null, null, null, null, null, null, null,
                    {
                        "bSortable": false
                    }
                ],
                "aaSorting": [],
                select: {
                    style: 'multi',
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
                    "extend": "print",
                    "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    autoPrint: false
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
    function invoiceSelected(){
        data = myTable.rows( { selected: true } ).data();
        let temp = [];
        $.each(data,function(a,b){
            temp.push(b[0]);
        })
        let res = temp.join(",");
        window.location = "multi_invoice/" + res;
    }

    function SelectAll(){
        myTable.rows().select();
    }

    function deSelectAll(){
        myTable.rows().deselect();
    }
</script>
