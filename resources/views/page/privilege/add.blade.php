<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        ADD PRIVILEGE
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/priv' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/priv')}}">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Privilege Name </label>

            <div class="col-sm-9">
                <input type="text" id="nama_priv" name="nama_priv" placeholder="Privilege Name" class="col-xs-10 col-sm-5"
                    required />
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
