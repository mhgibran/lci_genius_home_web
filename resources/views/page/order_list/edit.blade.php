<form id="form_add" method="post" action="{{url('/order_list/.$id')}}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clear_data()"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Order</h4>
    </div>
    <div class="modal-body">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="id_order_menu_tenant" value="{{$id}}">

        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_order">Item Order <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-5">
                    <input type="text" id="item_order" name="item_order" required="required" class="form-control col-md-7 col-xs-12" readonly="" value="{{$data->nama_menu_unit_tenant}}">
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-5">
                    <input type="text" id="price" name="price" required="required" class="form-control col-md-7 col-xs-12" readonly="" value="{{number_format($data->harga)}}">
                </div>
            </div>
        </div>
        <hr />
        <!-- laundry -->
        @if ($data->id_menu_category == 7)
        <div class="row" style="display: none;">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Quantity <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-5">
                    <input type="number" id="qty" name="qty" required="required" class="form-control col-md-7 col-xs-12" min="1" value="1" readonly="" value="{{$data->qty}}">
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Quantity <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-5">
                    <input type="number" id="qty" name="qty" required="required" class="form-control col-md-7 col-xs-12" min="1" value="1" readonly="" value="{{$data->qty}}">
                </div>
            </div>
        </div>
        @endif
        <hr />

        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_order">Total Price <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-5">
                    <input type="text" id="total_order" name="total_order" required="required" class="form-control col-md-7 col-xs-12" readonly="" value="{{number_format($data->harga)}}">
                </div>
            </div>
        </div>
        <hr />

        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea id="description" name="description" class="form-control col-md-7 col-xs-12 noresize" rows="3" value="{{$data->description}}"></textarea>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <a href='/order_list/cancel/{{$id}}'>
                <button type="button" class="btn btn-danger">Cancel This Order</button>
            </a>
            <a href='/order_list'>
                <button type="button" class="btn btn-default">Close</button>
            </a>
            <button type="submit" class="btn btn-primary" name="add" id="add">Save</button>
        </div>
</form>

<script type="text/javascript">
    $(document).on('click','#qty',function(){
        var price = $('#price').val();
        var qty = $(this).val();
        var total = $('#total_order');
        var _total = parseInt(price * qty);
        total.val(_total);
    });
</script>