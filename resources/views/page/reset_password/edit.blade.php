<div class="page-header">
    <h1 class="orange">
        <i class="ace-icon fa fa-angle-double-right"></i>
        RESET PASSWORD
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/tax_method' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form id="form_add" method="post" action="{{url('/reset_password/'. $id)}}">
        @csrf
        <p class="alert alert-warning">
        <b>Are you sure Reset Password ?</b></p>
            <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Floor Number </label>

            <div class="col-sm-9">
                <input type="text" id="no_tax_method" name="no_tax_method" placeholder="Floor No." class="col-xs-10 col-sm-5"
                    value='{{$data->no_tax_method}}'>
            </div>
        </div>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <a href='/user' class="btn btn-primary type=" submit">
                    <i class="ace-icon fa fa-times"></i>
                   NO
                </a>
                &nbsp; &nbsp; &nbsp;
                <button class="btn btn-warning type=" submit" name="add" id="add">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    YES
                </button>
            </div>
        </div>
    </form>
</div>
