<div class="col-xs-12">
    <div class="page-header">
        <h1 class="green">
            <i class="ace-icon fa fa-angle-double-right"></i>
            BILL DETAIL
            <i class="ace-icon fa fa-angle-double-left"></i>
            <a href='/bill_owner' class="btn  btn-yellow btn-sm pull-right" type="submit">
                <i class="ace-icon fa fa-times"></i>
                CLOSE
            </a>
        </h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <form id="form_bill" name="fbill" method="post" action="{{url('/bill_owner/save_payment/'.$id)}}">
                @csrf
                <input type="hidden" name="status" id="status" value="1" />  

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bill No.</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{$bill_owner->kode_billing}}</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Invoice Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{$bill_owner->tgl_cetak}}</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Due Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{$bill_owner->tgl_jatuh_tempo}}</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Grace Periode</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{$bill_owner->tgl_grace_periode}}</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Occupant</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{$data_unit_owner->namaPenghuni}}</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit Number</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{$data_unit_owner->kode_tower}}{{$data_unit_owner->no_floor}}{{$data_unit_owner->no_unit_apart}}</label>
                        </div>
                    </div>
                </div>

                <hr style='border: 1px solid grey;'/>

                <h4>Billing Detail</h4>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Electricity</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{number_format($bill_owner->total_tagihan)}}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Water</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{number_format($bill_owner->total_tagihan_air)}}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SC, PBB, etc</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{number_format($bill_owner->jml_sc_ikkl)}} | ({{$bill_owner->keterangan_sc_ikkl}})</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Stamp Fee</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{number_format($bill_owner->biaya_materai)}}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Forfeit Fee Last Month</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{number_format($denda)}}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Over Payment Last Month</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{number_format($lebih_bayar)}}</label>
                        </div>
                    </div>
                </div>

                <hr style='border: 1px solid grey;'/>
                <div class="row">
                    <div class="col-xs-6 col-md-4 bold"><h5>Total Billing: {{number_format($bill_owner->total_tagihan_all + $denda)}}</h5></div>
                    @if($bill_owner->sisa_tagihan != 0)
                    <div class="col-xs-6 col-md-4 bold"><h5>Total Paid: {{number_format($bill_owner->jml_bayar)}}</h5></div>
                    <div class="col-xs-6 col-md-4 bold"><h5>Bill Remain: {{number_format($bill_owner->total_tagihan_all - $bill_owner->jml_bayar + $denda )}}</h5></div>
                    @else
                    <div class="col-xs-6 col-md-4 bold"><h5>Total Paid: {{number_format($bill_owner->jml_bayar)}}</h5></div>
                    <div class="col-xs-6 col-md-4 bold"><h5>Bill Remain: {{number_format($bill_owner->sisa_tagihan)}}</h5></div>
                    @endif
                </div>
                <hr style='border: 1px solid grey;'/>
            </form>
        </div>
    </div>
</div>
<!-- @include('page.' . $module . '.script_add')
<div class="page-header">
        <h1 class="green">
            <i class="ace-icon fa fa-angle-double-right"></i>
            BILL DETAIL
            <i class="ace-icon fa fa-angle-double-left"></i>
            <a href='/bill_owner' class="btn  btn-yellow btn-sm pull-right" type="submit">
                <i class="ace-icon fa fa-times"></i>
                CLOSE
            </a>
        </h1>
    </div>
/.page-header
<div class="col-xs-12">
PAGE CONTENT BEGINS
    <form id="form_bill" name="fbill" method="post" action="{{url('/bill_owner/save_payment/'.$id)}}">
            @csrf
            <input type="hidden" name="status" id="status" value="1" />        
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bill No.</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{$bill_owner->kode_billing}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Invoice Date</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{$bill_owner->tgl_cetak}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Due Date</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{$bill_owner->tgl_jatuh_tempo}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Grace Periode</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{$bill_owner->tgl_grace_periode}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Occupant</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{$data_unit_owner->namaPenghuni}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit Number</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{$data_unit_owner->kode_tower}}{{$data_unit_owner->no_floor}}{{$data_unit_owner->no_unit_apart}}</label>
                    </div>
                </div>
            </div>
            <hr style='border: 1px solid grey;'/>
            <h4>Billing Detail</h4>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Electricity</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{number_format($bill_owner->total_tagihan)}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Water</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{number_format($bill_owner->total_tagihan_air)}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SC, PBB, etc</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{number_format($bill_owner->jml_sc_ikkl)}} | ({{$bill_owner->keterangan_sc_ikkl}})</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Stamp Fee</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{number_format($bill_owner->biaya_materai)}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Forfeit Fee Last Month</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{number_format($denda)}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Over Payment Last Month</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>{{number_format($lebih_bayar)}}</label>
                    </div>
                </div>
            </div>
            <hr style='border: 1px solid grey;'/>
            <table width="1200px">
                <thead>
                    <tr >
                        <th>Total Billing: {{number_format($bill_owner->total_tagihan_all + $denda)}}</th>

                        @if($bill_owner->sisa_tagihan != 0)
                            <th>Total Paid: {{number_format($bill_owner->jml_bayar)}}</th>
                            <th>Bill Remain: {{number_format($bill_owner->total_tagihan_all - $bill_owner->jml_bayar + $denda )}}</th>
                        @else
                            <th>Total Paid: {{number_format($bill_owner->jml_bayar)}}</th>
                            <th>Bill Remain: {{number_format($bill_owner->sisa_tagihan)}}</th>
                        @endif

                    </tr>
                </thead>
            </table>
            <hr style='border: 1px solid grey;'/>
            <h4>Payment Data</h4>
            @if($bill_owner->sisa_tagihan != 0)
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalPayment">Add Payment</button><hr/>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Payment No.</th>
                        <th>Payment Date</th>
                        <th>Amount Paid</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payment_owner as $value)
                    <tr>
                        <td>{{$value->kode_payment}}</td>
                        <td>{{$value->periode_bayar}}</td>
                        <td>{{number_format($value->jml_bayar)}}</td>
                        <td>{{$value->keterangan}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
            {{-- @if(!empty($payment_owner))
                <h4>Last Payment</h4>
                <hr>
            @endif
            @foreach($payment_owner as $value)
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Payment Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{$value->tgl_bayar}}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount of Payment<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{$value->jml_bayar}}</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{$value->keterangan}}</label>
                        </div>
                    </div>
                </div>    
                <hr>
            @endforeach
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Payment Date<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12 input-group date" id='datetimepicker1'>
                        <input type='text' id="tgl_lahir" name="tgl_bayar" required="required" class="form-control col-md-7 col-xs-12" style="margin-left: 9px;" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>          
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount of Payment<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="ribuan" name="jml_bayar" value="">
                    </div>

                </div>
            </div>
            <br>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="description" name="descriptionPay" required="required" class="form-control col-md-7 col-xs-12 noresize"
                                    rows="2" style="margin-left: -90px;">
                        </textarea>
                    </div>
                </div>
            </div>--}}
            <div class="row">
                <div class="form-group">
                    <div class="col-md-offset-10 col-xs-12">
                        
                        <a href='/bill_owner'>
                            <button type="button" class="btn btn-default">Close</button>
                        </a>    
                        
                    </div>           
                </div>
            </div> 
    </form>
</div>

Modal Add Payment
<form id="form_bill" name="fbill" method="post" action="{{url('/bill_owner/save_payment/'.$id)}}">
    @csrf
  <div class="modal" id="modalPayment" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Payment</h4>
        </div>
        <div class="modal-body">
                <input type="hidden" name="status" id="status" value="1" />
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Payment Date<span class="required">*</span></label>
                        <div class="col-md-2 col-sm-6 col-xs-12 input-group date" id='datetimepicker1'>
                            <input type='text' id="tgl_bayar" name="tgl_bayar" required="required" class="form-control col-md-7 col-xs-12" style="margin-left: 9px;" value="{{$bill_owner->tgl_jatuh_tempo}}"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>          
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount of Payment<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="jml_bayar" type="text" name="jml_bayar" data-value="{{$bill_owner->total_tagihan_all + $denda - $lebih_bayar}}" value="{{number_format($bill_owner->total_tagihan_all + $denda - $lebih_bayar)}}">
                        </div>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="description" name="descriptionPay" required="required" class="form-control col-md-7 col-xs-12 noresize" rows="2" style="margin-left: -75px;"></textarea>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

@foreach($payment_owner as $itemnya) -->
<!-- Modal Edit Payment-->
<!-- <form id="form_bill" name="fbill" method="post" action="{{url('/payment_owner/update/'.$itemnya->id_payment_owner)}}">
    @csrf
  <div class="modal fade" id="modalEdtPayment{{$itemnya->id_payment_owner}}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Payment</h4>
        </div>
        <div class="modal-body">
                <input type="hidden" name="status" id="status" value="1" />
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Payment Date<span class="required">*</span></label>
                        <div class="col-md-2 col-sm-6 col-xs-12 input-group date" id='datetimepicker2{{$itemnya->id_payment_owner}}'>
                            <input type='text' id="tgl_lahir" name="tgl_bayar" required="required" class="form-control col-md-7 col-xs-12" value="{{$itemnya->periode_bayar}}" style="margin-left: 9px;" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>          
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount of Paid<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="jml_bayar" class="ribuan" value="{{$itemnya->jml_bayar}}">
                        </div>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="description" name="descriptionPay" required="required" class="form-control col-md-7 col-xs-12 noresize"
                                        rows="2" style="margin-left: -75px;">{{$itemnya->keterangan}}</textarea>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>   

<div class="modal fade" id="modalDelPayment{{$itemnya->id_payment_owner}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete Data
            </div>
            <div class="modal-body">
                Are you sure want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" href='ini ke route utk delete payment, hrs dibikin dulu deh routenya, sama kaya yg dulu2'>Delete</a>
            </div>
        </div>
    </div>
</div>

@endforeach -->