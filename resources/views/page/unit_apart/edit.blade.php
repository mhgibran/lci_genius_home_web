<div class="page-header">
    <h1 class="orange">
        <i class="ace-icon fa fa-angle-double-right"></i>
        EDIT APARTMENT UNIT
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/unit_apart' class="btn  btn-yellow btn-sm pull-right" type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->


<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/unit_apart/'. $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="status" id="status" value="1" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No. Unit </label>

            <div class="col-sm-3">
                <input type="text" id="no_unit_apart" name="no_unit_apart" class="col-xs-10 col-sm-5" value='{{$data->no_unit_apart}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit Size (m2)</label>

            <div class="col-sm-3">
                <input type="text" id="luas_unit" name="luas_unit" class="col-xs-10 col-sm-5" value='{{$data->luas_unit}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit Size SemiGross (m2)</label>

            <div class="col-sm-3">
                <input type="text" id="luas_unit_semigross" name="luas_unit_semigross" class="col-xs-10 col-sm-5" value='{{$data->luas_unit_semigross}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tower </label>

            <div class="col-sm-3">
                <select class="chosen-select form-control" name="id_tower" id="form-field-select-3" value='{{$data->nama_tower}}'>
                    <option value=""> </option>
                    @foreach ($data_master_tower as $item2)
                    @php
                    $selected = ($item2->id_tower==$data->id_tower)?'selected':'';
                    @endphp
                    <option value="{{$item2->id_tower}}" {{ $selected }}>{{$item2->nama_tower}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Floor </label>

            <div class="col-sm-3">
                <select class="chosen-select form-control" name="id_floor" id="form-field-select-3" value='{{$data->no_floor}}'>
                    <option value=""> </option>
                    @foreach ($data_master_floor as $item2)
                    @php
                    $selected = ($item2->id_floor==$data->id_floor)?'selected':'';
                    @endphp
                    <option value="{{$item2->id_floor}}" {{ $selected }}>{{$item2->no_floor}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Water Meter Number </label>

            <div class="col-sm-3">
                <input type="text" id="no_meter_air" name="no_meter_air" class="col-xs-10 col-sm-5" value='{{$data->no_meter_air}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Electricity Meter Number </label>

            <div class="col-sm-3">
                <input type="text" id="no_meter_listrik" name="no_meter_listrik" class="col-xs-10 col-sm-5" value='{{$data->no_meter_listrik}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Electricity Power Installed </label>

            <div class="col-sm-3">
                <input type="text" id="jml_daya_terpasang" name="jml_daya_terpasang" class="col-xs-10 col-sm-5" value='{{$data->jml_daya_terpasang}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Handover Date </label>
            <div class="col-sm-3">
                <div class="input-group">
                    <input class="form-control date-picker" id="id-date-picker-1" name="tgl_stk" type="text"
                        data-date-format="dd-mm-yyyy" value='{{$data->tgl_stk}}'>
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <a href='/unit_apart' class="btn btn-primary type=" submit">
                    <i class="ace-icon fa fa-times"></i>
                    Cancel
                </a>
                &nbsp; &nbsp; &nbsp;
                <button class="btn btn-warning type=" submit" name="add" id="add">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Update
                </button>
            </div>
        </div>
    </form>
</div>
