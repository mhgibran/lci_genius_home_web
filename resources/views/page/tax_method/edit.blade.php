<div class="page-header">
    <h1 class="orange">
        <i class="ace-icon fa fa-angle-double-right"></i>
        EDIT TAX METHOD
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/tax_method' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/tax_method/'. $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="status" id="status" value="1" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Floor Number </label>

            <div class="col-sm-9">
                <input type="text" id="no_tax_method" name="no_tax_method" placeholder="Floor No." class="col-xs-10 col-sm-5"
                    value='{{$data->no_tax_method}}'>
            </div>
        </div>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <a href='/tax_method' class="btn btn-primary type=" submit">
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
