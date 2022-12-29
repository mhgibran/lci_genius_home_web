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
                            <label>{{$data_unit_owner->namaApart}}</label>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SC, Insurance, PBB, etc</label>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Forfeit Fee</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>{{number_format($denda)}}</label>
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