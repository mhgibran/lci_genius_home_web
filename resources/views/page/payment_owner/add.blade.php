<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        ADD PAYMENT OWNER
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/payment_owner' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_bill" name="fbill" method="post" action="{{url('/payment_owner')}}">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bill Tyoe </label>

            <div class="col-sm-4">
                <select class="chosen-select form-control" name='id_bill_type' id="form-field-select-3"
                    data-placeholder="Choose Bill Type..." onchange="getJmlTipeBill(this.value);">
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
                <select class="chosen-select form-control" name='id_unit_owner' id="form-field-select-3"
                    data-placeholder="Choose Occupant...">
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
                    <input class="form-control date-picker" id="id-date-picker-1" name="periode_tagihan_awal_air"
                        placeholder="Start Date" type="text" data-date-format="dd-mm-yyyy" required />
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                </div>
            </div>
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Until </label>
            <div class="col-sm-3">
                <div class="input-group">
                    <input class="form-control date-picker" id="id-date-picker-1" name="periode_tagihan_akhir_air"
                        placeholder="End Date" type="text" data-date-format="dd-mm-yyyy" required />
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
                    required />
            </div>

            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Amount After </label>

            <div class="col-sm-3">
                <input type="text" id="jml_sesudah" name="jml_sesudah" onchange="HitungUlang()" class="col-xs-10 col-sm-10"
                    required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Total Charge </label>

            <div class="col-sm-3">
                <input type="text" id="ttl_charge" name="ttl_charge" min="0" class="col-xs-10 col-sm-10" required />
            </div>

            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Total Billing </label>

            <div class="col-sm-3">
                <input type="text" name="jml_tagihan" id="jml_tagihan" class="col-xs-10 col-sm-10" required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Description </label>

            <div class="col-sm-8">
                <textarea id="description" name="description" required="required" class="form-control col-md-7 col-xs-12 noresize"></textarea>
            </div>
        </div>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Reset
                </button>
                &nbsp; &nbsp; &nbsp;
                <button class="btn btn-success type=" submit" name="add" id="add">
                    <i class="ace-icon fa fa-plus bigger-110"></i>
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
