<script>
    $font = Font_Metrics::get_font("helvetica", "normal");

</script>
<style>
    .page-break {
        page-break-after: always ;
    }

    body {
        font-size: 9px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .kop-atas {
        text-align: left;
        padding-left: 500px;
    }

    /* table,
    th,
    td {
        border: 1px solid black;
    } */

    table {
        border-spacing: 0px;
        border-collapse: separate;
    }

    .alamat {
        display: block;
        min-height: 300px;
    }

</style>
@foreach ($billing_owner as $key => $item)
@if($key >0)
<div class="page-break"></div>
@endif
<table style="width:77%;">
<tr>
    <td colspan="4" style="height:40px;" ></td>
</tr>
    <tr>
        <td colspan="4" class="kop-atas">{{$item->kode_tower}} {{$item->no_floor}}/{{$item->no_unit_apart}}</td>
    </tr>
    <tr>
        <td colspan="4" class="kop-atas">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4" class="kop-atas">{{$item->nama_depan}}</td>
    </tr>
    <tr>
        <td colspan="4" class="kop-atas">
            <div class="alamat">{{$item->alamat_ktp}}</div>
        </td>
    </tr>
    <tr>
        <td colspan="4" style="height:5px;"></td>
    </tr>
    <tr>
        <td colspan="4" class="kop-atas">{{$item->tgl_cetak}}</td>
    </tr>
    <tr>
        <td colspan="4" style="height:3.5px;"></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align:right;padding-right:360px">{{$item->kode_billing}}</td>
    </tr>

    <tr>
        <td style="width:50%;">TAGIHAN IKKL</td>
        <td style="width:25%;">({{$item->luas_unit}} M2 x Rp {{number_format($item->harga_service_charge)}})</td>
        <td style="width:25%;">({{$item->keterangan_sc_ikkl}})</td>
        <td style="text-align:right;width:50%;padding-right:50px;">{{number_format($item->total_service_charge)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">TAGIHAN LISTRIK</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->total_tagihan)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">TAGIHAN AIR</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->total_tagihan_air)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">PPN 10%</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format(($item->total_service_charge +
            $item->total_tagihan +
            $item->total_tagihan_air)*10/100)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">LANGGANAN PARKIR</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->jml_parkir)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">BIAYA ASURANSI</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->jml_biaya_asuransi)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">TAGIHAN SINKING FUND</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->jml_sinking_fund)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">BIAYA PBB</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->jml_biaya_pbb)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">BIAYA SLF (Sertifikat Layak Fungsi)</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->jml_slf)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">BIAYA HGB</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->jml_hgb)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">DENDA KETERLAMBATAN PEMBAYARAN BULAN LALU</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->total_denda)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">KELEBIHAN PEMBAYARAN BULAN LALU</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->total_lebih_bayar)}}</td>
    </tr>
    <tr>
        <td style="width:50%;">MATERAI</td>
        <td style="width:25%;"></td>
        <td style="width:25%;"></td>
        <td style="text-align:right;padding-right:50px;">{{number_format($item->biaya_materai)}}</td>
    </tr>
    <tr>
        <td colspan="4" style="text-align:right;padding-right:50px;"><strong>{{number_format($item->total_tagihan_all +
                $item->total_denda)}}</strong></td>
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align:right;padding-right:500px;">{{number_format($item->jml_rate)}}</td>
    </tr>
</table>
<table style="width:77%;">
    <tr>
        <td colspan="9" style="height:10px;"></td>
    </tr>
    <tr>
        <td style="width:18%; text-align:left">&nbsp;&nbsp;&nbsp;&nbsp; {{number_format($item->jml_daya_terpasang)}}</td>
        <td style="width:18%; text-align:center">{{number_format($item->jml_sebelum)}}</td>
        <td style="width:21%; text-align:center">{{number_format($item->jml_sesudah)}}</td>
        <td style="width:21%; text-align:center">{{number_format($item->total_pemakaian)}}</td>
        <td style="width:20%; text-align:center">{{number_format($item->jml_pemakaian)}}</td>
        <td style="width:23%; text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;12,345</td>
        <td style="width:12%; text-align:center">{{number_format($item->jml_biaya_bpju)}}&nbsp;&nbsp;</td>
        <td style="width:25 %; text-align:center">{{number_format($item->jml_biaya_admin)}}</td>
        <td style="width:22%; text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($item->total_tagihan)}}</td>
    </tr>
    <tr>
        <td colspan="9"></td>
    </tr>
    <tr>
        <td colspan="9" style="text-align:left;padding-left:200px;">{{number_format($item->jml_rate_air)}}</td>
    </tr>
    <tr>
        <td colspan="9" style="height:10px;"></td>
    </tr>
    <tr class="center">
        <td style="text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($item->jml_sebelum_air)}}</td>
        <td style="text-align:center">{{number_format($item->jml_sesudah_air)}}</td>
        <td style="text-align:center">{{number_format($item->no_meter_air)}}</td>
        <td style="text-align:center">{{number_format($item->total_pemakaian_air)}}</td>
        <td style="text-align:center">{{number_format($item->jml_pemakaian_air)}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="2" style=" text-align:center">{{number_format($item->jml_beban_tetap)}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style="text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($item->jml_biaya_admin_air)}}</td>
        <td style="text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($item->total_tagihan_air)}}</td>
    </tr>
    <tr>
        <td colspan="9" style="height:1px;"></td>
    </tr>
    <tr>
        <td colspan="9" style="text-align:left;padding-left:250px;">{{$item->tgl_cetak}}</td>
    </tr>
    <tr>
        <td colspan="9" style="height:19px"></td>
    </tr>
    <tr>
        <td colspan="9" style="text-align:right;padding-right:50px;">PAULUS HARMINTO</td>
    </tr>
</table>
@endforeach
    