<div class="page-header">
    <h1 class="orange">
        <i class="ace-icon fa fa-angle-double-right"></i>
        CHANGE PASSWORD
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/home' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/change_password/'. $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="id_user" id="id_user" value="{{$id}}" />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="curr_password"> Current Password </label>

            <div class="col-sm-9">
                <input type="text" id="curr_password" name="curr_password" placeholder="Current" class="col-xs-10 col-sm-5"
                    value='{{$data->kode_tower}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="new_password"> New Password </label>

            <div class="col-sm-9">
                <input type="text" id="new_password" name="new_password" placeholder="New" class="col-xs-10 col-sm-5"
                    value='{{$data->nama_tower}}'>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="re_new_password""> Retype New Password </label>

										<div class="
                col-sm-9">
                <input type="text" id="re_new_password" name="re_new_password" placeholder="Confirm" class="col-xs-10 col-sm-5"
                    value='{{$data->nama_tower}}'>
        </div>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <a href='/home' class="btn btn-primary type=" submit">
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
