<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        ADD OWNER UNIT
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/unit_owner' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/unit_owner')}}">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />

        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#tab1">
                        <i class="green ace-icon fa fa-user bigger-120"></i>
                        Owner
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#tab2">
                        <i class="black ace-icon fa fa-phone bigger-120"></i>
                        Contact
                    </a>
                </li>

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
                <div id="tab1" class="tab-pane fade in active">

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Title </label>

                        <div class="col-sm-2">
                            <select class="chosen-select form-control" name="id_title" id="form-field-select-1"
                                data-placeholder="Choose Title..." required />
                            <option value=""> </option>
                            @foreach ($titles as $item)
                            <option value="{{$item->id_title}}">{{$item->nama_title}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> First Name </label>

                        <div class="col-sm-9">
                            <input type="text" id="nama_depan" name="nama_depan" placeholder="First Name" class="col-xs-10 col-sm-5"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Last Name </label>

                        <div class="col-sm-9">
                            <input type="text" id="nama_belakang" name="nama_belakang" placeholder="Last Name" class="col-xs-10 col-sm-5"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> Gender </label>

                        <div class="col-sm-2">
                            <select class="chosen-select form-control" name="id_gender" id="form-field-select-1"
                                data-placeholder="Choose Gender..." required />
                            <option value=""> </option>
                            @foreach ($genders as $item)
                            <option value="{{$item->id_gender}}">{{$item->nama_gender}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Birth Date </label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" id="id-date-picker-1" name="tgl_lahir"
                                    placeholder="Birth Date" type="text" data-date-format="dd-mm-yyyy" required />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <i class="blue ace-icon fa fa-angle-double-down pull-right bigger-120"></i>
                    <hr />

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">BAST Number </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_bast" name="no_bast" placeholder="No. BAST" class="col-xs-10 col-sm-4"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit Apartment
                        </label>

                        <div class="col-sm-5">
                            <select class="chosen-select form-control" name="id_unit_apart" id="form-field-select-1"
                                data-placeholder="Choose Title..." required />
                            <option value=""> </option>
                            @foreach ($unitaparts as $item)
                            <option value="{{$item->id_unit_apart}}">{{$item->nama_apart}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Number of Residents
                        </label>

                        <div class="col-sm-9">
                            <input type="text" id="jml_penghuni" name="jml_penghuni" placeholder="Residents Amount"
                                class="col-xs-10 col-sm-4" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mailing Address
                        </label>

                        <div class="col-sm-9">
                            <input type="text" id="alamat_surat" name="alamat_surat" placeholder="Mail Address" class="col-xs-10 col-sm-12"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nationality </label>

                        <div class="col-sm-5">
                            <select class="chosen-select form-control" name="id_country" id="form-field-select-1"
                                data-placeholder="Choose Title..." required />
                            <option value=""> </option>
                            @foreach ($countrys as $item)
                            <option value="{{$item->id_country}}">{{$item->nama_country}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                </div><!-- /.tabs1 -->

                <div id="tab2" class="tab-pane fade">

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">No. KTP </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_ktp" name="no_ktp" placeholder="No. KTP" class="col-xs-10 col-sm-5"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Address </label>

                        <div class="col-sm-10">
                            <input type="text" id="alamat_ktp" name="alamat_ktp" placeholder="KTP Address" class="col-xs-10 col-sm-12"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> NPWP </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_npwp" name="no_npwp" placeholder="No." class="col-xs-10 col-sm-5"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Passport </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_passport" name="no_passport" placeholder="No." class="col-xs-10 col-sm-5"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">No. Telephone </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_telp" name="no_telp" placeholder="Telephone Number" class="col-xs-10 col-sm-5"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No. Hp </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_hp" name="no_hp" placeholder="Handphone Number" class="col-xs-10 col-sm-5"
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

                    <i class="blue ace-icon fa fa-angle-double-down pull-right bigger-120"></i>
                    <hr />

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Emergency Contact
                            Name </label>

                        <div class="col-sm-9">
                            <input type="text" id="emergency_name" name="emergency_name" placeholder="Name" class="col-xs-10 col-sm-5"
                                required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Emergency Contact
                            Number </label>

                        <div class="col-sm-9">
                            <input type="text" id="emergency_no" name="emergency_no" placeholder="Contact Number" class="col-xs-10 col-sm-5"
                                required />
                        </div>
                    </div>
    </form>
</div><!-- /.tabs2 -->
