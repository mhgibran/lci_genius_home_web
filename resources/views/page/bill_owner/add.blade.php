@include('page.' . $module . '.script_add')
<div class="page-header">
    <h1 class="green">
        <i class="ace-icon fa fa-angle-double-right"></i>
        ADD BILL OWNER
        <i class="ace-icon fa fa-angle-double-left"></i>
        <a href='/bill_owner' class="btn  btn-yellow btn-sm pull-right" type="submit">
            <i class="ace-icon fa fa-times"></i>
            CLOSE
        </a>
    </h1>
</div><!-- /.page-header -->

<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form class="form-horizontal" role="form" name="fbill" id="form_add" method="post" action="{{url('/bill_owner')}}">
        @csrf
        <input type="hidden" name="status" id="status" value="1" />

        <div class="form-group">
            
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Occupant </label>

            <div class="col-sm-4">
                <select class="chosen-select form-control" name='id_unit_owner' id="form-field-select-1"
                    data-placeholder="Choose Occupant..." onchange="setLuas(this)">
                    <option value=""> </option>
                    @foreach ($data_unit_owner as $item)
                    <option value="{{ $item->id_unit_owner }}" data-luas="{{ $item->luas_unit }}">{{
                        $item->namaPenghuni }}
                    </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Invoice Date </label>

            <div class="col-sm-3">
                <div class="input-group">
                    <input class="form-control date-picker" id="id-date-picker-1" name="tgl_cetak"
                        placeholder="Invoice Date" type="text" data-date-format="dd-mm-yyyy" required />
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                </div>
            </div>

            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Due Date </label>

            <div class="col-sm-3">
                <div class="input-group">
                    <input class="form-control date-picker" id="id-date-picker-2" name="tgl_jatuh_tempo"
                        placeholder="Due Date" type="text" data-date-format="dd-mm-yyyy" required />
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                </div>
            </div>
        </div>

        <!-- <div class="form-group">
            <div class="checkbox">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                    <input type="checkbox">Prorate
                </label>

                <div class="col-sm-3">
                    <div class="input-group">
                        <input class="form-control date-picker" id="id-date-picker-3" name="tgl_prorate_awal"
                            placeholder="Start Periode" type="text" data-date-format="dd-mm-yyyy" disabled />
                        <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                        </span>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="input-group">
                        <input class="form-control date-picker" id="id-date-picker-4" name="tgl_prorate_akhir"
                            placeholder="End Periode" type="text" data-date-format="dd-mm-yyyy" disabled />
                        <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" hidden>PJU</label>
            <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -180px;">
                <input type="text" id="tarif_pju" name="tarif_pju" value="{{$get_pju->harga_tarif}}" hidden>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" hidden>PPN</label>
            <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -180px;">
                <input type="text" id="tarif_ppn" name="tarif_ppn" value="{{$get_ppn->harga_tarif}}" hidden>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" hidden>Admin</label>
            <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -180px;">
                <input type="text" id="tarif_admin" name="tarif_admin" value="{{$get_admin->harga_tarif}}" hidden>
            </div>
        </div>


        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#tab1">
                        <i class="orange ace-icon fa fa-bolt bigger-120"></i>
                        ELECTRICITY
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#tab2">
                        <i class="blue ace-icon fa fa-tint bigger-120"></i>
                        WATER
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#tab3">
                        <i class="green ace-icon fa fa-gift bigger-120"></i>
                        Service Charge, IKKL, etc
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#tab4">
                        <i class="black ace-icon fa fa-calculator bigger-120"></i>
                        GRAND TOTAL
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
                            <button class="btn btn-success" type="submit" name="add" id="add">
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

            <div class="tab-content fad">
                <div id="tab1" class="tab-pane fade in active">

                    <!-- /Start Electrical -->
                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Start Meter </label>

                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_sebelum" name="jml_sebelum" onchange="HitungUlang()"
                                onclick="HitungUlang()">
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Power Installed
                        </label>
                        <div class="col-sm-1">
                            <input type="text" class="ribuan" id="daya_terpasang" name="daya_terpasang" onchange="HitungUlang()">
                        </div>

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Sharing Fee </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="bagian_bersama" name="bagian_bersama" value="{{$get_sharing_fee->harga_tarif}}"
                                onchange="HitungUlang()">
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> PJU Fee
                            {{$get_pju->harga_tarif}}%</label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_biaya_bpju" name="jml_biaya_bpju" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> End Meter </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_sesudah" name="jml_sesudah" onchange="HitungUlang()"
                                required />
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Service Fee </label>
                        <div class="col-sm-1">
                            <input type="text" class="ribuan" id="biaya_pemeliharaan" name="biaya_pemeliharaan" value="{{$get_service_fee->harga_tarif}}"
                                onchange="HitungUlang()" required />
                        </div>

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> </label>
                        <div class="col-sm-2">
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1">Admin Fee
                            {{$get_admin->harga_tarif}}%</label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="biaya_admin" name="biaya_admin" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Total Usage </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="total_pemakaian" name="total_pemakaian" readonly />
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> </label>
                        <div class="col-sm-1">
                        </div>

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> </label>
                        <div class="col-sm-2">
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1">PPN
                            {{$get_ppn->harga_tarif}}%</label>
                        <div class="col-sm-1">
                            <input type="text" class="ribuan" id="jml_biaya_ppn" name="jml_biaya_ppn" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Rate </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_rate" name="jml_rate" onchange="HitungUlang()"
                                value="{{$get_listrik->harga_tarif}}">
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> </label>
                        <div class="col-sm-1">
                        </div>

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> </label>
                        <div class="col-sm-2">
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-1">
                        </div>
                    </div>
                    <div class="hr hr-double hr-dotted hr18"></div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Sub Total </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_pemakaian" name="jml_pemakaian" readonly />
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Sub Total </label>
                        <div class="col-sm-1">
                            <input type="text" class="ribuan" id="total_pemeliharaan" name="total_pemeliharaan"
                                readonly />
                        </div>

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Sub Total </label>

                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="total_bagian_bersama" name="total_bagian_bersama"
                                readonly />
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Sub Total</label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_bpju_admin_ppn" name="jml_bpju_admin_ppn"
                                readonly />
                        </div>
                    </div>


                    <div class="hr hr-double hr-dotted hr18"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"><b> ELECTRICITY BILL
                                TOTAL </b> </label>

                        <div class="col-sm-9">
                            <span class="input-icon  input-icon-right">
                                <input type="text" class="ribuan" name='total_tagihan' id="total_tagihan" onchange="HitungUlangListrik2()"
                                    size="50">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="hr hr-double hr-dotted hr18"></div>

                </div><!-- /.tab1 -->

                <!-- /.End Electrical -->

                <!-- /Start Water -->

                <div id="tab2" class="tab-pane fade">

                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Start Meter </label>

                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_sebelum_air" name="jml_sebelum_air" onchange="HitungUlangAir()"
                                onclick="HitungUlangAir()" class="col-sm-12" required />
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Fixed Load </label>

                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_beban_tetap" name="jml_beban_tetap" onchange="HitungUlangAir()"
                                onclick="HitungUlangAir()" value="{{$get_fix_load->harga_tarif}}" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> End Meter </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_sesudah_air" name="jml_sesudah_air" onchange="HitungUlangAir()"
                                class="col-xs-10 col-sm-12" required />
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1">Admin Fee
                            {{$get_admin->harga_tarif}}%</label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="biaya_admin_air" name="biaya_admin_air" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Total Usage </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="total_pemakaian_air" name="total_pemakaian_air" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> PPN
                            {{$get_ppn->harga_tarif}}% </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_biaya_ppn_air" name="jml_biaya_ppn_air" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1">Rate</label>

                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_rate_air" name="jml_rate_air" onchange="HitungUlangAir()"
                                value="{{$get_air->harga_tarif}}" class="col-xs-10 col-sm-12">
                        </div>
                    </div>
                    <div class="hr hr-double hr-dotted hr18"></div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Sub Total </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_pemakaian_air" name="jml_pemakaian_air" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>

                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Sub Total </label>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_tetap_admin_ppn" name="jml_tetap_admin_ppn" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                    </div>

                    <div class="hr hr-double hr-dotted hr18"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"><b> WATER BILL TOTAL
                            </b> </label>

                        <div class="col-sm-9">
                            <span class="input-icon  input-icon-right">
                                <input type="text" class="ribuan" name='jml_tagihan_air' id="jml_tagihan_air" onchange="HitungUlangAir2()"
                                    size="50">

                                <i class="ace-icon fa fa-check bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="hr hr-double hr-dotted hr18"></div>

                </div><!-- /.tab2 -->

                <!-- /.End Water -->

                <!-- /Start Service Charge + IKKL -->
                <div id="tab3" class="tab-pane fade">

                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1">Description </label>

                        <div class="col-sm-9">
                            <input type="text" id="keterangan_sc_ikkl" name="keterangan_sc_ikkl" placeholder="Description"
                                class="col-xs-10 col-sm-9" required />
                        </div>
                    </div>

                    <i class="blue ace-icon fa fa-angle-double-down pull-right bigger-120"></i>
                    <hr />

                    <div class="row">
                        <div class="col-sm-2">
                            <label> Service Charge </label>
                        </div>
                        <div class="col-sm-2">
                            <label> Unit Size </label>
                        </div>
                        <div class="col-sm-2">
                            <label> Insurance Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <label> Unit Size </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="harga_service_charge" name="harga_service_charge"
                                size="16" onchange="HitungSC()" onclick="HitungSC()" value="{{$get_sc->harga_tarif}}"/>
                            <label>x</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="luas_unit" name="luas_unit" size="16" readonly />
                            <label>m2</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="biaya_asuransi" name="biaya_asuransi" onchange="HitungSC()"
                                onclick="HitungSC()" value="{{$get_insurance->harga_tarif}}" size="16" required />
                            <label>x</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" id="luas_unit2" name="luas_unit2" size="16" readonly />
                            <label>m2</label>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-2">
                            <label> Total Service Charge </label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="total_service_charge" name="total_service_charge"
                                class="col-xs-10 col-sm-12" readonly />
                        </div>
                        <div class="col-sm-2">
                            <label> Total Insurance Fee </label>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="ribuan" id="jml_biaya_asuransi" name="jml_biaya_asuransi" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-2">
                            <label> PBB Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <label> Unit Size </label>
                        </div>
                        <div class="col-sm-2">
                            <label> Sinking Fund </label>
                        </div>
                        <div class="col-sm-2">
                            <label> Unit Size </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="biaya_pbb" name="biaya_pbb" size="16" onchange="HitungSC()"
                                onclick="HitungSC()" value="{{$get_pbb->harga_tarif}}" />
                            <label>x</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="luas_unit3" name="luas_unit3" size="16" readonly />
                            <label>m2</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="biaya_sinking_fund" name="biaya_sinking_fund"
                                onchange="HitungSC()" onclick="HitungSC()" value="{{$get_sinking->harga_tarif}}" size="16">
                            <label>x</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="luas_unit4" name="luas_unit4" size="16" readonly />
                            <label>m2</label>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="row">
                        <div class="col-sm-2">
                            <label> Total PBB Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_biaya_pbb" name="jml_biaya_pbb" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                        <div class="col-sm-2">
                            <label> Total Sinking Fund Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_sinking_fund" name="jml_sinking_fund" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-2">
                            <label> SLF Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <label> Unit Size </label>
                        </div>
                        <div class="col-sm-2">
                            <label> HGB Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <label> Unit Size </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="biaya_slf" name="biaya_slf" size="16"
                            onchange="HitungSC()" onclick="HitungSC()" value="{{$get_slf_fee->harga_tarif}}"/>
                            <label>x</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="luas_unit5" name="luas_unit5" size="16" readonly />
                            <label>m2</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="biaya_hgb" name="biaya_hgb"
                            onchange="HitungSC()" onclick="HitungSC()" value="{{$get_hgb_fee->harga_tarif}}" size="16">
                            <label>x</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="luas_unit6" name="luas_unit6" size="16" readonly />
                            <label>m2</label>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="row">
                        <div class="col-sm-2">
                            <label> Total SLF Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_slf" name="jml_slf" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                        <div class="col-sm-2">
                            <label> Total HGB Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_hgb" name="jml_hgb" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-2">
                            <label> Parking Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <label> Unit Size </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="biaya_parkir" name="biaya_parkir" size="16" 
                            onchange="HitungSC()" onclick="HitungSC()" value="{{$get_parking_fee->harga_tarif}}"/>
                            <label>x</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="luas_unit7" name="luas_unit7" size="16" readonly />
                            <label>m2</label>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-2">
                            <label> Total Parking Fee </label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="jml_parkir" name="jml_parkir" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                    </div>
                    <div class="hr hr-double hr-dotted hr18"></div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label> SC + PBB + SLF + Parking</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="total_sc_pbb" name="total_sc_pbb" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                        <div class="col-sm-2">
                            <label>Insurance + Sink Fund + HGB</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="ribuan" id="total_ins_sink" name="total_ins_sink" class="col-xs-10 col-sm-12"
                                readonly />
                        </div>
                        <div class="col-sm-1">
                            <label>PPN {{$get_ppn->harga_tarif}}%</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="ribuan" id="ppn_sc_ikkl" name="ppn_sc_ikkl" class="col-xs-10 col-sm-10"
                                readonly />
                        </div>
                    </div>

                    <div class="hr hr-double hr-dotted hr18"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><b> Service Charge,
                                etc BILL
                                GRAND TOTAL </b> </label>
                        <div class="col-sm-9">
                            <span class="input-icon  input-icon-right">
                                <input type="text" class="ribuan" name='jml_sc_ikkl' id="jml_sc_ikkl" size="50" />
                                <i class="ace-icon fa fa-check bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="hr hr-double hr-dotted hr18"></div>
                </div> <!-- /.tab3 -->

                <!-- /.End SC + IKKL -->

                <!-- /Start Grand Total -->
                <div id="tab4" class="tab-pane fade">

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total Electicity
                            Bill </label>

                        <div class="col-sm-9">
                            <input type="text" class="ribuan" id="jml_tagihan_listrik2" name="jml_tagihan_listrik2"
                                class="col-xs-10 col-sm-5" readonly />
                        </div>
                    </div>

                    <i class="blue ace-icon fa fa-angle-double-down pull-right bigger-120"></i>
                    <hr />

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total Water Bill
                        </label>

                        <div class="col-sm-9">
                            <input type="text" class="ribuan" id="jml_tagihan_air2" name="jml_tagihan_air2" class="col-xs-10 col-sm-5"
                                readonly />
                        </div>
                    </div>

                    <i class="blue ace-icon fa fa-angle-double-down pull-right bigger-120"></i>
                    <hr />

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total IKKL, etc </label>

                        <div class="col-sm-9">
                            <input type="text" class="ribuan" id="total_service_charge_ikkl" name="total_service_charge_ikkl"
                                class="col-xs-10 col-sm-5" readonly />
                        </div>
                    </div>

                    <!-- <i class="blue ace-icon fa fa-angle-double-down pull-right bigger-120"></i>
                    <hr />

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total Last Month Forfeit </label>

                        <div class="col-sm-9">
                            <input type="text" class="ribuan" id="total_denda" name="total_denda"
                                class="col-xs-10 col-sm-5" readonly />
                        </div>
                    </div> -->

                    <i class="blue ace-icon fa fa-angle-double-down pull-right bigger-120"></i>
                    <hr />

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Stamp Fee </label>

                        <div class="col-sm-9">
                            <input type="text" class="ribuan" id="biaya_materai" name="biaya_materai" size="15" value="{{$get_materai->harga_tarif}}"
                                class="col-xs-10 col-sm-5" readonly />
                        </div>
                    </div>

                    <div class="hr hr-double hr-dotted hr18"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><b>BILL GRAND TOTAL
                            </b> </label>
                        <div class="col-sm-9">
                            <span class="input-icon  input-icon-right">
                                <input type="text" class="ribuan" name='total_tagihan_all' id="total_tagihan_all" size="50"
                                    readonly />
                                <i class="ace-icon fa fa-check bigger-110"></i>
                            </span>
                        </div>
                    </div>

                    <div class="hr hr-double hr-dotted hr18"></div>
                </div><!-- /.tab4 -->
                <!-- /.End Grand Total -->
    </form>
</div><!-- /.tab content-->