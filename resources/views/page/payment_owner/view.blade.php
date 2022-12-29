<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        VIEW PAYMENT OWNER
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/payment_owner' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->


<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_bill" name="fbill" method="post" action="{{url('/payment_owner/update/'.$id)}}"
        disabled />
    @csrf
    <input name="_method" type="hidden" value="PATCH">
    <input type="hidden" name="status" id="status" value="1" />
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bill Tyoe </label>

        <div class="col-sm-4">
            <select class="chosen-select form-control" name='id_bill_type' id="form-field-select-3" value="{{$data->kode_billing}}"
                disabled />
            <option value=""> </option>
            @foreach ($billNum as $item)
            <option value="{{ $item->id_billing_owner }}">{{ $item->kode_billing }}
            </option>
            @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Occupant </label>

        <div class="col-sm-4">
            <select class="chosen-select form-control" name='id_unit_owner' id="form-field-select-3" value="{{$data->namaPenghuni}}"
                disabled />
            <option value=""> </option>
            @foreach ($data_unit_owner as $item)
            <option value="{{ $item->id_unit_owner }}">{{ $item->namaPenghuni }}
            </option>
            @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Billing Periode </label>
        <div class="col-sm-3">
            <div class="input-group">
                <input class="form-control date-picker" id="id-date-picker-1" name="periode_tagihan_awal_air" type="text"
                    data-date-format="dd-mm-yyyy" value="{{$bill_owner->periode_tagihan_akhir}}" disabled />
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Until </label>
        <div class="col-sm-3">
            <div class="input-group">
                <input class="form-control date-picker" id="id-date-picker-1" name="periode_tagihan_akhir_air" type="text"
                    data-date-format="dd-mm-yyyy" value="{{$bill_owner->periode_tagihan_akhir}}" disabled />
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Amount Before </label>

        <div class="col-sm-3">
            <input type="text" id="jml_sebelum" name="jml_sebelum" onchange="HitungUlang()" class="col-xs-10 col-sm-10"
                value="{{$bill_owner->jml_sebelum}}" disabled />
        </div>

        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Amount After </label>

        <div class="col-sm-3">
            <input type="text" id="jml_sesudah" name="jml_sesudah" onchange="HitungUlang()" class="col-xs-10 col-sm-10"
                value="{{$bill_owner->jml_sesudah}}" disabled />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Total Charge </label>

        <div class="col-sm-3">
            <input type="text" id="ttl_charge" name="ttl_charge" min="0" class="col-xs-10 col-sm-10" value="{{$bill_owner->ttl_charge}">
		</div>

                                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Total Billing </label>

										<div class="col-sm-3">
			<input type="text" name="jml_tagihan" id="jml_tagihan" class="col-xs-10 col-sm-10" value="{{$bill_owner->jml_tagihan}}"
                disabled />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Description </label>

        <div class="col-sm-8">
            <textarea id="description" name="description" class="form-control col-md-7 col-xs-12 noresize" value="{{$bill_owner->keterangan}">}</textarea>
		</div>	
	</div>
	</form>
</div>
