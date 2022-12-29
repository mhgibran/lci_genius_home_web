<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\BillOwner;
use App\BillDenda;
use App\BillLebihBayar;
use App\BillType;
use App\PaymentOwner;
use App\UnitOwner;
use DB;
use Session;
use Auth;
use Dompdf\Dompdf;
use Excel;
use App\Exports\BillOwnerExport;
use App\Exports\BillOwnerExportFaktur;
use PDF;
use DateTime;

class BillOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->priv_status==1 || Auth::user()->priv_status==4 || Auth::user()->priv_status==5) {
            $temp = BillOwner::select(DB::raw('billing_owner.*,mst_unit_owner.*, mst_title.*, mst_unit_apart.*, mst_floor.*, mst_tower.*,v_billing_denda.total_denda,billing_lebih_bayar.total_lebih_bayar'))
                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','billing_owner.id_unit_owner')
                    ->join('mst_title','mst_unit_owner.id_title','=','mst_title.id_title')
                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                    ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                    ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                    ->leftJoin('v_billing_denda', function($join)
                        {
                            $join->on('billing_owner.id_unit_owner', '=', 'v_billing_denda.id_unit_owner');
                            $join->on('billing_owner.bulan_sbl', '=', 'v_billing_denda.bulan');
                            $join->on('billing_owner.tahun_sbl', '=', 'v_billing_denda.tahun');
                        
                        })
                    ->leftJoin('billing_lebih_bayar', function($join)
                        {
                            $join->on('billing_owner.id_unit_owner', '=', 'billing_lebih_bayar.id_unit_owner');
                            $join->on('billing_owner.bulan_sbl', '=', 'billing_lebih_bayar.bulan');
                            $join->on('billing_owner.tahun_sbl', '=', 'billing_lebih_bayar.tahun');
                        
                        })
                    ->where('billing_owner.status', '=', 1)
                    ->get();            
            return view('app', [
                                'module' => 'bill_owner',
                                'data' => $temp
                            ]);
        }
        elseif(Auth::user()->priv_status==10){
            $temp = BillOwner::select(DB::raw('billing_owner.*,mst_unit_owner.*, mst_title.*, mst_unit_apart.*, mst_floor.*, mst_tower.*,v_billing_denda.total_denda,billing_lebih_bayar.total_lebih_bayar'))
                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','billing_owner.id_unit_owner')
                    ->join('mst_title','mst_unit_owner.id_title','=','mst_title.id_title')
                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                    ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                    ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                    ->leftJoin('v_billing_denda', function($join)
                        {
                            $join->on('billing_owner.id_unit_owner', '=', 'v_billing_denda.id_unit_owner');
                            $join->on('billing_owner.bulan_sbl', '=', 'v_billing_denda.bulan');
                            $join->on('billing_owner.tahun_sbl', '=', 'v_billing_denda.tahun');
                        
                        })
                    ->leftJoin('billing_lebih_bayar', function($join)
                        {
                            $join->on('billing_owner.id_unit_owner', '=', 'billing_lebih_bayar.id_unit_owner');
                            $join->on('billing_owner.bulan_sbl', '=', 'billing_lebih_bayar.bulan');
                            $join->on('billing_owner.tahun_sbl', '=', 'billing_lebih_bayar.tahun');
                        
                        })
                    ->where('billing_owner.status', '=', 1)
                    ->get();
            return view('app', [
                                'module' => 'bill_owner',
                                'data' => $temp
                            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUnitOwner = DB::table("mst_unit_owner")
                                ->select(DB::raw("mst_unit_owner.id_unit_owner, 
                                    concat(mst_tower.kode_tower,mst_floor.no_floor,mst_unit_apart.no_unit_apart, ' - ', mst_unit_owner.nama_depan) as namaPenghuni,
                                    mst_unit_apart.luas_unit, air_meter.air_awal,
                                    air_meter.air_akhir, listrik_meter.listrik_awal, listrik_meter.listrik_akhir"))
                                ->Join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                ->Join('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
                                ->Join('mst_tower','mst_tower.id_tower', '=', 'mst_unit_apart.id_tower')
                                ->Join('mst_floor','mst_floor.id_floor', '=', 'mst_unit_apart.id_floor')
                                ->Join('listrik_meter','listrik_meter.id_unit_apart','=','mst_unit_apart.id_unit_apart')
                                ->Join('air_meter','air_meter.id_unit_apart','=','mst_unit_apart.id_unit_apart')
                                ->get();
        $dataBillType = BillType::select('*')
                                ->where('status','=',1)
                                ->get();
        $get_listrik = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',1)
                                ->first();
        $get_air = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',2)
                                ->first();
        $get_sc = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',3)
                                ->first();
        $get_pbb = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',5)
                                ->first();
        $get_insurance = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',6)
                                ->first();
        $get_sinking = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',7)
                                ->first();
        $get_admin = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',8)
                                ->first();
        $get_pju = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',9)
                                ->first();
        $get_ppn = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',10)
                                ->first();
        $get_fix_load = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',11)
                                ->first();
        $get_materai = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',12)
                                ->first();
        $get_service_fee = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',13)
                                ->first();
        $get_sharing_fee = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',14)
                                ->first();
        $get_slf_fee = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',15)
                                ->first();
        $get_hgb_fee = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',16)
                                ->first();
        $get_parking_fee = DB::table('mst_bill_type')
                                ->where('id_bill_type','=',17)
                                ->first();
        return view('app', [
                                'module' => 'bill_owner',
                                'action' => 'add',
                                'data_unit_owner' => $dataUnitOwner,
                                'data_bill_type' => $dataBillType,
                                'get_listrik' => $get_listrik,
                                'get_air' => $get_air,
                                'get_sc' => $get_sc,
                                'get_pbb' => $get_pbb,
                                'get_insurance' => $get_insurance,
                                'get_sinking' => $get_sinking,
                                'get_admin' => $get_admin,
                                'get_pju' => $get_pju,
                                'get_ppn' => $get_ppn,
                                'get_fix_load' => $get_fix_load,
                                'get_materai' => $get_materai,
                                'get_service_fee' => $get_service_fee,
                                'get_sharing_fee' => $get_sharing_fee,
                                'get_slf_fee' => $get_slf_fee,
                                'get_hgb_fee' => $get_hgb_fee,
                                'get_parking_fee' => $get_parking_fee
                            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data_unit_owner = DB::table("mst_unit_owner")
                                    ->select(DB::raw("CONCAT(kode_tower,no_floor,no_unit_apart) as nama_apart, mst_unit_owner.id_unit_apart"))
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                                    ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                                    ->where('mst_unit_owner.id_unit_owner', '=', $request->id_unit_owner)
                                    ->first();
            
        $no_bill_owner_last = DB::table("billing_owner")
                                    ->select(DB::raw('billing_num'))
                                    ->where('id_unit_owner', '=', $request->id_unit_owner)
                                    ->orderBy('billing_num', 'desc')
                                    ->first();

        if (!empty($no_bill_owner_last)) {
            $nextNomor = $no_bill_owner_last->billing_num;
        }
        else{
            $nextNomor = 0;
        }

        if ($nextNomor > 0 ) {
            $nextNomor++;
        }
        else{
            $nextNomor = 1;
        }        

        $strNextNomor = str_pad($nextNomor,4,"0",STR_PAD_LEFT);
        $generate_billing_num = "BILL/".$data_unit_owner->nama_apart."/".$strNextNomor;
        
        $bill_owner = new BillOwner;
        $bill_owner->kode_billing = $generate_billing_num;
        $bill_owner->billing_num = $nextNomor;
        $bill_owner->id_unit_owner = $request->id_unit_owner;
        
        // LISTRIK
        $bill_owner->jml_sebelum = str_replace(",","", $request->jml_sebelum);
        $bill_owner->jml_sesudah = str_replace(",","", $request->jml_sesudah);
        $bill_owner->total_pemakaian = str_replace(",","", $request->total_pemakaian);
        $bill_owner->jml_rate = str_replace(",","", $request->jml_rate);
        $bill_owner->jml_pemakaian = str_replace(",","", $request->jml_pemakaian);
        $bill_owner->jml_daya_terpasang = str_replace(",","", $request->daya_terpasang);
        $bill_owner->jml_biaya_pemeliharaan =  str_replace(",","", $request->biaya_pemeliharaan);
        $bill_owner->total_pemeliharaan = str_replace(",","", $request->total_pemeliharaan);
        $bill_owner->jml_bagian_bersama = str_replace(",","", $request->bagian_bersama);
        $bill_owner->total_bagian_bersama = str_replace(",","", $request->total_bagian_bersama);
        $bill_owner->jml_biaya_bpju = str_replace(",","", $request->jml_biaya_bpju);
        $bill_owner->jml_biaya_admin = str_replace(",","", $request->biaya_admin);
        $bill_owner->jml_biaya_ppn = str_replace(",","", $request->jml_biaya_ppn);
        $bill_owner->jml_bpju_admin_ppn = str_replace(",","", $request->jml_bpju_admin_ppn);
        $bill_owner->total_tagihan = str_replace(",","", $request->total_tagihan);
        // LISTRIK

        // AIR
        $bill_owner->jml_sebelum_air = str_replace(",","", $request->jml_sebelum_air);
        $bill_owner->jml_sesudah_air = str_replace(",","", $request->jml_sesudah_air);
        $bill_owner->total_pemakaian_air = str_replace(",","", $request->total_pemakaian_air);
        $bill_owner->jml_rate_air = str_replace(",","", $request->jml_rate_air);
        $bill_owner->jml_pemakaian_air = str_replace(",","", $request->jml_pemakaian_air);
        $bill_owner->jml_beban_tetap = str_replace(",","", $request->jml_beban_tetap);
        $bill_owner->jml_biaya_admin_air = str_replace(",","", $request->biaya_admin_air);
        $bill_owner->jml_biaya_ppn_air = str_replace(",","", $request->jml_biaya_ppn_air);
        $bill_owner->jml_tetap_admin_ppn = str_replace(",","", $request->jml_tetap_admin_ppn);
        $bill_owner->total_tagihan_air = str_replace(",","", $request->jml_tagihan_air);
        // AIR

        //SC-IKKL
        $bill_owner->keterangan_sc_ikkl = $request->keterangan_sc_ikkl;
        $bill_owner->luas_unit = str_replace(",","", $request->luas_unit);
        $bill_owner->harga_service_charge = str_replace(",","", $request->harga_service_charge);
        $bill_owner->total_service_charge = str_replace(",","", $request->total_service_charge);
        $bill_owner->biaya_asuransi = str_replace(",","", $request->biaya_asuransi);
        $bill_owner->jml_biaya_asuransi = str_replace(",","", $request->jml_biaya_asuransi);
        $bill_owner->biaya_pbb = str_replace(",","", $request->biaya_pbb);
        $bill_owner->jml_biaya_pbb = str_replace(",","", $request->jml_biaya_pbb);
        $bill_owner->biaya_sinking_fund = str_replace(",","", $request->biaya_sinking_fund);
        $bill_owner->jml_sinking_fund = str_replace(",","", $request->jml_sinking_fund);
        $bill_owner->biaya_slf = str_replace(",","", $request->biaya_slf);
        $bill_owner->jml_slf = str_replace(",","", $request->jml_slf);
        $bill_owner->biaya_hgb = str_replace(",","", $request->biaya_hgb);
        $bill_owner->jml_hgb = str_replace(",","", $request->jml_hgb);
        $bill_owner->biaya_parkir = str_replace(",","", $request->biaya_parkir);
        $bill_owner->jml_parkir = str_replace(",","", $request->jml_parkir);
        $bill_owner->ppn_sc_ikkl = str_replace(",","", $request->ppn_sc_ikkl);
        $bill_owner->jml_sc_ikkl = str_replace(",","", $request->jml_sc_ikkl);
        //SC-IKKL

        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_cetak);
        $bill_owner->tgl_cetak = $date;
        $date1 = \DateTime::createFromFormat('d-m-Y', $request->tgl_jatuh_tempo);
        $bill_owner->tgl_jatuh_tempo = $date1;
        $date2 = date('Y-m-d', strtotime('+5 days', strtotime($request->tgl_jatuh_tempo)));
        $bill_owner->tgl_grace_periode = $date2;
        $tagihan_listrik = str_replace(",","", $request->total_tagihan);
        $tagihan_air = str_replace(",","", $request->jml_tagihan_air);
        $tagihan_sc_ikkl = str_replace(",","", $request->jml_sc_ikkl);
        $bill_owner->biaya_materai = str_replace(",","", $request->biaya_materai);
        $biaya_materai = str_replace(",","", $request->biaya_materai);
        $totalTagihan = $tagihan_listrik + $tagihan_air + $tagihan_sc_ikkl + $biaya_materai;
        $bill_owner->total_tagihan_all = $totalTagihan;
        $jmlBayar = $totalTagihan - $bill_owner->jml_bayar;
        $bill_owner->sisa_tagihan = $jmlBayar;
        $bill_owner->status = 1;

        $tgl_denda_sebelumnya = date("m-Y", strtotime($date->format("Y-m-d") . "-1 month"));
        $pecah_tgl = explode("-",$tgl_denda_sebelumnya);
        $bulan = $pecah_tgl[0];
        $tahun = $pecah_tgl[1];

        $bill_owner->bulan_sbl = $bulan;
        $bill_owner->tahun_sbl = $tahun;

        $tgl_bayar_sebelumnya = date("m-Y", strtotime(date( "Y-m-d",strtotime($request->tgl_cetak)) . "-1 month"));
        $pecah_tgl_lebih_bayar = explode("-",$tgl_bayar_sebelumnya);
        $bulan_lebih_bayar = $pecah_tgl_lebih_bayar[0];
        $tahun_lebih_bayar = $pecah_tgl_lebih_bayar[1];
        $lebih_bayar = BillLebihBayar::select('total_lebih_bayar')
            ->where('id_unit_owner','=',$request->id_unit_owner)
            ->where('bulan','=',$bulan_lebih_bayar)
            ->where('tahun','=',$tahun_lebih_bayar)
            ->get();
            
        if(count($lebih_bayar)>0){
            $total_lebih_bayar = $lebih_bayar[0]->total_lebih_bayar;

            $bill_owner->jml_bayar = $total_lebih_bayar;
            $bill_owner->sisa_tagihan = $bill_owner->total_tagihan_all - $total_lebih_bayar;
        }
        else{
            $total_lebih_bayar = 0;
        }
        $bill_owner->save();

        if(count($lebih_bayar)>0){
            $no_pay_owner_last = DB::table("payment_owner")
                            ->select(DB::raw('payment_num'))
                            ->where('id_unit_owner', '=', $request->id_unit_owner)
                            ->orderBy('payment_num', 'desc')
                            ->first();

            if (!empty($no_pay_owner_last)) {
                $nextNomor = $no_pay_owner_last->payment_num;
            }
            else{
                $nextNomor = 0;
            }
    
            if ($nextNomor > 0 ) {
                $nextNomor++;
            }
            else{
                $nextNomor = 1;
            }
    
            // 5 = 00005
            $strNextNomor = str_pad($nextNomor,4,"0",STR_PAD_LEFT);
            // 00003
            $generate_payment_num = "PAY/".$data_unit_owner->nama_apart."/".$strNextNomor;

            $payment_owner = new PaymentOwner;

            $payment_owner->kode_payment = $generate_payment_num;
            $payment_owner->payment_num = $nextNomor;
            $payment_owner->id_billing_owner = $bill_owner->id_billing_owner;
            $payment_owner->id_unit_owner = $request->id_unit_owner;
            $payment_owner->periode_bayar = \DateTime::createFromFormat('d-m-Y', $request->tgl_cetak)->format('Y-m-d');
            $payment_owner->tgl_bayar = date("Y-m-d H:i:s");
            $payment_owner->jml_bayar = str_replace(",","", $lebih_bayar[0]->total_lebih_bayar);
            $payment_owner->keterangan = 'Lebih bayar bulan lalu';

            $payment_owner->status = 1;
            $payment_owner->save();
        }

        return redirect('/bill_owner')->with('success', 'New Bill Owner has been Submit!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill_owner = BillOwner::find($id);
        $data_unit_owner = DB::table("mst_unit_owner")
                                    ->select(DB::raw("mst_unit_owner.id_unit_owner, 
                                        concat(mst_unit_owner.nama_depan) as namaPenghuni, concat(mst_tower.kode_tower,mst_floor.no_floor,mst_unit_apart.no_unit_apart) as namaApart"))
                                    ->Join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->Join('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
                                    ->Join('mst_tower','mst_tower.id_tower', '=', 'mst_unit_apart.id_tower')
                                    ->Join('mst_floor','mst_floor.id_floor', '=', 'mst_unit_apart.id_floor')
                                    ->where('mst_unit_owner.id_unit_owner', $bill_owner->id_unit_owner)
                                    ->first();
        
        $payment_owner = DB::table('payment_owner')
                                ->select(DB::raw('payment_owner.*'))
                                ->leftJoin('billing_owner', 'billing_owner.id_billing_owner', '=', 'payment_owner.id_billing_owner')
                                ->where('payment_owner.id_billing_owner', $bill_owner->id_billing_owner)
                                ->where('payment_owner.status', 1)
                                ->orderBy('updated_at', 'desc')
                                ->get();
        $bill_owner->tgl_cetak= \DateTime::createFromFormat('Y-m-d', $bill_owner->tgl_cetak)->format('d-m-Y');
        $bill_owner->tgl_jatuh_tempo= \DateTime::createFromFormat('Y-m-d', $bill_owner->tgl_jatuh_tempo)->format('d-m-Y');
        $bill_owner->tgl_grace_periode= \DateTime::createFromFormat('Y-m-d', $bill_owner->tgl_grace_periode)->format('d-m-Y');

        $tgl_denda_sebelumnya = date("m-Y", strtotime(date( "Y-m-d",strtotime($bill_owner->tgl_cetak)) . "-1 month"));
        $pecah_tgl = explode("-",$tgl_denda_sebelumnya);
        $bulan = $pecah_tgl[0];
        $tahun = $pecah_tgl[1];
        $denda = BillDenda::select('total_denda')
                ->where('id_unit_owner','=',$bill_owner->id_unit_owner)
                ->where('bulan','=',$bulan)
                ->where('tahun','=',$tahun)
                ->get();
        if(count($denda)>0){
            $total_denda = $denda[0]->total_denda;
        }
        else{
            $total_denda = 0;
        }

        $tgl_bayar_sebelumnya = date("m-Y", strtotime(date( "Y-m-d",strtotime($bill_owner->tgl_cetak)) . "-1 month"));
        $pecah_tgl_lebih_bayar = explode("-",$tgl_bayar_sebelumnya);
        $bulan_lebih_bayar = $pecah_tgl_lebih_bayar[0];
        $tahun_lebih_bayar = $pecah_tgl_lebih_bayar[1];
        $lebih_bayar = BillLebihBayar::select('total_lebih_bayar')
                ->where('id_unit_owner','=',$bill_owner->id_unit_owner)
                ->where('bulan','=',$bulan_lebih_bayar)
                ->where('tahun','=',$tahun_lebih_bayar)
                ->get();
        if(count($lebih_bayar)>0){
            $total_lebih_bayar = $lebih_bayar[0]->total_lebih_bayar;
        }
        else{
            $total_lebih_bayar = 0;
        }

        return view('app', [
                        'id' => $id,
                        'module' => 'bill_owner',
                        'action' => 'view',
                        'data_unit_owner' => $data_unit_owner,
                        'bill_owner' => $bill_owner,
                        'payment_owner' => $payment_owner,
                        'denda' => $total_denda,
                        'lebih_bayar' => $total_lebih_bayar
                    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = BillOwner::find($id);

        $data_unit_owner = DB::table("mst_unit_owner")
                            ->select(DB::raw("mst_unit_owner.id_unit_owner, 
                                concat(mst_unit_apart.no_unit_apart, ' - ', mst_unit_owner.nama_depan) as namaPenghuni, mst_tower.kode_tower, mst_floor.no_floor, mst_unit_apart.luas_unit"))
                            ->Join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                            ->Join('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
                            ->Join('mst_tower','mst_tower.id_tower', '=', 'mst_unit_apart.id_tower')
                            ->Join('mst_floor','mst_floor.id_floor', '=', 'mst_unit_apart.id_floor')
                            ->get();
                            
        $data->tgl_cetak= \DateTime::createFromFormat('Y-m-d', $data->tgl_cetak)->format('d-m-Y');
        $data->tgl_jatuh_tempo= \DateTime::createFromFormat('Y-m-d', $data->tgl_jatuh_tempo)->format('d-m-Y');
        $data->tgl_grace_periode= \DateTime::createFromFormat('Y-m-d', $data->tgl_grace_periode)->format('d-m-Y');
        
        return view('app', [
                                'id' => $id,
                                'module' => 'bill_owner',
                                'action' => 'edit',
                                'data_unit_owner' => $data_unit_owner,
                                'data' => $data
                            ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bill_owner = BillOwner::find($id);
        // LISTRIK
        $date = \DateTime::createFromFormat('d-m-Y', $request->periode_tagihan_awal);
        $bill_owner->periode_tagihan_awal = $date;
        $date2 = \DateTime::createFromFormat('d-m-Y', $request->periode_tagihan_akhir);
        $bill_owner->periode_tagihan_akhir = $date2;
        $bill_owner->keterangan = $request->keterangan;
        $bill_owner->jml_sebelum = str_replace(",","", $request->jml_sebelum);
        $bill_owner->jml_sesudah = str_replace(",","", $request->jml_sesudah);
        $bill_owner->total_pemakaian = str_replace(",","", $request->total_pemakaian);
        $bill_owner->jml_rate = str_replace(",","", $request->jml_rate);
        $bill_owner->jml_pemakaian = str_replace(",","", $request->jml_pemakaian);
        $bill_owner->jml_daya_terpasang = str_replace(",","", $request->daya_terpasang);
        $bill_owner->jml_biaya_pemeliharaan =  str_replace(",","", $request->biaya_pemeliharaan);
        $bill_owner->total_pemeliharaan = str_replace(",","", $request->total_pemeliharaan);
        $bill_owner->jml_bagian_bersama = str_replace(",","", $request->bagian_bersama);
        $bill_owner->total_bagian_bersama = str_replace(",","", $request->total_bagian_bersama);
        $bill_owner->jml_biaya_bpju = str_replace(",","", $request->jml_biaya_bpju);
        $bill_owner->jml_biaya_admin = str_replace(",","", $request->biaya_admin);
        $bill_owner->jml_biaya_ppn = str_replace(",","", $request->jml_biaya_ppn);
        $bill_owner->jml_bpju_admin_ppn = str_replace(",","", $request->jml_bpju_admin_ppn);
        $bill_owner->total_tagihan = str_replace(",","", $request->total_tagihan);
        // LISTRIK

        // AIR
        $date3 = \DateTime::createFromFormat('d-m-Y', $request->periode_tagihan_awal_air);
        $bill_owner->periode_tagihan_awal_air = $date3;
        $date4 = \DateTime::createFromFormat('d-m-Y', $request->periode_tagihan_akhir_air);
        $bill_owner->periode_tagihan_akhir_air = $date4;
        $bill_owner->keterangan_air = $request->keterangan_air;
        $bill_owner->jml_sebelum_air = str_replace(",","", $request->jml_sebelum_air);
        $bill_owner->jml_sesudah_air = str_replace(",","", $request->jml_sesudah_air);
        $bill_owner->total_pemakaian_air = str_replace(",","", $request->total_pemakaian_air);
        $bill_owner->jml_pemakaian_air = str_replace(",","", $request->jml_pemakaian_air);
        $bill_owner->jml_rate_air = str_replace(",","", $request->jml_rate_air);
        $bill_owner->jml_beban_tetap = str_replace(",","", $request->jml_beban_tetap);
        $bill_owner->jml_biaya_admin_air = str_replace(",","", $request->biaya_admin_air);
        $bill_owner->jml_biaya_ppn_air = str_replace(",","", $request->jml_biaya_ppn_air);
        $bill_owner->jml_tetap_admin_ppn = str_replace(",","", $request->jml_tetap_admin_ppn);
        $bill_owner->total_tagihan_air = str_replace(",","", $request->jml_tagihan_air);
        // AIR

        //SC-IKKL
        $bill_owner->keterangan_sc_ikkl = $request->keterangan_sc_ikkl;
        $bill_owner->luas_unit = str_replace(",","", $request->luas_unit);
        $bill_owner->harga_service_charge = str_replace(",","", $request->harga_service_charge);
        $bill_owner->total_service_charge = str_replace(",","", $request->total_service_charge);
        $bill_owner->ppn_sc_ikkl = str_replace(",","", $request->ppn_sc_ikkl);
        $bill_owner->jml_sc_ikkl = str_replace(",","", $request->jml_sc_ikkl);
        //SC-IKKL

        $tglSkrg = Date('Y-m-d');
        $bill_owner->tgl_cetak = $tglSkrg;
        $tgl_jatuh_tempo = date("Y-m-d", strtotime('+7 days'));
        $bill_owner->tgl_jatuh_tempo = $tgl_jatuh_tempo;
        $tagihan_listrik = str_replace(",","", $request->total_tagihan);
        $tagihan_air = str_replace(",","", $request->jml_tagihan_air);
        $tagihan_sc_ikkl = str_replace(",","", $request->jml_sc_ikkl);
        $bill_owner->total_tagihan_all = $tagihan_listrik + $tagihan_air + $tagihan_sc_ikkl;
        $bill_owner->status = 1;

        $bill_owner->save();
        
        //hitung ulang sisa tagihan
        $sisa_tagihan = $bill_owner->total_tagihan_all - $bill_owner->jml_bayar;
        $bill_owner->sisa_tagihan = $sisa_tagihan;
        $bill_owner->save();

        $pay_owner_data = DB::table("payment_owner")
                                            ->select(DB::raw('*'))
                                            ->where('id_billing_owner', '=', $bill_owner->id_billing_owner)
                                            ->where('id_unit_owner', '=', $bill_owner->id_unit_owner)
                                            ->orderBy('id_payment_owner', 'asc')
                                            ->get();    
        return redirect('/bill_owner')->with('success', "Bill Owner '" . $bill_owner->kode_billing . "' has been Updated!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill_owner = BillOwner::find($id);
        $bill_owner->status = 0;

        $bill_owner->save();
        Session::flash('flash_message', 'Bill Owner ' . $bill_owner->kode_billing . '  have been Deleted!!');
        Session::flash('penting', true);
        return redirect('/bill_owner');
    }
    public function deleteTemplate($id)
    {
        $data = BillOwner::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'bill_owner',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
    public function setPayment($id)
    {
        $bill_owner = BillOwner::find($id);

        $bill_owner->tgl_cetak= \DateTime::createFromFormat('Y-m-d', $bill_owner->tgl_cetak)->format('d-m-Y');
        $bill_owner->tgl_jatuh_tempo= \DateTime::createFromFormat('Y-m-d', $bill_owner->tgl_jatuh_tempo)->format('d-m-Y');
        $bill_owner->tgl_grace_periode= \DateTime::createFromFormat('Y-m-d', $bill_owner->tgl_grace_periode)->format('d-m-Y');

        $data_unit_owner = DB::table("mst_unit_owner")
                                    ->select(DB::raw("mst_unit_owner.id_unit_owner, 
                                        concat(mst_unit_owner.nama_depan) as namaPenghuni, mst_tower.kode_tower, mst_floor.no_floor, mst_unit_apart.no_unit_apart"))
                                    ->Join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->Join('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
                                    ->Join('mst_tower','mst_tower.id_tower', '=', 'mst_unit_apart.id_tower')
                                    ->Join('mst_floor','mst_floor.id_floor', '=', 'mst_unit_apart.id_floor')
                                    ->where('mst_unit_owner.id_unit_owner', $bill_owner->id_unit_owner)
                                    ->first();
                                    
        $payment_owner = DB::table('payment_owner')
                                ->select(DB::raw('payment_owner.*'))
                                ->leftJoin('billing_owner', 'billing_owner.id_billing_owner', '=', 'payment_owner.id_billing_owner')
                                ->where('payment_owner.id_billing_owner', $bill_owner->id_billing_owner)
                                ->where('payment_owner.status', 1)
                                ->orderBy('updated_at', 'desc')
                                ->get();

        $tgl_denda_sebelumnya = date("m-Y", strtotime(date( "Y-m-d",strtotime($bill_owner->tgl_cetak)) . "-1 month"));
        $pecah_tgl = explode("-",$tgl_denda_sebelumnya);
        $bulan = $pecah_tgl[0];
        $tahun = $pecah_tgl[1];
        $denda = DB::table('v_billing_denda')
                ->select('total_denda')
                ->where('id_unit_owner','=',$bill_owner->id_unit_owner)
                ->where('bulan','=',$bulan)
                ->where('tahun','=',$tahun)
                ->get();
        if(count($denda)>0){
            $total_denda = $denda[0]->total_denda;
        }
        else{
            $total_denda = 0;
        }

        $tgl_bayar_sebelumnya = date("m-Y", strtotime(date( "Y-m-d",strtotime($bill_owner->tgl_cetak)) . "-1 month"));
        $pecah_tgl_lebih_bayar = explode("-",$tgl_bayar_sebelumnya);
        $bulan_lebih_bayar = $pecah_tgl_lebih_bayar[0];
        $tahun_lebih_bayar = $pecah_tgl_lebih_bayar[1];
        $lebih_bayar = BillLebihBayar::select('total_lebih_bayar')
                ->where('id_unit_owner','=',$bill_owner->id_unit_owner)
                ->where('bulan','=',$bulan_lebih_bayar)
                ->where('tahun','=',$tahun_lebih_bayar)
                ->get();
        if(count($lebih_bayar)>0){
            $total_lebih_bayar = $lebih_bayar[0]->total_lebih_bayar;
        }
        else{
            $total_lebih_bayar = 0;
        }

        return view('app', [
                                'id' => $id,
                                'module' => 'bill_owner',
                                'action' => 'set_payment',
                                'data_unit_owner' => $data_unit_owner,
                                'bill_owner' => $bill_owner,
                                'payment_owner' => $payment_owner,
                                'denda' => $total_denda,
                                'lebih_bayar' => $total_lebih_bayar
                            ]);
    }
    public function savePayment(Request $request, $id){
        $bill_owner = BillOwner::find($id);

        $dataUnitOwner = DB::table("mst_unit_owner")
                        ->select(DB::raw("CONCAT(kode_tower,no_floor,no_unit_apart) as nama_apart, mst_unit_owner.id_unit_apart"))
                        ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                        ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                        ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                        ->where('mst_unit_owner.id_unit_owner', $bill_owner->id_unit_owner)
                        ->first();

        $no_pay_owner_last = DB::table("payment_owner")
                            ->select(DB::raw('payment_num'))
                            ->where('id_unit_owner', '=', $bill_owner->id_unit_owner)
                            ->orderBy('payment_num', 'desc')
                            ->first();

        $tgl_bayar_sebelumnya = date("m-Y", strtotime(date( "Y-m-d",strtotime($bill_owner->tgl_cetak)) . "-1 month"));
        $pecah_tgl_lebih_bayar = explode("-",$tgl_bayar_sebelumnya);
        $bulan_lebih_bayar = $pecah_tgl_lebih_bayar[0];
        $tahun_lebih_bayar = $pecah_tgl_lebih_bayar[1];
        $lebih_bayar = BillLebihBayar::select('total_lebih_bayar')
            ->where('id_unit_owner','=',$bill_owner->id_unit_owner)
            ->where('bulan','=',$bulan_lebih_bayar)
            ->where('tahun','=',$tahun_lebih_bayar)
            ->get();

            
        if(count($lebih_bayar)>0){
            $total_lebih_bayar = $lebih_bayar[0]->total_lebih_bayar;
        }
        else{
            $total_lebih_bayar = 0;
        }

        $tgl_denda_sebelumnya = date("m-Y", strtotime(date( "Y-m-d",strtotime($bill_owner->tgl_cetak)) . "-1 month"));
        $pecah_tgl = explode("-",$tgl_denda_sebelumnya);
        $bulan = $pecah_tgl[0];
        $tahun = $pecah_tgl[1];
        $denda = DB::table('v_billing_denda')
                ->select('total_denda')
                ->where('id_unit_owner','=',$bill_owner->id_unit_owner)
                ->where('bulan','=',$bulan)
                ->where('tahun','=',$tahun)
                ->get();
        if(count($denda)>0){
            $total_denda = $denda[0]->total_denda;
        }
        else{
            $total_denda = 0;
        }
        
        if (!empty($no_pay_owner_last)) {
            $nextNomor = $no_pay_owner_last->payment_num;
        }
        else{
            $nextNomor = 0;
        }

        if ($nextNomor > 0 ) {
            $nextNomor++;
        }
        else{
            $nextNomor = 1;
        }

        // 5 = 00005
        $strNextNomor = str_pad($nextNomor,4,"0",STR_PAD_LEFT);
        // 00003
        $generate_payment_num = "PAY/".$dataUnitOwner->nama_apart."/".$strNextNomor;
        
        $payment_owner = new PaymentOwner;
        $payment_owner->kode_payment = $generate_payment_num;
        $payment_owner->payment_num = $nextNomor;
        $payment_owner->id_billing_owner = $bill_owner->id_billing_owner;
        $payment_owner->id_unit_owner = $bill_owner->id_unit_owner;
        $payment_owner->periode_bayar = \DateTime::createFromFormat('d-m-Y', $request->tgl_bayar)->format('Y-m-d');
        $payment_owner->tgl_bayar = date("Y-m-d H:i:s");
        $payment_owner->jml_bayar = str_replace(",","", $request->jml_bayar);
        $payment_owner->keterangan = $request->descriptionPay;

        $payment_owner->status = 1;

        //update table billing_owner
        $ygSudahDibayar = str_replace(",","", $bill_owner->jml_bayar);
        $bill_owner->jml_bayar = $ygSudahDibayar + str_replace(",","", $request->jml_bayar);
        $sisa_tagihan = $bill_owner->total_tagihan_all - $bill_owner->jml_bayar;
        $bill_owner->sisa_tagihan = $sisa_tagihan;

        //Hitung Denda
        $tgl_cetak = $bill_owner->tgl_cetak;
        $tgl_jatuh_tempo = $bill_owner->tgl_jatuh_tempo;
        $tgl_grace_periode = $bill_owner->tgl_grace_periode;
        $tgl_bayar = $payment_owner->periode_bayar;
        
        $tglCetak = new DateTime($tgl_cetak);
        $tglJatuhTempo = new DateTime($tgl_jatuh_tempo);
        $tglGracePeriode = new DateTime($tgl_grace_periode);
        $tglBayar = new DateTime($tgl_bayar);

        if($tglBayar > $tglGracePeriode){
            $denda = new BillDenda;
            
            $denda->id_unit_owner = $bill_owner->id_unit_owner;
            $denda->id_billing_owner = $bill_owner->id_billing_owner;
            $denda->bulan = $tglBayar->format("n");
            $denda->tahun = $tglBayar->format("Y");
            $selisih_hari = $tglBayar->diff($tglGracePeriode);
            $denda->jml_hari_denda = $selisih_hari->format('%a');
            $denda->total_denda = ($payment_owner->jml_bayar * (1 / 1000)) * $selisih_hari->format('%a');
            
            $denda->save();
        }

        $total_juml_tagihan = $bill_owner->total_tagihan_all - $total_lebih_bayar;

        if($bill_owner->jml_bayar > $total_juml_tagihan){
            $lebih_bayar = new BillLebihBayar;
            
            $lebih_bayar->id_unit_owner = $bill_owner->id_unit_owner;
            $lebih_bayar->id_billing_owner = $bill_owner->id_billing_owner;
            $lebih_bayar->bulan = $tglBayar->format("n");
            $lebih_bayar->tahun = $tglBayar->format("Y");
            $lebih_bayar->total_lebih_bayar = ($bill_owner->jml_bayar - ($bill_owner->total_tagihan_all + $total_denda)) + $total_lebih_bayar;
            $bill_owner->sisa_tagihan = 0;
            
            $lebih_bayar->save();
        }

        $bill_owner->save();
        $payment_owner->save();
        
        return redirect()->route('setPay', ['id' => $bill_owner->id_billing_owner]);
        //return redirect('/bill_owner')->with('success', "Bill Owner '" . $bill_owner->kode_billing . "' has been Updated!!");
    }

    public function export()
    {
        return Excel::download(new BillOwnerExport, 'Billing.xlsx');
    }

    public function exportFaktur()
    {
        return Excel::download(new BillOwnerExportFaktur, 'E-Faktur Format.xlsx');
    }

    public function exportFormat() 
    {
        return Excel::download(new BillOwnerExportFormat, 'Billing.xlsx');
    }

    public function invoice(Request $request, $id)
    {
        $billing_owner = BillOwner::select(DB::raw('billing_owner.*,mst_unit_owner.*, mst_title.*, mst_unit_apart.*, mst_floor.*, mst_tower.*,v_billing_denda.total_denda,billing_lebih_bayar.total_lebih_bayar'))
            ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','billing_owner.id_unit_owner')
            ->join('mst_title','mst_unit_owner.id_title','=','mst_title.id_title')
            ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
            ->leftJoin('v_billing_denda', function($join)
                {
                    $join->on('billing_owner.id_unit_owner', '=', 'v_billing_denda.id_unit_owner');
                    $join->on('billing_owner.bulan_sbl', '=', 'v_billing_denda.bulan');
                    $join->on('billing_owner.tahun_sbl', '=', 'v_billing_denda.tahun');
                
                })
            ->leftJoin('billing_lebih_bayar', function($join1)
                {
                    $join1->on('billing_owner.id_unit_owner', '=', 'billing_lebih_bayar.id_unit_owner');
                    $join1->on('billing_owner.bulan_sbl', '=', 'billing_lebih_bayar.bulan');
                    $join1->on('billing_owner.tahun_sbl', '=', 'billing_lebih_bayar.tahun');
                
                })
            ->where('billing_owner.id_billing_owner', '=', $id)
            ->get();
        
        $billing_owner[0]->tgl_cetak= \DateTime::createFromFormat('Y-m-d', $billing_owner[0]->tgl_cetak)->format('d-m-Y');
        $billing_owner[0]->tgl_jatuh_tempo= \DateTime::createFromFormat('Y-m-d', $billing_owner[0]->tgl_jatuh_tempo)->format('d-m-Y');
        view()->share('billing_owner', $billing_owner);
        $customPaper = array(0,0,612.00,792.00); // <-- 8,5 x 11
        $pdf = PDF::loadView('invoice')->setPaper($customPaper,'landscape');
        return $pdf->stream('invoice.pdf');
    }

    public function multi_invoice(Request $request,$id)
    {
        $get_param = explode(",",$id);
        $billing_owner = BillOwner::select(DB::raw('billing_owner.*,mst_unit_owner.*, mst_title.*, mst_unit_apart.*, mst_floor.*, mst_tower.*,v_billing_denda.total_denda,billing_lebih_bayar.total_lebih_bayar'))
            ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','billing_owner.id_unit_owner')
            ->join('mst_title','mst_unit_owner.id_title','=','mst_title.id_title')
            ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
            ->leftJoin('v_billing_denda', function($join)
                {
                    $join->on('billing_owner.id_unit_owner', '=', 'v_billing_denda.id_unit_owner');
                    $join->on('billing_owner.bulan_sbl', '=', 'v_billing_denda.bulan');
                    $join->on('billing_owner.tahun_sbl', '=', 'v_billing_denda.tahun');
                
                })
            ->leftJoin('billing_lebih_bayar', function($join1)
                {
                    $join1->on('billing_owner.id_unit_owner', '=', 'billing_lebih_bayar.id_unit_owner');
                    $join1->on('billing_owner.bulan_sbl', '=', 'billing_lebih_bayar.bulan');
                    $join1->on('billing_owner.tahun_sbl', '=', 'billing_lebih_bayar.tahun');
                
                })
            ->whereIn('billing_owner.id_billing_owner', $get_param)
            ->get();

        $billing_owner[0]->tgl_cetak= \DateTime::createFromFormat('Y-m-d', $billing_owner[0]->tgl_cetak)->format('d-m-Y');
        $billing_owner[0]->tgl_jatuh_tempo= \DateTime::createFromFormat('Y-m-d', $billing_owner[0]->tgl_jatuh_tempo)->format('d-m-Y');
        view()->share('billing_owner', $billing_owner);
        $customPaper = array(0,0,612.00,792.00); // <-- 8,5 x 11
        $pdf = PDF::loadView('invoice')->setPaper($customPaper,'landscape');
        return $pdf->stream('invoice.pdf');
    }
    public function get_bills($id)
    {
        $bill_owner = BillOwner::find($id);
        $dataUnitOwner = DB::table("mst_unit_owner")
                                    ->select(DB::raw("mst_unit_owner.id_unit_owner,
                                        concat(mst_unit_owner.nama_depan, ' ', mst_unit_owner.nama_belakang) as namaPenghuni, mst_unit_apart.no_unit_apart"))
                                    ->leftJoin('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->leftJoin('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
                                    ->where('mst_unit_owner.id_unit_owner', $bill_owner->id_unit_owner)
                                    ->first();

        $payment_owner = DB::table('payment_owner')
                                ->select(DB::raw('payment_owner.*'))
                                ->leftJoin('billing_owner', 'billing_owner.id_billing_owner', '=', 'payment_owner.id_billing_owner')
                                ->where('payment_owner.id_billing_owner', $bill_owner->id_billing_owner)
                                ->where('payment_owner.status', 1)
                                ->orderBy('updated_at', 'desc')
                                ->get();
        $bill_owner->tgl_cetak= \DateTime::createFromFormat('Y-m-d', $bill_owner->tgl_cetak)->format('d-m-Y');
        $bill_owner->tgl_jatuh_tempo= \DateTime::createFromFormat('Y-m-d', $bill_owner->tgl_jatuh_tempo)->format('d-m-Y');
 
        return view('v_bill', [
                    'id' => $id,
                    'module' => 'bill_owner',
                    'action' => 'view',
                    'data_unit_owner' => $dataUnitOwner,
                    'bill_owner' => $bill_owner,
                    'payment_owner' => $payment_owner
                ]);
    }
}