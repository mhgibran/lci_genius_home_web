<div class="col-xs-12">
    <div class="width=auto">
        <h1 class="header smaller lighter blue">
            <center><b>WATER METER INFORMATION</b></center>
        </h1>
        @if(\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{\Session::get('success')}}
        </div>
        @endif
        <div class="clearfix">
            <div>
                @if(Auth::user()->priv_status ==1 || Auth::user()->priv_status == 8 || Auth::user()->priv_status == 9)
                <a href='/WaterMeterExportExcel'>
                    <button id="export_button" type="button" class="btn btn-success">Export to Excel</button>
                </a>
                <form id="upload_form" action="/WaterMeterImportExcel" method="post" enctype="multipart/form-data"
                    style="display: inline-block;">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <input type="file" id="upload" name="upload" style="font-size: 30px; background: green; display: none;">
                    <button class="btn btn-primary" type="button" onclick="upl_click()">Upload File</button>
                </form>
                @endif
            </div>
        </div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">Unit Number</th>
                        <th class="center">Start Meter</th>
                        <th class="center">End Meter</th>
                        <th class="center">Total Usage</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="center">{{$item->kode_tower}}{{$item->no_floor}}{{$item->no_unit_apart}}</td>
                        <td class="center">{{$item->air_awal}}</td>
                        <td class="center">{{$item->air_akhir}}</td>
                        <td class="center">{{$item->pemakaian_air}}</td>
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
                        null, null,
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

        function upl_click() {
            $("#upload").click()
        }
        $(function () {
            $("#upload").change(function () {
                $("#upload_form").submit();
            });
        });

    </script>
