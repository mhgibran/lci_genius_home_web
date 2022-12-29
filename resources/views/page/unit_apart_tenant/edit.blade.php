<div class="page-header">
    <h1 class="orange">
        <i class="ace-icon fa fa-angle-double-right"></i>
        EDIT TENANT UNIT
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/unit_apart_tenant' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->


<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/unit_apart_tenant/'. $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="status" id="status" value="1" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No. Tenant Unit </label>

            <div class="col-sm-3">
                <input type="text" id="no_unit_apart_tenant" name="no_unit_apart_tenant" class="col-xs-10 col-sm-5"
                    value='{{$data->no_unit_apart_tenant}}'>
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

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <a href='/unit_apart_tenant' class="btn btn-primary type=" submit">
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
