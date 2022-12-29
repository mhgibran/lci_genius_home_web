<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        ADD TENANT UNIT
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/unit_apart_tenant' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/unit_apart_tenant')}}">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit Tenant No. </label>

            <div class="col-sm-7">
                <input type="text" id="no_unit_apart_tenant" name="no_unit_apart_tenant" placeholder="Unit Tenant No."
                    class="col-xs-10 col-sm-5" required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tower </label>

            <div class="col-sm-4">
                <select class="chosen-select form-control" name="id_tower" id="form-field-select-3" data-placeholder="Choose Tower...">
                    <option value=""> </option>
                    @foreach ($towers as $item)
                    <option value="{{$item->id_tower}}">{{$item->nama_tower}}</option>
                    @endforeach
                </select>
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
