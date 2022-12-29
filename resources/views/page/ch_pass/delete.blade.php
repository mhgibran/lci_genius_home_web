<form id="form_add" method="post" action="{{url('/user/'. $id)}}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clear_data()"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete User</h4>
    </div>
    <div class="modal-body">
        @csrf
        <h3>Are you sure delete {{$data->login}} ?</h3>
        <input name="_method" type="hidden" value="DELETE">
        
    <div class="modal-footer">
        <a href='/user'>
            <button type="button" class="btn btn-default">No</button>
        </a>
        <button type="submit" class="btn btn-primary" name="add" id="add">Yes</button>
    </div>
</form>
