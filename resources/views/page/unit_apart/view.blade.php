<div class="page-header">
    <h1 class="grey">
        <i class="ace-icon fa fa-angle-double-right"></i>
        VIEW APARTMENT UNIT
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/unit_apart' class="btn  btn-yellow btn-sm pull-right type=" submit">
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
                <input type="text" id="no_unit_apart" name="no_unit_apart" class="col-xs-10 col-sm-5" value='{{$data->no_unit_apart}}'
                    disabled>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit Size (m2)</label>

            <div class="col-sm-3">
                <input type="text" id="luas_unit" name="luas_unit" class="col-xs-10 col-sm-5" value='{{$data->luas_unit}}'
                    disabled>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit Size SemiGross (m2)</label>

            <div class="col-sm-3">
                <input type="text" id="luas_unit_semigross" name="luas_unit_semigross" class="col-xs-10 col-sm-5" value='{{$data->luas_unit_semigross}}' disabled>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tower </label>

            <div class="col-sm-3">
                <select class="chosen-select form-control" name="id_tower" id="form-field-select-3" value='{{$data->nama_tower}}'
                    disabled>
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
                <select class="chosen-select form-control" name="id_floor" id="form-field-select-3" value='{{$data->no_floor}}'
                    disabled>
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
                <input type="text" id="no_meter_air" name="no_meter_air" class="col-xs-10 col-sm-5" value='{{$data->no_meter_air}}' disabled>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Electricity Meter Number </label>

            <div class="col-sm-3">
                <input type="text" id="no_meter_listrik" name="no_meter_listrik" class="col-xs-10 col-sm-5" value='{{$data->no_meter_listrik}}' disabled>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Electricity Power Installed </label>

            <div class="col-sm-3">
                <input type="text" id="jml_daya_terpasang" name="jml_daya_terpasang" class="col-xs-10 col-sm-5" value='{{$data->jml_daya_terpasang}}' disabled>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Handover Date </label>
            <div class="col-sm-3">
                <div class="input-group">
                    <input class="form-control date-picker" id="id-date-picker-1" name="tgl_stk" type="text"
                        data-date-format="dd-mm-yyyy" value='{{$data->tgl_stk}}' disabled>
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                </div>
            </div>
        </div>
    </form>
</div>
