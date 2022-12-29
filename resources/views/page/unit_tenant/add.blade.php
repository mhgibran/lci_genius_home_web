<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        ADD TENANT UNIT
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/unit_tenant' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/unit_tenant')}}">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">

                <li class="dropdown pull-right">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        Actions &nbsp;
                        <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-info">
                        <li>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <button class="btn btn-success type=" submit" name="add" id="add">
                                <i class="ace-icon fa fa-plus bigger-110"></i>
                                Save
                            </button>
                        </li>
                        &nbsp;
                        <li>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <button class="btn btn-default" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
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
                        <input type="text" id="nama_perusahaan_unit_tenant" name="nama_perusahaan_unit_tenant"
                            placeholder="Name" class="col-xs-10 col-sm-7" required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tenant Code </label>

                    <div class="col-sm-9">
                        <input type="text" id="kode_unit_tenant" name="kode_unit_tenant" placeholder="Code" class="col-xs-10 col-sm-4"
                            required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tenant Name </label>

                    <div class="col-sm-9">
                        <input type="text" id="nama_unit_tenant" name="nama_unit_tenant" placeholder="Tenant Name"
                            class="col-xs-10 col-sm-7" required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Company Address
                    </label>

                    <div class="col-sm-9">
                        <input type="text" id="alamat_kantor" name="alamat_kantor" placeholder="Address" class="col-xs-10 col-sm-12"
                            required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Telephone Number
                    </label>

                    <div class="col-sm-9">
                        <input type="text" id="no_telp" name="no_telp" placeholder="No. Telp" class="col-xs-10 col-sm-5"
                            required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Fax Number </label>

                    <div class="col-sm-9">
                        <input type="text" id="no_fax" name="no_fax" placeholder="No. Fax" class="col-xs-10 col-sm-5"
                            required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Email </label>

                    <div class="col-sm-9">
                        <input type="text" id="email" name="email" placeholder="Email" class="col-xs-10 col-sm-5"
                            required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> PKS Number </label>

                    <div class="col-sm-9">
                        <input type="text" id="no_pks" name="no_pks" placeholder="PKS Number" class="col-xs-10 col-sm-5"
                            required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Contract Start
                    </label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <input class="form-control date" id="datetimepicker1" name="tgl_mulai_kontrak" placeholder="Start Date"
                                type="text" data-date-format="dd-mm-yyyy" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Contract End</label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <input class="form-control date-picker" id="id-date-picker-1" name="tgl_habis_kontrak"
                                placeholder="End Date" type="text" data-date-format="dd-mm-yyyy" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>