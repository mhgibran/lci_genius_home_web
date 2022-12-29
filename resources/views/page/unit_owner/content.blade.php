<div class="col-xs-12">
    <div class="width=auto">
        <h1 class="header smaller lighter blue">
            <center><b>OWNER LIST INFORMATION</b></center>
        </h1>
        @if(\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{\Session::get('success')}}
        </div>
        @endif
        <div class="clearfix">
            <div class="pull-right tableTools-container">
                <a href='unit_owner/create' class="btn btn-success no-radius" title="Add New" data-placement="bottom">
                    <i class="ace-icon fa fa-plus"></i>
                </a>
                <!-- <form id="upload_form" action="/UnitOwnerImportExcel" method="post" enctype="multipart/form-data"
                    style="display: inline-block;">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <input type="file" id="upload" name="upload" style="font-size: 30px; background: green; display: none;">
                    <button class="btn btn-primary" type="button" onclick="upl_click()">Upload File</button>
                </form> -->
            </div>
        </div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">Unit No</th>
                        <th class="center">Unit Owner Name</th>
                        <th class="center">Gender</th>
                        <th class="center">Birthdate</th>
                        <th class="center">Nationality</th>
                        <th class="center">Telp No</th>
                        <th class="center">Handphone No</th>
                        <th class="center">Email</th>
                        <th class="hidden-480"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="center">{{$item->kode_tower}}{{$item->no_floor}}{{$item->no_unit_apart}}</td>
                        <td class="center">{{$item->nama_title}} {{$item->nama_depan}}</td>
                        <td class="center">{{$item->nama_gender}}</td>
                        <td class="center">{{$item->tgl_lahir}}</td>
                        <td class="center">{{$item->nama_country}}</td>
                        <td class="center">{{$item->no_telp}}</td>
                        <td class="center">{{$item->no_hp}}</td>
                        <td class="center">{{$item->email}}</td>
                        <td class="center">
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" title="VIEW" data-placement="bottom" href='/unit_owner/{{$item->id_unit_owner}}'>
                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>
                                &nbsp;
                                <a class="green" title="EDIT" data-placement="bottom" href='/unit_owner/{{$item->id_unit_owner}}/edit'>
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                &nbsp;
                                <a class="red" title="DELETE" data-placement="bottom" href='/unit_owner/{{$item->id_unit_owner}}/delete'>
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
                    null, null, null, null, null, null, null,
                    {
                        "bSortable": false
                    }
                ],
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
    function upl_click() {
            $("#upload").click()
        }
    $(function () {
        $("#upload").change(function () {
            $("#upload_form").submit();
        });
    });

</script>
