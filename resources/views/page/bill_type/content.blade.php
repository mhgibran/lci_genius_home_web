<div class="col-xs-12">
    <div class="width=auto">
        <h1 class="header smaller lighter blue">
            <center><b>BILL TYPE INFORMATION</b></center>
        </h1>
        @if(\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{\Session::get('success')}}
        </div>
        @endif
        <div class="clearfix">
            <div>
                <div class="pull-right tableTools-container">
                </div>
            </div>
        </div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
                    <tr>
                        <th class="center">Bill Type Name</th>
                        <th class="center">Charge</th>
                        <th class="hidden-480"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="center">{{$item->nama_bill_type}}</td>
                        <td class="center">{{number_format($item->harga_tarif)}}</td>
                        <td class="center">
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" title="EDIT" data-placement="bottom" href='/bill_type/{{$item->id_bill_type}}/edit'>
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
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
                bAutoWidth: true,
                "aoColumns": [{
                        "bSortable": true
                    },
                    null, 
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
