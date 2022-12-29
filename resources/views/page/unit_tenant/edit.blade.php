<div class="page-header">
    <h1 class="orange">
        <i class="ace-icon fa fa-angle-double-right"></i>
        EDIT TENANT UNIT
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/unit_tenant' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/unit_tenant/'. $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="status" id="status" value="1" />

        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="dropdown pull-right">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        Actions &nbsp;
                        <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-info">
                        <li class="col-md-offset-1 col-md-9">
                            <button class="btn btn-warning type=" submit" name="add" id="add">
                                <i class="ace-icon fa fa-check bigger-50"></i>
                                Update
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="tab-content">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tenant Company Name
                    </label>

                    <div class="col-sm-9">
                        <input type="text" id="nama_perusahaan_unit_tenant" name="nama_perusahaan_unit_tenant" class="col-xs-10 col-sm-5"
                            value='{{$data->nama_perusahaan_unit_tenant}}'>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tenant Code </label>

                    <div class="col-sm-9">
                        <input type="text" id="kode_unit_tenant" name="kode_unit_tenant" class="col-xs-10 col-sm-5"
                            value='{{$data->kode_unit_tenant}}'>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tenant Name </label>

                    <div class="col-sm-9">
                        <input type="text" id="nama_unit_tenant" name="nama_unit_tenant" class="col-xs-10 col-sm-5"
                            value='{{$data->nama_unit_tenant}}'>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Company Address
                    </label>

                    <div class="col-sm-9">
                        <input type="text" id="alamat_kantor" name="alamat_kantor" class="col-xs-10 col-sm-12" value='{{$data->alamat_kantor}}'>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Telephone Number
                    </label>

                    <div class="col-sm-9">
                        <input type="text" id="no_telp" name="no_telp" class="col-xs-10 col-sm-5" value='{{$data->no_telp}}'>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Fax Number </label>

                    <div class="col-sm-9">
                        <input type="text" id="no_fax" name="no_fax" class="col-xs-10 col-sm-5" value='{{$data->no_fax}}'>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Email </label>

                    <div class="col-sm-9">
                        <input type="text" id="email" name="email" class="col-xs-10 col-sm-5" value='{{$data->email}}'>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> PKS Number </label>

                    <div class="col-sm-9">
                        <input type="text" id="no_pks" name="no_pks" class="col-xs-10 col-sm-5" value='{{$data->no_pks}}'>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Contract Start
                    </label>

                    <div class="col-sm-3">
                        <div class="input-group input-group-sm">
                            <input type="text" id="id-date-picker-1" name="tgl_mulai_kontrak" class="form-control date-picker col-xs-10 col-sm-5"
                                data-date-format="dd-mm-yyyy" value='{{$data->tgl_mulai_kontrak}}'>
                            <span class="input-group-addon">
                                <i class="ace-icon fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Contract End </label>

                    <div class="col-sm-3">
                        <div class="input-group input-group-sm">
                            <input type="text" id="id-date-picker-2" name="tgl_habis_kontrak" class="form-control date-picker col-xs-10 col-sm-5"
                                data-date-format="dd-mm-yyyy" value='{{$data->tgl_habis_kontrak}}'>
                            <span class="input-group-addon">
                                <i class="ace-icon fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
			</div>
    </form>
</div>