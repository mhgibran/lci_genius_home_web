<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        EDIT BILL TYPE
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/bill_type' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/bill_type/update/'. $id)}}">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bill Type Name </label>

            <div class="col-sm-9">
                <input type="text" id="nama_bill_type" name="nama_bill_type" class="col-xs-10 col-sm-5" value="{{$data->nama_bill_type}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Charge </label>

            <div class="col-sm-9">
                <input type="text" id="charge" name="harga_tarif" class="col-xs-10 col-sm-5" value="{{$data->harga_tarif}}" />
            </div>
        </div>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <a href='/bill_type' class="btn btn-primary type=" submit">
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
