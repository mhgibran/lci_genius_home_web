<script>
    function HitungUlang() {
        // ELECTRICITY
        var ttlBeban = 0;
        var _b4 = Number($('#jml_sebelum').val().removeCommas());
        var _after = Number($('#jml_sesudah').val().removeCommas());
        ttlBeban = Number(_after - _b4);
        $('#total_pemakaian').val(ttlBeban.toFixed(2));

        var subttl = 0;
        var _jmlTtl = Number($('#total_pemakaian').val().removeCommas());
        var _rate = Number($('#jml_rate').val().removeCommas());
        subttl = Number(_jmlTtl * _rate);
        $('#jml_pemakaian').val(subttl.toFixed(2));

        var subttl3 = 0;
        var daya_terpasang = Number($('#daya_terpasang').val().removeCommas());
        var biaya_pemeliharaan = Number($('#biaya_pemeliharaan').val().removeCommas());
        subttl3 = Number(daya_terpasang * biaya_pemeliharaan);
        $('#total_pemeliharaan').val(subttl3.toFixed(2));

        var subttl4 = 0;
        var bagian_bersama = Number($('#bagian_bersama').val().removeCommas());
        subttl4 = Number(_jmlTtl * bagian_bersama);
        $('#total_bagian_bersama').val(subttl4.toFixed(2));

        var ttlBiayaBPJU = 0;
        var _subTtl1 = Number($('#jml_pemakaian').val().removeCommas());
        var _subTtl2 = Number($('#total_pemeliharaan').val().removeCommas());
        var _subTtl3 = Number($('#total_bagian_bersama').val().removeCommas());
        var tarif_pju = Number($('#tarif_pju').val().removeCommas());
        var Ttl = _subTtl1 + _subTtl2 + _subTtl3;
        ttlBiayaBPJU = Number((tarif_pju * Ttl) / 100);
        var pembulatanttlBiayaBPJU = Math.floor(ttlBiayaBPJU);
        $('#jml_biaya_bpju').val(pembulatanttlBiayaBPJU);

        var ttlBiayaADM = 0;
        var _subTtl1 = Number($('#jml_pemakaian').val().removeCommas());
        var _subTtl2 = Number($('#total_pemeliharaan').val().removeCommas());
        var _subTtl3 = Number($('#total_bagian_bersama').val().removeCommas());
        var _biayaBPJU = Number($('#jml_biaya_bpju').val().removeCommas());
        var Ttl = _subTtl1 + _subTtl2 + _subTtl3 + _biayaBPJU;
        var tarif_admin = Number($('#tarif_admin').val().removeCommas());
        ttlBiayaADM = Number((tarif_admin * Ttl) / 100);
        var pembulatanttlBiayaADM = Math.floor(ttlBiayaADM);
        $('#biaya_admin').val(pembulatanttlBiayaADM);

        var ttlBiayaPPN = 0;
        var _subTtl1 = Number($('#jml_pemakaian').val().removeCommas());
        var _subTtl2 = Number($('#total_pemeliharaan').val().removeCommas());
        var _subTtl3 = Number($('#total_bagian_bersama').val().removeCommas());
        var _biayaBPJU = Number($('#jml_biaya_bpju').val().removeCommas());
        var _biayaADM = Number($('#biaya_admin').val().removeCommas());
        var Ttl = _subTtl1 + _subTtl2 + _subTtl3 + _biayaBPJU + _biayaADM;
        var tarif_ppn = Number($('#tarif_ppn').val().removeCommas());
        ttlBiayaPPN = Number((tarif_ppn * Ttl) / 100);
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
        var ttlBebanAir = 0;
        var _b4Air = Number($('#jml_sebelum_air').val().removeCommas());
        var _afterAir = Number($('#jml_sesudah_air').val().removeCommas());
        ttlBebanAir = Number(_afterAir - _b4Air);
        $('#total_pemakaian_air').val(ttlBebanAir.toFixed(2));

        var subttlAir = 0;
        var _jmlTtlAir = Number($('#total_pemakaian_air').val().removeCommas());
        var _rateAir = Number($('#jml_rate_air').val().removeCommas());
        subttlAir = Number(_jmlTtlAir * _rateAir);
        $('#jml_pemakaian_air').val(subttlAir.toFixed(2));

        var ttlBiayaADMAir = 0;
        var _subTtl1Air = Number($('#jml_pemakaian_air').val().removeCommas());
        var beban_tetap = Number($('#jml_beban_tetap').val().removeCommas());
        var TtlAir = _subTtl1Air + beban_tetap;
        var tarif_admin = Number($('#tarif_admin').val().removeCommas());
        ttlBiayaADMAir = Number((tarif_admin * TtlAir) / 100);
        var pembulatanttlBiayaADMAir = Math.floor(ttlBiayaADMAir);
        $('#biaya_admin_air').val(pembulatanttlBiayaADMAir);

        var ttlBiayaPPNAir = 0;
        var _subTtl1Air = Number($('#jml_pemakaian_air').val().removeCommas());
        var _subTtl2Air = Number($('#jml_beban_tetap').val().removeCommas());
        var _biayaADMAir = Number($('#biaya_admin_air').val().removeCommas());
        var TtlAir = _subTtl1Air + _subTtl2Air + _biayaADMAir;
        var tarif_ppn = Number($('#tarif_ppn').val().removeCommas());
        ttlBiayaPPNAir = Number((tarif_ppn * TtlAir) / 100);
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
        var ttlSC = 0;
        var _sc = Number($('#harga_service_charge').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlSC = Number(_sc * _luas);
        $('#total_service_charge').val(ttlSC.toFixed(2));

        var ttlAsuransi = 0;
        var _asuransi = Number($('#biaya_asuransi').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlAsuransi = Number(_asuransi * _luas);
        $('#jml_biaya_asuransi').val(ttlAsuransi.toFixed(2));

        var ttlPBB = 0;
        var _pbb = Number($('#biaya_pbb').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlPBB = Number(_pbb * _luas);
        $('#jml_biaya_pbb').val(ttlPBB.toFixed(2));

        var ttlSinking = 0;
        var _sinking = Number($('#biaya_sinking_fund').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlSinking = Number(_sinking * _luas);
        $('#jml_sinking_fund').val(ttlSinking.toFixed(2));

        var ttlSLF = 0;
        var _slf = Number($('#biaya_slf').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlSLF = Number(_slf * _luas);
        $('#jml_slf').val(ttlSLF.toFixed(2));

        var ttlHGB = 0;
        var _hgb = Number($('#biaya_hgb').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlHGB = Number(_hgb * _luas);
        $('#jml_hgb').val(ttlHGB.toFixed(2));

        var ttlParkir = 0;
        var _parkir = Number($('#biaya_parkir').val().removeCommas());
        var _luas = Number($('#luas_unit').val().removeCommas());
        ttlParkir = Number(_parkir * _luas);
        $('#jml_parkir').val(ttlParkir.toFixed(2));

        var total_sc_pbb = 0;
        var sc = Number($('#total_service_charge').val().removeCommas());
        var pbb = Number($('#jml_biaya_pbb').val().removeCommas());
        var slf = Number($('#jml_slf').val().removeCommas());
        var parkir = Number($('#jml_parkir').val().removeCommas());
        total_sc_pbb = Number(sc + pbb + slf + parkir);
        $('#total_sc_pbb').val(total_sc_pbb);

        var total_ins_sink = 0;
        var ins = Number($('#jml_biaya_asuransi').val().removeCommas());
        var sink = Number($('#jml_sinking_fund').val().removeCommas());
        var hgb = Number($('#jml_hgb').val().removeCommas());
        total_ins_sink = Number(ins + sink + hgb);
        $('#total_ins_sink').val(total_ins_sink);

        var ttlBiayaPPNSCikkl = 0;
        var _subTtlSC = Number($('#total_service_charge').val().removeCommas());
        var BiayaAsuransi = Number($('#jml_biaya_asuransi').val().removeCommas());
        var BiayaPBB = Number($('#jml_biaya_pbb').val().removeCommas());
        var BiayaSinking = Number($('#jml_sinking_fund').val().removeCommas());
        var BiayaSLF = Number($('#jml_slf').val().removeCommas());
        var BiayaHGB = Number($('#jml_hgb').val().removeCommas());
        var BiayaParkir = Number($('#jml_parkir').val().removeCommas());
        var PpnSCikkl = _subTtlSC + BiayaAsuransi + BiayaPBB + BiayaSinking + BiayaSLF + BiayaHGB + BiayaParkir;
        var tarif_ppn = Number($('#tarif_ppn').val().removeCommas());
        ttlBiayaPPNSCikkl = Number((tarif_ppn * PpnSCikkl) / 100);
        var pembulatanttlBiayaPPNSCikkl = Math.floor(ttlBiayaPPNSCikkl);
        $('#ppn_sc_ikkl').val(pembulatanttlBiayaPPNSCikkl);

        var TtlSCikkl = _subTtlSC + BiayaAsuransi + BiayaPBB + BiayaSinking + ttlBiayaPPNSCikkl + BiayaSLF + BiayaHGB + BiayaParkir;
        var PembulatanTtlSCikkl = Math.floor(TtlSCikkl);
        $('#jml_sc_ikkl').val(Math.floor(TtlSCikkl));
        $('#total_service_charge_ikkl').val(Math.floor(TtlSCikkl));
        GrandTotalAll();
        // Service Charge
    }

    function GrandTotal() {
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

    function GrandTotalAir() {
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

    $(window).on('load', function () {
        $('#modalNotif').modal('show');
    });
    var cek;
    function setLuas(elem) {
        var luas = $(elem).find('option:selected').data('luas');
        $("#luas_unit").val(luas);
        $("#luas_unit2").val(luas);
        $("#luas_unit3").val(luas);
        $("#luas_unit4").val(luas);
        $("#luas_unit5").val(luas);
        $("#luas_unit6").val(luas);
        $("#luas_unit7").val(luas);

        var id_owner = $('[name=id_unit_owner]').val();
        $.ajax({
            url : base_url+'/water/'+id_owner,
            type : 'GET',
            success : function(data){
                $('[name=jml_sebelum_air]').val(data['WaterMeter'].air_awal);
                $('[name=jml_sesudah_air]').val(data['WaterMeter'].air_akhir);
                HitungUlangAir();
            }
        });

        var id_owner1 = $('[name=id_unit_owner]').val();
        $.ajax({
            url : base_url+'/electricity/'+id_owner1,
            type : 'GET',
            success : function(data){
                $('[name=jml_sebelum]').val(data['ElectricityMeter'].listrik_awal);
                $('[name=jml_sesudah]').val(data['ElectricityMeter'].listrik_akhir);
                HitungUlang();
            }
        });

        var id_owner2 = $('[name=id_unit_owner]').val();
        $.ajax({
            url : base_url+'/daya_terpasang/'+id_owner2,
            type : 'GET',
            success : function(data){
                $('[name=daya_terpasang]').val(data['ElectricityPowerInstalled'].jml_daya_terpasang);
                HitungUlang();
            }
        });

        // // Service Charge
        // var ttlSC = 0;
        // var _sc = Number($('#harga_service_charge').val().removeCommas());
        // var _luas = Number($('#luas_unit').val().removeCommas());
        // ttlSC = Number(_sc * _luas);
        // $('#total_service_charge').val(ttlSC);

        // var ttlAsuransi = 0;
        // var _asuransi = Number($('#biaya_asuransi').val().removeCommas());
        // var _luas = Number($('#luas_unit').val().removeCommas());
        // ttlAsuransi = Number(_asuransi * _luas);
        // $('#jml_biaya_asuransi').val(ttlAsuransi);

        // var ttlPBB = 0;
        // var _pbb = Number($('#biaya_pbb').val().removeCommas());
        // var _luas = Number($('#luas_unit').val().removeCommas());
        // ttlPBB = Number(_pbb * _luas);
        // $('#jml_biaya_pbb').val(ttlPBB);

        // var ttlSinking = 0;
        // var _sinking = Number($('#biaya_sinking_fund').val().removeCommas());
        // var _luas = Number($('#luas_unit').val().removeCommas());
        // ttlSinking = Number(_sinking * _luas);
        // $('#jml_sinking_fund').val(ttlSinking);

        // var ttlAsuransi = 0;
        // var _asuransi = Number($('#biaya_asuransi').val().removeCommas());
        // var _luas = Number($('#luas_unit').val().removeCommas());
        // ttlAsuransi = Number(_asuransi * _luas);
        // $('#jml_biaya_asuransi').val(ttlAsuransi);

        // var ttlSLF = 0;
        // var _slf = Number($('#biaya_slf').val().removeCommas());
        // var _luas = Number($('#luas_unit').val().removeCommas());
        // ttlSLF = Number(_slf * _luas);
        // $('#jml_slf').val(ttlSLF);

        // var ttlHGB = 0;
        // var _hgb = Number($('#biaya_hgb').val().removeCommas());
        // var _luas = Number($('#luas_unit').val().removeCommas());
        // ttlHGB = Number(_hgb * _luas);
        // $('#jml_hgb').val(ttlHGB);

        // var ttlParkir = 0;
        // var _parkir = Number($('#biaya_parkir').val().removeCommas());
        // var _luas = Number($('#luas_unit').val().removeCommas());
        // ttlParkir = Number(_parkir * _luas);
        // $('#jml_parkir').val(ttlParkir);

        // var total_sc_pbb = 0;
        // var sc = Number($('#total_service_charge').val().removeCommas());
        // var pbb = Number($('#jml_biaya_pbb').val().removeCommas());
        // var slf = Number($('#jml_slf').val().removeCommas());
        // var parkir = Number($('#jml_parkir').val().removeCommas());
        // total_sc_pbb = Number(sc + pbb + slf + parkir);
        // $('#total_sc_pbb').val(total_sc_pbb);

        // var total_ins_sink = 0;
        // var ins = Number($('#jml_biaya_asuransi').val().removeCommas());
        // var sink = Number($('#jml_sinking_fund').val().removeCommas());
        // var hgb = Number($('#jml_hgb').val().removeCommas());
        // total_ins_sink = Number(ins + sink + hgb);
        // $('#total_ins_sink').val(total_ins_sink);

        // var ttlBiayaPPNSCikkl = 0;
        // var _subTtlSC = Number($('#total_service_charge').val().removeCommas());
        // var BiayaAsuransi = Number($('#jml_biaya_asuransi').val().removeCommas());
        // var BiayaPBB = Number($('#jml_biaya_pbb').val().removeCommas());
        // var BiayaSinking = Number($('#jml_sinking_fund').val().removeCommas());
        // var BiayaSLF = Number($('#jml_slf').val().removeCommas());
        // var BiayaHGB = Number($('#jml_hgb').val().removeCommas());
        // var BiayaParkir = Number($('#jml_parkir').val().removeCommas());
        // var PpnSCikkl = _subTtlSC + BiayaAsuransi + BiayaPBB + BiayaSinking + BiayaSLF + BiayaHGB + BiayaParkir;
        // var tarif_ppn = Number($('#tarif_ppn').val().removeCommas());
        // ttlBiayaPPNSCikkl = Number((tarif_ppn * PpnSCikkl) / 100);
        // var pembulatanttlBiayaPPNSCikkl = Math.floor(ttlBiayaPPNSCikkl);
        // $('#ppn_sc_ikkl').val(pembulatanttlBiayaPPNSCikkl);

        // var TtlSCikkl = _subTtlSC + BiayaAsuransi + BiayaPBB + BiayaSinking + ttlBiayaPPNSCikkl + BiayaSLF + BiayaHGB + BiayaParkir;
        // var PembulatanTtlSCikkl = Math.floor(TtlSCikkl);
        // $('#jml_sc_ikkl').val(TtlSCikkl);
        // $('#total_service_charge_ikkl').val(TtlSCikkl);
        HitungSC();
        GrandTotalAll();
        // Service Charge
    }

    Date.prototype.addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    }

    

    $(function(){
        $("#id-date-picker-1").datepicker("setDate", new Date());
        $("#id-date-picker-1").change(function(){
            let date = $(this).datepicker("getDate");
            $("#id-date-picker-2").datepicker("setDate", date.addDays(14));
        });
        $("#id-date-picker-2").datepicker("setDate", new Date().addDays(14));

        // $("#jml_bayar").blur(function(){
        //     let nilai_awal = $(this).data("value");
        //     let nilai_akhir = $(this).val().replace(/,/g,"");
        //     if(+nilai_akhir<+nilai_awal)
        //         $(this).val(numberWithCommas(nilai_awal));
        //     else
        //         $(this).val(numberWithCommas(nilai_akhir));
        // })
        // $("#jml_bayar").focus(function(){
            
        //     let nilai_akhir = $(this).val().replace(/,/g,"");
        //     $(this).val(nilai_akhir);
        // })
    })
</script>