<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        ADD USER
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/user' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->


<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/user')}}">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Username </label>

            <div class="col-sm-9">
                <input type="text" id="login" name="login" placeholder="Username" class="col-xs-10 col-sm-5" required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Password </label>

            <div class="col-sm-9">
                <input type="text" id="password" name="password" placeholder="Password" class="col-xs-10 col-sm-5"
                    required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Name </label>

            <div class="col-sm-9">
                <input type="text" id="name" name="name" placeholder="Name" class="col-xs-10 col-sm-5" required />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Privilege Status </label>

            <div class="col-sm-9">
                <select class="chosen-select form-control" name="priv_status" id="form-field-select-3" data-placeholder="Choose Privilege...">
                    <option value=""> </option>
                    @foreach ($priv_users as $item)
                    <option value="{{$item->priv_status}}">{{$item->nama_priv}}</option>
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
    </form>
</div>