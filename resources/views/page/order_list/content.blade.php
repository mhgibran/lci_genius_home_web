<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Order List - {{Auth::User()->name}}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(\Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{\Session::get('success')}}
    </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Order</th>
                                <th>Order Date</th>
                                <th>Tenant Name</th>
                                <th>Order Item</th>
                                <th>Total Price</th>
                                <th>Status Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->no_order_menu_tenant}}</td>
                                <td>{{$item->tgl_order}}</td>
                                <td>{{$item->nama_unit_tenant}}</td>
                                <td>{{$item->nama_menu_unit_tenant}}</td>
                                <td>{{number_format($item->total_order)}}</td>
                                <td>{{$item->status_order}}</td>
                                <td width='20%'>
                                    <a href='/order_list/{{$item->id_order_menu_tenant}}'>
                                        <button type='button' class='btn btn-primary btn-xs'>View</button>
                                    </a>
                                    @if ($item->id_status_order == 1)
                                    <a href='/order_list/{{$item->id_order_menu_tenant}}/edit'>
                                        <button type='button' class='btn btn-warning btn-xs'>Edit</button>
                                    </a>
                                    <a href='/order_list/{{$item->id_order_menu_tenant}}/delete'>
                                        <button type='button' class='btn btn-danger btn-xs'>Cancel</button>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function rupiah($angka){	
	$hasil_harga = "Rp " . number_format($item->harga,2,',','.');
	return $hasil_rupiah; 
}
</script>
