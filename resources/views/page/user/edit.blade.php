<div class="page-header">
    <h1 class="orange">
        <i class="ace-icon fa fa-angle-double-right"></i>
        EDIT USER
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/user' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/user/'. $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="status" id="status" value="1" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Username </label>

            <div class="col-sm-3">
                <input type="text" id="login" name="login" class="col-xs-10 col-sm-5" value='{{$data->login}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Password </label>

            <div class="col-sm-3">
                <input type="text" id="password" name="password" class="col-xs-10 col-sm-5" value='{{$data->password}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Name </label>

            <div class="col-sm-3">
                <input type="text" id="name" name="name" class="col-xs-10 col-sm-5" value='{{$data->name}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Privilege Status </label>

            <div class="col-sm-3">
                <select class="chosen-select form-control" name="priv_status" id="form-field-select-3" value='{{$data->priv_status}}'>
                    <option value=""> </option>
                    @foreach ($priv_list as $item)
                    @php
                    $selected = ($item->priv_status==$data->priv_status)?'selected':'';
                    @endphp
                    <option value="{{$item->priv_status}}" {{ $selected }}>{{$item->nama_priv}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <a href='/user' class="btn btn-primary type=" submit">
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