<div class="col-xs-12">
    <div class="width=auto">
        <h1 class="header smaller lighter blue">
            <center><b>TENANT LIST INFORMATION</b></center>
        </h1>
        @if(\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{\Session::get('success')}}
        </div>
        @endif
        <div class="clearfix">
            <div class="pull-right tableTools-container">
                <a href='unit_tenant/create' class="btn btn-success no-radius" title="Add New" data-placement="bottom">
                    <i class="ace-icon fa fa-plus"></i>
                </a>
            </div>
        </div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">Tenant Code</th>
                        <th class="center">Tenant Company Name</th>
                        <th class="center">Tenant Name</th>
                        <th class="center">Telp. No</th>
                        <th class="center">Fax No</th>
                        <th class="center">Email</th>
                        <th class="hidden-480"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="center">{{$item->kode_unit_tenant}}</td>
                        <td class="center">{{$item->nama_perusahaan_unit_tenant}}</td>
                        <td class="center">{{$item->nama_unit_tenant}}</td>
                        <td class="center">{{$item->no_telp}}</td>
                        <td class="center">{{$item->no_fax}}</td>
                        <td class="center">{{$item->email}}</td>
                        <td class="center">
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" title="VIEW" data-placement="bottom" href='/unit_tenant/{{$item->id_unit_tenant}}'>
                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>
                                &nbsp;
                                <a class="green" title="EDIT" data-placement="bottom" href='/unit_tenant/{{$item->id_unit_tenant}}/edit'>
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                &nbsp;
                                <a class="red" title="DELETE" data-placement="bottom" href='/unit_tenant/{{$item->id_unit_tenant}}/delete'>
                                    <i class="ace-icon fa fa-trash bigger-130"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                    "sScrollX": "100%",
                    "sScrollXInner": "120%",
                    "bScrollCollapse": true,
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

    </script>
