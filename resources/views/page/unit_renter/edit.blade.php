<div class="page-header">
    <h1 class="orange">
        <i class="ace-icon fa fa-angle-double-right"></i>
        EDIT RENTER UNIT
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/unit_renter' class="btn  btn-yellow btn-sm pull-right type=" submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" id="form_add" method="post" action="{{url('/unit_renter/'. $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
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

                <li>
                    <a data-toggle="tab" href="#tab3">
                        <i class="black ace-icon fa fa-calendar bigger-120"></i>
                        Rent Periode
                    </a>
                </li>

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
                <div id="tab1" class="tab-pane fade in active">

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Title </label>

                        <div class="col-sm-2">
                            <select class="chosen-select form-control" name="id_title" id="form-field-select-1">
                                <option value=""> </option>
                                @foreach ($data_master_title as $item2)
                                @php
                                $selected = ($item2->id_title==$data->id_title)?'selected':'';
                                @endphp
                                <option value="{{$item2->id_title}}" {{ $selected }}>{{$item2->nama_title}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> First Name </label>

                        <div class="col-sm-9">
                            <input type="text" id="nama_depan" name="nama_depan" class="col-xs-10 col-sm-5" value='{{$data->nama_depan}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Last Name </label>

                        <div class="col-sm-9">
                            <input type="text" id="nama_belakang" name="nama_belakang" class="col-xs-10 col-sm-5" value='{{$data->nama_belakang}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> Gender </label>

                        <div class="col-sm-2">
                            <select class="chosen-select form-control" name="id_gender" id="form-field-select-1">
                                <option value=""> </option>
                                @foreach ($data_master_gender as $item2)
                                @php
                                $selected = ($item2->id_gender==$data->id_gender)?'selected':'';
                                @endphp
                                <option value="{{$item2->id_gender}}" {{ $selected }}>{{$item2->nama_gender}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Birth Date </label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" id="id-date-picker-1" name="tgl_lahir" type="text"
                                    data-date-format="dd-mm-yyyy" value='{{$data->tgl_lahir}}'>
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <i class="blue ace-icon fa fa-angle-double-down pull-right bigger-120"></i>
                    <hr />

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Unit Apartment
                        </label>

                        <div class="col-sm-5">
                            <select class="chosen-select form-control" name="id_unit_apart" id="form-field-select-1">
                                <option value=""> </option>
                                @foreach ($data_master_unit_apart as $item2)
                                @php
                                $selected = ($item2->id_unit_apart==$data->id_unit_apart)?'selected':'';
                                @endphp
                                <option value="{{$item2->id_unit_apart}}" {{ $selected }}>{{$item2->nama_apart}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Number of Residents
                        </label>

                        <div class="col-sm-9">
                            <input type="text" id="jml_penghuni" name="jml_penghuni" class="col-xs-10 col-sm-4" value='{{$data->jml_penghuni}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mailing Address
                        </label>

                        <div class="col-sm-9">
                            <input type="text" id="alamat_surat" name="alamat_surat" class="col-xs-10 col-sm-12" value='{{$data->alamat_surat}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nationality </label>

                        <div class="col-sm-5">
                            <select class="chosen-select form-control" name="id_country" id="form-field-select-1"
                                data-placeholder="Choose Nationality...">
                                <option value=""> </option>
                                @foreach ($data_master_country as $item2)
                                @php
                                $selected = ($item2->id_country==$data->id_country)?'selected':'';
                                @endphp
                                <option value="{{$item2->id_country}}" {{ $selected }}>{{$item2->nama_country}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div><!-- /.tabs1 -->

                <div id="tab2" class="tab-pane fade">

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">No. KTP </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_ktp" name="no_ktp" class="col-xs-10 col-sm-5" value='{{$data->no_ktp}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Address </label>

                        <div class="col-sm-10">
                            <input type="text" id="alamat_ktp" name="alamat_ktp" class="col-xs-10 col-sm-12" value='{{$data->alamat_ktp}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> NPWP </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_npwp" name="no_npwp" class="col-xs-10 col-sm-5" value='{{$data->no_npwp}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Passport </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_passport" name="no_passport" class="col-xs-10 col-sm-5" value='{{$data->no_passport}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">No. Telephone </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_telp" name="no_telp" class="col-xs-10 col-sm-5" value='{{$data->no_telp}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No. Hp </label>

                        <div class="col-sm-9">
                            <input type="text" id="no_hp" name="no_hp" class="col-xs-10 col-sm-5" value='{{$data->no_hp}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Email </label>

                        <div class="col-sm-9">
                            <input type="text" id="email" name="email" class="col-xs-10 col-sm-5" value='{{$data->email}}'>
                        </div>
                    </div>

                    <i class="blue ace-icon fa fa-angle-double-down pull-right bigger-120"></i>
                    <hr />

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Emergency Contact
                            Name </label>

                        <div class="col-sm-9">
                            <input type="text" id="emergency_name" name="emergency_name" class="col-xs-10 col-sm-5"
                                value='{{$data->emergency_name}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Emergency Contact
                            Number </label>

                        <div class="col-sm-9">
                            <input type="text" id="emergency_no" name="emergency_no" class="col-xs-10 col-sm-5" value='{{$data->emergency_no}}'>
                        </div>
                    </div>
                </div><!-- /.tabs2 -->
                <div id="tab3" class="tab-pane fade">
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Start Rent Date
                        </label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" id="id-date-picker-1" name="start_rent"
                                    placeholder="Start Date" type="text" data-date-format="dd-mm-yyyy" value='{{$data->start_rent}}' />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> End Rent Date
                        </label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" id="id-date-picker-1" name="end_rent"
                                    placeholder="End Date" type="text" data-date-format="dd-mm-yyyy" value='{{$data->end_rent}}'>
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                        </div>
                    </div>
    </form>
</div><!-- /.tabs3 -->
</div><!-- /.tab content-->
</div><!-- /.tab-->
