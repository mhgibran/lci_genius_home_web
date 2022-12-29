<div class="page-header">
    <h1 class="pink">
        <i class="ace-icon fa fa-angle-double-right"></i>
        DELETE FLOOR
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/tax_method' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/tax_method/'. $id)}}">
        @csrf
        <p class="alert alert-danger">
            Are you sure delete <b> "{{$data->no_tax_method}} ?"</b></p>
        <input name="_method" type="hidden" value="DELETE">


        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <a href='/tax_method' class="btn btn-primary type=" submit">
                    <i class="ace-icon fa fa-times"></i>
                    NO
                </a>
                &nbsp; &nbsp; &nbsp;
                <button class="btn btn-danger type=" submit" name="add" id="add">
                    <i class="ace-icon fa fa-trash bigger-110"></i>
                    YES
                </button>
            </div>
        </div>
    </form>
</div>
