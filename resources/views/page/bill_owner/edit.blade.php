<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
        <h4 class="modal-title" id="myModalLabel">Edit Bill Owner</h4>
    </div>
    <div class="x_content">
        <form id="form_bill" name="fbill" method="post" action="{{url('/bill_owner/update/'.$id)}}">
                @csrf
                <input name="_method" type="hidden" value="PATCH">
    <input type="hidden" name="status" id="status" value="1" />       
          
                <hr />
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Occupant<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           
                            <input type="text" name="namaPenghuni" value="{{$data_unit_owner->namaPenghuni}}">
                        </div>
                    </div>
                </div>
                <hr>
               
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-offset-3 col-sm-3 col-xs-12" for="first-name">Amount Before<span class="required">*</span></label>
                        <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -160px;">
                            <input type="text" id="jml_sebelum" name="jml_sebelum" onchange="HitungUlang()" value="{{$bill_owner->jml_sebelum}}">
                        </div>
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Amount After<span class="required">*</span></label>
                        <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -255px;">
                            <input type="text" id="jml_sesudah" name="jml_sesudah" onchange="HitungUlang()" value="{{$bill_owner->jml_sesudah}}">
                        </div>

                    </div>
                </div><br>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-offset-3 col-sm-3 col-xs-12" for="first-name">Total Charge<span class="required">*</span></label>
                        <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -160px;">
                            <input type="text" id="ttl_charge" name="ttl_charge" min="0" value="{{$bill_owner->ttl_charge}}">
                        </div>
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Total Billing<span class="required">*</span></label>
                        <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -255px;">
                            <input type="text" name="jml_tagihan" value="{{$bill_owner->jml_tagihan}}">
                        </div>
                        
                    </div>
                </div>
                
                <hr>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="description" name="description" required="required" class="form-control col-md-7 col-xs-12 noresize"
                                        rows="2" style="margin-left: -90px;">{{$bill_owner->keterangan}}</textarea>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-offset-10 col-xs-12">
                            <br>
                            <a href='/bill_owner'>
                                <button type="button" class="btn btn-default">Close</button>
                            </a>
                            <button type="submit" class="btn btn-primary" name="add" id="add">Save</button> 
                        </div>
                                   
                    </div>
                </div>
        </form>
    </div>
  </div>
 </div>
</div>
