<form id="form_add" method="post" action="{{url('/user')}}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clear_data()"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add User</h4>
    </div>
    <div class="modal-body">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />        
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Login <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-5">
                    <input type="text" id="login" name="login" required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Privilege Status <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" id="priv_status" name="priv_status" required="required">
                       @foreach ($priv_users as $item)
                            <option value="{{$item->priv_status}}">{{$item->nama_priv}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href='/user'>
            <button type="button" class="btn btn-default">Close</button>
        </a>
        <button type="submit" class="btn btn-primary" name="add" id="add">Save</button>
    </div>
</form>
