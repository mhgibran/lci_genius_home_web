<form id="form_bill" name="fbill" method="post" action="{{url('/bill_owner/'. $id)}}">
    @csrf
    <input name="_method" type="hidden" value="PATCH">
    <input type="hidden" name="status" id="status" value="1" />

    <div class="row">
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Occupant<span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name='id_unit_owner' id='id_unit_owner' class="form-control" disabled >
                @foreach ($data_unit_owner as $item)
                    @php
                        $selected = ($item->id_unit_owner==$data->id_unit_owner)?'selected':'';
                    @endphp
                    <option value="{{$item->id_unit_owner}}" {{ $selected }}>{{$item->namaPenghuni}}
                    </option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <hr>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu1">Electricity</a></li>
        <li><a data-toggle="tab" href="#menu2">Water</a></li>
        <li><a data-toggle="tab" href="#menu3">Service Charge + IKKL</a></li>
        <li><a data-toggle="tab" href="#menu4">GrandTotal</a></li>
    </ul>

    <div class="tab-content">
        <!-- ELECTRICITY (Menu1) -->
        <div id="menu1" class="tab-pane fade in active">
            <h3></h3>

            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Billing
                        Period<span class="required">*</span></label>
                    <div class="col-md-4 col-sm-6 col-xs-12 input-group date" id='datetimepicker1'>
                        <input type='text' id="tgl_lahir" name="periode_tagihan_awal" required="required" class="form-control col-md-7 col-xs-12"
                            style="margin-left: 10px;" value='{{$data->periode_tagihan_awal}}'/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>

                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Until<span class="required">*</span></label>
                    <div class="col-md-4 col-sm-6 col-xs-12 input-group date" id='datetimepicker2'>
                        <input type='text' id="tgl_lahir" name="periode_tagihan_akhir" required="required" class="form-control col-md-7 col-xs-12"
                            style="margin-left: 10px;" value='{{$data->periode_tagihan_akhir}}'/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>

                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="keterangan" name="keterangan" required="required" class="form-control col-md-7 col-xs-12 noresize"
                            rows="1" style="margin-left: -90px;">{{$data->keterangan}}</textarea>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;">
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start
                        Meter<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -180px;">
                        <input type="text" id="jml_sebelum" name="jml_sebelum" onchange="HitungUlang()" onclick="HitungUlang()"
                            size="15" value='{{$data->jml_sebelum}}'>
                    </div>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="margin-left: -25px">Electrical
                        Power Installed<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -100px; margin-right: 15px;">
                        <input type="text" id="daya_terpasang" name="daya_terpasang" onchange="HitungUlang()" size="7" value='{{$data->jml_daya_terpasang}}'>
                    </div>


                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -100px">Sharing
                        Fee<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -60px">
                        <input type="text" id="bagian_bersama" name="bagian_bersama" size="6" onchange="HitungUlang()" value='{{$data->jml_bagian_bersama}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -90px">PJU
                        Fee 4.00%</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -37px">
                        <input type="text" id="jml_biaya_bpju" name="jml_biaya_bpju" size="7" readonly value='{{$data->jml_biaya_bpju}}'/>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="">End
                        Meter<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -180px;">
                        <input type="text" id="jml_sesudah" name="jml_sesudah" onchange="HitungUlang()" size="15" value='{{$data->jml_sesudah}}'>
                    </div>

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -25px;">Service
                        Fee<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -13px;">
                        <input type="text" id="biaya_pemeliharaan" name="biaya_pemeliharaan" size="7" onchange="HitungUlang()" value='{{$data->jml_biaya_pemeliharaan}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 118px;">Administration
                        Fee 5%</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" id="biaya_admin" name="biaya_admin" size="7" readonly value='{{$data->jml_biaya_admin}}'/>
                    </div>

                </div>
            </div><br>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 0;">Total
                        Usage</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -93px;">
                        <input type="text" id="total_pemakaian" name="total_pemakaian" size="15" readonly value='{{$data->total_pemakaian}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 440px;">PPN
                        10%</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -40px;">
                        <input type="text" id="jml_biaya_ppn" name="jml_biaya_ppn" size="7" readonly value='{{$data->jml_biaya_ppn}}'/>
                    </div>
                </div>
            </div><br>
            <div class="row">

                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Rate<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -270; margin-right: 0;">
                        <input type="text" id="jml_rate" name="jml_rate" onchange="HitungUlang()" size="15" value="1450" value='{{$data->jml_rate}}'>
                    </div>

                </div>
            </div><br>
            <div class="row">

                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Sub Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -270; margin-right: 0;">
                        <input type="text" id="jml_pemakaian" name="jml_pemakaian" size="15" readonly value='{{$data->jml_pemakaian}}'>
                    </div>
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name" style="margin-left: -110px; margin-right: 100px">Sub
                        Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -335;">
                        <input type="text" id="total_pemeliharaan" name="total_pemeliharaan" size="15" readonly value='{{$data->total_pemeliharaan}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -195px;">Sub
                        Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -125;">
                        <input type="text" id="total_bagian_bersama" name="total_bagian_bersama" size="13" readonly value='{{$data->total_bagian_bersama}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -45px;">Sub
                        Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -85;">
                        <input type="text" id="jml_bpju_admin_ppn" name="jml_bpju_admin_ppn" size="15" readonly value='{{$data->jml_bpju_admin_ppn}}'/>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;" />
            <div class="row">

                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name" style="font-size: 18px;">Electricity
                        Bill Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -170; margin-right: 0;">
                        <input type='text' name='total_tagihan' id="total_tagihan" style="font-size: 18px;" onchange="HitungUlangListrik2()" value='{{$data->total_tagihan}}'>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;" />

        </div>

        <!-- WATER (Menu2) -->
        <div id="menu2" class="tab-pane fade">
            <h3></h3>

            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Billing
                        Period<span class="required">*</span></label>
                    <div class="col-md-4 col-sm-6 col-xs-12 input-group date" id='datetimepicker3'>
                        <input type='text' id="periode_tagihan_awal_air" name="periode_tagihan_awal_air" required="required"
                            class="form-control col-md-7 col-xs-12" style="margin-left: 10px;" value='{{$data->periode_tagihan_awal_air}}'/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>

                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Until<span class="required">*</span></label>
                    <div class="col-md-4 col-sm-6 col-xs-12 input-group date" id='datetimepicker4'>
                        <input type='text' id="periode_tagihan_akhir_air" name="periode_tagihan_akhir_air" required="required"
                            class="form-control col-md-7 col-xs-12" style="margin-left: 10px;" value='{{$data->periode_tagihan_akhir_air}}'/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>

                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="keterangan_air" name="keterangan_air" required="required" class="form-control col-md-7 col-xs-12 noresize"
                            rows="1" style="margin-left: -90px;">{{$data->keterangan_air}}</textarea>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;">
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start
                        Meter<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -180px;">
                        <input type="text" id="jml_sebelum_air" name="jml_sebelum_air" onchange="HitungUlangAir()"
                            onclick="HitungUlangAir()" size="15" value='{{$data->jml_sebelum_air}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -20px">Fixed
                        Load<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px">
                        <input type="text" id="jml_beban_tetap" name="jml_beban_tetap" size="6" onchange="HitungUlangAir()"
                            onclick="HitungUlangAir()" value="25000" value='{{$data->jml_beban_tetap}}'>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="">End
                        Meter<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -180px;">
                        <input type="text" id="jml_sesudah_air" name="jml_sesudah_air" onchange="HitungUlangAir()" size="15" value='{{$data->jml_sesudah_air}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -20px;">Administration
                        Fee 5%</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" id="biaya_admin_air" name="biaya_admin_air" size="7" readonly value='{{$data->jml_biaya_admin_air}}'/>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 0;">Total
                        Usage</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -93px;">
                        <input type="text" id="total_pemakaian_air" name="total_pemakaian_air" size="15" readonly value='{{$data->total_pemakaian_air}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -15px;">PPN
                        10%</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" id="jml_biaya_ppn_air" name="jml_biaya_ppn_air" size="7" readonly value='{{$data->jml_biaya_ppn_air}}'/>
                    </div>
                </div>
            </div><br>
            <div class="row">

                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Rate<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -270; margin-right: 0;">
                        <input type="text" id="jml_rate_air" name="jml_rate_air" onchange="HitungUlangAir()" size="15"
                            value="18500" value='{{$data->jml_rate_air}}'>
                    </div>

                </div>
            </div><br>
            <div class="row">

                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Sub Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -270; margin-right: 0;">
                        <input type="text" id="jml_pemakaian_air" name="jml_pemakaian_air" size="15" readonly value='{{$data->jml_pemakaian_air}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -110px;">Sub
                        Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35;">
                        <input type="text" id="jml_tetap_admin_ppn" name="jml_tetap_admin_ppn" size="15" readonly value='{{$data->jml_tetap_admin_ppn}}' />
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;" />
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name" style="font-size: 18px;">Water
                        Bill Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -170; margin-right: 0;">
                        <input type='text' name='jml_tagihan_air' id="jml_tagihan_air" style="font-size: 18px;"
                            onchange="HitungUlangAir2()" value='{{$data->total_tagihan_air}}'>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;" />
        </div>

        <div id="menu3" class="tab-pane fade">
            <h3></h3>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="keterangan_sc_ikkl" name="keterangan_sc_ikkl" required="required" class="form-control col-md-7 col-xs-12 noresize"
                            rows="1" style="margin-left: -130px;">{{$data->keterangan_sc_ikkl}}</textarea>
                    </div>
                </div>
            </div><br />
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 0;">Service
                        Charge<span class="required">*</span></label>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -35px;">Unit
                        Size
                    </label>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -20px;">Insurance Fee<span class="required">*</span></label>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -35px;">Unit
                        Size
                    </label>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -24;">IKKL
                        Fee<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" class="ribuan" id="biaya_ikkl" name="biaya_ikkl" size="15" value="100000" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" id="harga_service_charge" name="harga_service_charge" size="15" onchange="HitungSC()"
                            onclick="HitungSC()" value="8500" value='{{$data->harga_service_charge}}'>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -55px;">x</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -160px;">
                        <input type="text" id="luas_unit" name="luas_unit" size="5" value="42" readonly/>
                        m2
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                    <input type="text" class="ribuan" id="biaya_asuransi" name="biaya_asuransi" size="15"
                        onchange="HitungSC()" onclick="HitungSC()" value="1000" style="margin-left: -18px;">
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -70px;">x</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -160px;">
                        <input type="text" class="ribuan" id="luas_unit2" name="luas_unit2" size="5" readonly/>
                        m2
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -20;">PPN
                            10%</label>
                        <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                            <input type="text" class="ribuan" id="ppn_sc_ikkl" name="ppn_sc_ikkl" size="15" readonly/>
                        </div>
                    </div>
                </div>
            </div><br />
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 0;">Total
                        Service Charge</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" id="total_service_charge" name="total_service_charge" size="15" readonly value='{{$data->total_service_charge}}'/>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: -20px;">Total Insurance Fee</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" class="ribuan" id="jml_biaya_asuransi" name="jml_biaya_asuransi" size="15" readonly/>
                    </div>
                </div>
            </div><br />
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 0;">IKKL
                        Fee<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" id="biaya_ikkl" name="biaya_ikkl" size="15" value="100000" value='{{$data->biaya_ikkl}}'/>
                    </div>
                </div>
            </div><br />
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 0;">PPN
                        10%</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" id="ppn_sc_ikkl" name="ppn_sc_ikkl" size="15" readonly value='{{$data->ppn_sc_ikkl}}'/>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;" />
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name" style="font-size: 18px;">SC
                        + IKKL Bill Grand Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -100; margin-right: 0;">
                        <input type='text' name='jml_sc_ikkl' id="jml_sc_ikkl" style="font-size: 18px;" value='{{$data->jml_sc_ikkl}}'>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;" />
        </div>

        <div id="menu4" class="tab-pane fade">
            <h3></h3>
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 0;">Total
                        Electricity Bill</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" id="jml_tagihan_listrik2" name="jml_tagihan_listrik2" size="15" readonly value='{{$data->total_tagihan}}'/>
                    </div>
                </div>
            </div><br />
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 0;">Total
                        Water Bill</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" id="jml_tagihan_air2" name="jml_tagihan_air2" size="15" readonly value='{{$data->total_tagihan_air}}'/>
                    </div>
                </div>
            </div><br />
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="margin-left: 0;">Total
                        Service Charge + IKKL</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -35px;">
                        <input type="text" id="total_service_charge_ikkl" name="total_service_charge_ikkl" size="15"
                            readonly value='{{$data->jml_sc_ikkl}}'/>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;" />
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name" style="font-size: 18px;">Bill Grand Total</label>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left: -170; margin-right: 0;">
                        <input type='text' name='total_tagihan_all' id="total_tagihan_all" style="font-size: 18px;" value='{{$data->total_tagihan_all}}'>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid grey;" />
        </div>
    </div>

    <div class="modal-footer">
        <a href='/bill_owner'>
            <button type="button" class="btn btn-default">Close</button>
        </a>
        <button type="submit" class="btn btn-primary" name="add" id="add">Save</button>
    </div>
</form>

<script>
    function HitungUlang() {
        // ELECTRICITY
        var ttlBeban =0;
        var _b4 = Number($('#jml_sebelum').val().removeCommas());
        var _after = Number($('#jml_sesudah').val().removeCommas());
        ttlBeban = Number(_after - _b4);
        $('#total_pemakaian').val(ttlBeban);
         
        var subttl =0;
        var _jmlTtl = Number($('#total_pemakaian').val().removeCommas());
        var _rate = Number($('#jml_rate').val().removeCommas());
        subttl = Number(_jmlTtl * _rate);
        $('#jml_pemakaian').val(subttl);
         
        var subttl3 =0;
        var daya_terpasang = Number($('#daya_terpasang').val().removeCommas());
        var biaya_pemeliharaan = Number($('#biaya_pemeliharaan').val().removeCommas());
        subttl3 = Number(daya_terpasang * biaya_pemeliharaan);
        $('#total_pemeliharaan').val(subttl3);

        var subttl4 =0;
        var bagian_bersama = Number($('#bagian_bersama').val().removeCommas());
        subttl4 = Number(_jmlTtl * bagian_bersama);
        $('#total_bagian_bersama').val(subttl4);
        
        var ttlBiayaBPJU = 0;
        var _subTtl1 = Number($('#jml_pemakaian').val().removeCommas());
        var _subTtl2 = Number($('#total_pemeliharaan').val().removeCommas());
        var _subTtl3 = Number($('#total_bagian_bersama').val().removeCommas());
        var Ttl = _subTtl1 + _subTtl2 + _subTtl3;
        ttlBiayaBPJU = Number((4 * Ttl) / 100);
        var pembulatanttlBiayaBPJU = Math.floor(ttlBiayaBPJU);
        $('#jml_biaya_bpju').val(pembulatanttlBiayaBPJU);

        var ttlBiayaADM = 0;
        var _subTtl1 = Number($('#jml_pemakaian').val().removeCommas());
        var _subTtl2 = Number($('#total_pemeliharaan').val().removeCommas());
        var _subTtl3 = Number($('#total_bagian_bersama').val().removeCommas());
        var _biayaBPJU = Number($('#jml_biaya_bpju').val().removeCommas());
        var Ttl = _subTtl1 + _subTtl2 + _subTtl3 + _biayaBPJU;
        ttlBiayaADM = Number((5 * Ttl) / 100);
        var pembulatanttlBiayaADM = Math.floor(ttlBiayaADM);
        $('#biaya_admin').val(pembulatanttlBiayaADM);

        var ttlBiayaPPN = 0;
        var _subTtl1 = Number($('#jml_pemakaian').val().removeCommas());
        var _subTtl2 = Number($('#total_pemeliharaan').val().removeCommas());
        var _subTtl3 = Number($('#total_bagian_bersama').val().removeCommas());
        var _biayaBPJU = Number($('#jml_biaya_bpju').val().removeCommas());
        var _biayaADM = Number($('#biaya_admin').val().removeCommas());
        var Ttl = _subTtl1 + _subTtl2 + _subTtl3 + _biayaBPJU + _biayaADM;
        ttlBiayaPPN = Number((10 * Ttl) / 100);
        var pembulatanttlBiayaPPN = Math.floor(ttlBiayaPPN);
        $('#jml_biaya_ppn').val(pembulatanttlBiayaPPN);

        var ttlBiayaDLL = 0;
        var _biayaBPJU = Number($('#jml_biaya_bpju').val().removeCommas());
        var _biayaADM = Number($('#biaya_admin').val().removeCommas());
        var _biayaPPN = Number($('#jml_biaya_ppn').val().removeCommas());
        ttlBiayaDLL = Number(_biayaBPJU + _biayaADM + _biayaPPN);
        $('#jml_bpju_admin_ppn').val(ttlBiayaDLL);
        GrandTotal();
        GrandTotalAll();
        // ELECTRICITY
    }

    function HitungUlangAir() {
        // WATER
        var ttlBebanAir =0;
        var _b4Air = Number($('#jml_sebelum_air').val().removeCommas());
        var _afterAir = Number($('#jml_sesudah_air').val().removeCommas());
        ttlBebanAir = Number(_afterAir - _b4Air);
        $('#total_pemakaian_air').val(ttlBebanAir);
         
        var subttlAir =0;
        var _jmlTtlAir = Number($('#total_pemakaian_air').val().removeCommas());
        var _rateAir = Number($('#jml_rate_air').val().removeCommas());
        subttlAir = Number(_jmlTtlAir * _rateAir);
        $('#jml_pemakaian_air').val(subttlAir);

        var ttlBiayaADMAir = 0;
        var _subTtl1Air = Number($('#jml_pemakaian_air').val().removeCommas());
        var beban_tetap = Number($('#jml_beban_tetap').val().removeCommas());
        var TtlAir = _subTtl1Air + beban_tetap;
        ttlBiayaADMAir = Number((5 * TtlAir) / 100);
        var pembulatanttlBiayaADMAir = Math.floor(ttlBiayaADMAir);
        $('#biaya_admin_air').val(pembulatanttlBiayaADMAir);

        var ttlBiayaPPNAir = 0;
        var _subTtl1Air = Number($('#jml_pemakaian_air').val().removeCommas());
        var _subTtl2Air = Number($('#jml_beban_tetap').val().removeCommas());
        var _biayaADMAir = Number($('#biaya_admin_air').val().removeCommas());
        var TtlAir = _subTtl1Air + _subTtl2Air + _biayaADMAir;
        ttlBiayaPPNAir = Number((10 * TtlAir) / 100);
        var pembulatanttlBiayaPPNAir = Math.floor(ttlBiayaPPNAir);
        $('#jml_biaya_ppn_air').val(pembulatanttlBiayaPPNAir);

        var ttlBiayaDLLAir = 0;
        var _subTtl1Air = Number($('#jml_beban_tetap').val().removeCommas());
        var _biayaADMAir = Number($('#biaya_admin_air').val().removeCommas());
        var _biayaPPNAir = Number($('#jml_biaya_ppn_air').val().removeCommas());
        ttlBiayaDLLAir = Number(_subTtl1Air + _biayaADMAir + _biayaPPNAir);
        $('#jml_tetap_admin_ppn').val(ttlBiayaDLLAir);
        GrandTotalAir();
        GrandTotalAll();
        // WATER
    }

    function HitungSC() {
        // Service Charge
        var ttlSC =0;
        var _sc = Number($('#harga_service_charge').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlSC = Number(_sc * _luas);
        $('#total_service_charge').val(ttlSC);

        var ttlAsuransi =0;
        var _asuransi = Number($('#biaya_asuransi').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlAsuransi = Number(_asuransi * _luas);
        $('#jml_biaya_asuransi').val(ttlAsuransi);
        
        var ttlPBB =0;
        var _pbb = Number($('#biaya_pbb').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlPBB = Number(_pbb * _luas);
        $('#jml_biaya_pbb').val(ttlPBB);

        var ttlSinking =0;
        var _sinking = Number($('#biaya_sinking_fund').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlSinking = Number(_sinking * _luas);
        $('#jml_sinking_fund').val(ttlSinking);

        var ttlAsuransi =0;
        var _asuransi = Number($('#biaya_asuransi').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlAsuransi = Number(_asuransi * _luas);
        $('#jml_biaya_asuransi').val(ttlAsuransi);

        var total_sc_pbb = 0;
        var sc = Number($('#total_service_charge').val().removeCommas());
        var pbb = Number($('#jml_biaya_pbb').val().removeCommas());
        total_sc_pbb = Number(sc + pbb);
        $('#total_sc_pbb').val(total_sc_pbb);

        var total_ins_sink = 0;
        var ins = Number($('#jml_biaya_asuransi').val().removeCommas());
        var sink = Number($('#jml_sinking_fund').val().removeCommas());
        total_ins_sink = Number(ins + sink);
        $('#total_ins_sink').val(total_ins_sink);

        var ttlBiayaPPNSCikkl = 0;
        var _subTtlSC = Number($('#total_service_charge').val().removeCommas());
        var BiayaIKKL = Number($('#biaya_ikkl').val().removeCommas());
        var BiayaAsuransi = Number($('#jml_biaya_asuransi').val().removeCommas());
        var BiayaPBB = Number($('#jml_biaya_pbb').val().removeCommas());
        var BiayaSinking = Number($('#jml_sinking_fund').val().removeCommas());
        var PpnSCikkl = _subTtlSC + BiayaIKKL + BiayaAsuransi + BiayaPBB + BiayaSinking;
        ttlBiayaPPNSCikkl = Number((10 * PpnSCikkl) / 100);
        var pembulatanttlBiayaPPNSCikkl = Math.floor(ttlBiayaPPNSCikkl);
        $('#ppn_sc_ikkl').val(pembulatanttlBiayaPPNSCikkl);
        
        var total_ikkl_ppn = 0;
        var ikkl = Number($('#biaya_ikkl').val().removeCommas());
        var ppn = Number($('#ppn_sc_ikkl').val().removeCommas());
        total_ikkl_ppn = Number(ikkl + ppn);
        $('#total_ikkl_ppn').val(total_ikkl_ppn);

        var TtlSCikkl = _subTtlSC + BiayaIKKL + BiayaAsuransi + BiayaPBB + BiayaSinking + ttlBiayaPPNSCikkl;
        $('#jml_sc_ikkl').val(TtlSCikkl);
        $('#total_service_charge_ikkl').val(TtlSCikkl);
        GrandTotalAll();
        // Service Charge
    }
    
    function GrandTotal(){
         var GrandTotal = 0;
         var subTtlDLL = Number($('#jml_bpju_admin_ppn').val().removeCommas());
         var _subTtl1 = Number($('#jml_pemakaian').val().removeCommas());
         var _subTtl2 = Number($('#total_pemeliharaan').val().removeCommas());
         var _subTtl3 = Number($('#total_bagian_bersama').val().removeCommas());
        
         GrandTotal = Number(_subTtl1 + _subTtl2 + _subTtl3 + subTtlDLL);
         var pembulatanGrandTotal = Math.floor(GrandTotal);
         $('#total_tagihan').val(pembulatanGrandTotal);
         $('#jml_tagihan_listrik2').val(pembulatanGrandTotal);
    }

    function GrandTotalAir(){
        var GrandTotalAir = 0;
        var _subTtl1Air = Number($('#jml_pemakaian_air').val().removeCommas());
        var subTtlDLLAir = Number($('#jml_tetap_admin_ppn').val().removeCommas());
        
        GrandTotalAir = Number(_subTtl1Air + subTtlDLLAir);
        var pembulatanGrandTotalAir = Math.floor(GrandTotalAir);
        $('#jml_tagihan_air').val(pembulatanGrandTotalAir);
        $('#jml_tagihan_air2').val(pembulatanGrandTotalAir);
    }

    function GrandTotalAll() {
        var GrandTotalAll = 0;
        var GrandTotalListrik = Number($('#total_tagihan').val().removeCommas());
        var GrandTotalAir = Number($('#jml_tagihan_air').val().removeCommas());
        var GrandTotalSCikkl = Number($('#total_service_charge_ikkl').val().removeCommas());
        var biaya_materai = Number($('#biaya_materai').val().removeCommas());
        
        GrandTtlAll = Number(GrandTotalListrik + GrandTotalAir + GrandTotalSCikkl + biaya_materai);
        var pembulatanGrandTotalAll = Math.floor(GrandTtlAll);
         $('#total_tagihan_all').val(pembulatanGrandTotalAll);
    }
    
    $(window).on('load',function(){
        $('#modalNotif').modal('show');
    });
    function setLuas(elem){
        var luas = $(elem).find('option:selected').data('luas');
        $("#luas_unit").val(luas);
        $("#luas_unit2").val(luas);
        $("#luas_unit3").val(luas);
        $("#luas_unit4").val(luas);
    }
</script>