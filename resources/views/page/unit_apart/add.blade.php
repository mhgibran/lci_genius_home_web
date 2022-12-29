<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        ADD APARTMENT UNIT
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/unit_apart' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->


<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/unit_apart')}}">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit No. </label>

            <div class="col-sm-9">
                <input type="text" id="no_unit_apart" name="no_unit_apart" placeholder="No." class="col-xs-10 col-sm-5"
                    required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit Size (m2) Nett</label>

            <div class="col-sm-9">
                <input type="text" id="luas_unit" name="luas_unit" placeholder="Size" class="col-xs-10 col-sm-5"
                    required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit Size (m2) SemiGross</label>

            <div class="col-sm-9">
                <input type="text" id="luas_unit_semigross" name="luas_unit_semigross" placeholder="Size" class="col-xs-10 col-sm-5"
                    required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tower </label>

            <div class="col-sm-5">
                <select class="chosen-select form-control" name="id_tower" id="form-field-select-3" data-placeholder="Choose Tower...">
                    <option value=""> </option>
                    @foreach ($towers as $item)
                    <option value="{{$item->id_tower}}">{{$item->nama_tower}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Floor No. </label>

            <div class="col-sm-5">
                <select class="chosen-select form-control" name="id_floor" id="form-field-select-3" data-placeholder="Choose Floor...">
                    <option value=""> </option>
                    @foreach ($floors as $item)
                    <option value="{{$item->id_floor}}">{{$item->no_floor}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Water Meter Number </label>

            <div class="col-sm-9">
                <input type="text" id="no_meter_air" name="no_meter_air" placeholder="Water Meter Number" class="col-xs-10 col-sm-5"
                    required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Electricity Meter Number </label>

            <div class="col-sm-9">
                <input type="text" id="no_meter_listrik" name="no_meter_listrik" placeholder="Electricity Meter Number" class="col-xs-10 col-sm-5"
                    required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Electricity Power Installed </label>

            <div class="col-sm-9">
                <input type="text" id="jml_daya_terpasang" name="jml_daya_terpasang" placeholder="Electricity Power Installed" class="col-xs-10 col-sm-5"
                    required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Handover Date </label>
            <div class="col-sm-3">
                <div class="input-group">
                    <input class="form-control date-picker" id="id-date-picker-1" name="tgl_stk"
                        placeholder="Handover Date" type="text" data-date-format="dd-mm-yyyy" required />
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                </div>
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
