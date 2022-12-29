<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillOwner;
use App\BillType;
use App\PaymentOwner;
use DB;
use Session;
use Auth;
use Dompdf\Dompdf;
use PDF;
use DateTime;

class PaymentOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->priv_status==1 || Auth::user()->priv_status==4 || Auth::user()->priv_status==5) {
            return view('app', [
                                'module' => 'payment_owner',
                                'data' => DB::table('payment_owner')
                                            ->select(DB::raw('payment_owner.*, billing_owner.kode_billing, billing_owner.total_tagihan_all,
                                                payment_owner.jml_bayar,
                                                mst_unit_apart.no_unit_apart,
                                                mst_tower.kode_tower,
                                                mst_floor.no_floor'))
                                            ->Join('billing_owner','billing_owner.id_billing_owner','=','payment_owner.id_billing_owner')
                                            ->Join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','payment_owner.id_unit_owner')
                                            ->Join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                                            ->where('payment_owner.status', '=', 1)
                                            ->get()
                            ]);
        }
        elseif(Auth::user()->priv_status==10){
            return view('app', [
                                'module' => 'bill_owner',
                                'data' => PaymentOwner::select('*')
                                            ->join('billing_owner','billing_owner.id_billing_owner','=','payment_owner.id_billing_owner')
                                            ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','payment_owner.id_unit_owner')
                                            ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                            ->where('payment_owner.status', '=', 1)
                                            ->where('mst_unit_owner.login', Auth::user()->login)
                                            ->get()
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
        $billNum = DB::table('billing_owner')
                        ->select(DB::raw('billing_owner.kode_billing, billing_owner.id_billing_owner'))
                        ->where('status', 1)->get();
        $dataUnitOwner = DB::table("mst_unit_owner")
                                    ->select(DB::raw("mst_unit_owner.id_unit_owner, 
                                        concat(mst_unit_apart.no_unit_apart, ' - ', mst_title.nama_title, '. ', mst_unit_owner.nama_depan, ' ', mst_unit_owner.nama_belakang) as namaPenghuni"))
                                    ->leftJoin('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->leftJoin('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
                                    ->get();
        return view('app', [
                                'module' => 'payment_owner',
                                'action' => 'add',
                                'billNum' => $billNum,
                                'data_unit_owner' => $dataUnitOwner
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $payment_owner = PaymentOwner::find($id);
        $payment_owner->periode_bayar = $request->tgl_bayar;
        $payment_owner->jml_bayar = $request->jml_bayar;
        $payment_owner->keterangan = $request->descriptionPay;
        
        $bill_owner = BillOwner::find($payment_owner->id_billing_owner);
        //ubah sisa tagihan sesuai dgn id_payment_owner
        $payment_owner->sisa_tagihan = $bill_owner->total_tagihan_all - $request->jml_bayar;
        //cari sisa tagihan yg lama utk diedit sisa_tagihannya berdasarkan jml_bayar yg baru atau dihapus            
        $pay_owner_data = DB::table("payment_owner")
                                            ->select(DB::raw('*'))
                                            ->where('id_billing_owner', '=', $bill_owner->id_billing_owner)
                                            ->where('id_unit_owner', '=', $bill_owner->id_unit_owner)
                                            ->where('id_payment_owner', '!=', $id)
                                            ->orderBy('id_payment_owner', 'asc')
                                            ->get();
        if ($payment_owner->sisa_tagihan <= 0) {
            foreach ($pay_owner_data as $value) {
                //hapus datanya
                $pay_owner_del = PaymentOwner::where('id_payment_owner', '=', $value->id_payment_owner)
                                ->where('status', '=', 1)
                                ->update(['status' => 0, 'sisa_tagihan' => 0, 'jml_bayar' => 0, 'lunas' => 0]);                     
            }
            $payment_owner->lunas = 1;
            //hitung ulang sisa tagihan pd table billing_owner
            $bill_owner->sisa_tagihan = $bill_owner->total_tagihan_all - $request->jml_bayar;
            $bill_owner->jml_bayar = $request->jml_bayar;
            $bill_owner->save();
        }
        else{
            $i=0;
            foreach ($pay_owner_data as $value) {
                if ($i==0) {
                    //ubah sisa tagihan diambil dari payment_owner->sisa_tagihan yg diatas
                    $sisa_tagihan2 = $payment_owner->sisa_tagihan - $value->jml_bayar; 
                }
                else{
                    $sisa_tagihan2 = $sisa_tagihannya - $value->jml_bayar;
                }
                //hitung ulang sisa tagihannya
                $pay_owner_update = PaymentOwner::where('id_payment_owner', '=', $value->id_payment_owner)
                                ->where('status', '=', 1)
                                ->update(['sisa_tagihan' => $sisa_tagihan2]);
                $sisa_tagihannya = $sisa_tagihan2;
                $i++;                     
            }
            //update jml_bayar pd table billing_owner
            $sumJmlByrPaymentOwner = PaymentOwner::where('id_billing_owner', '=', $bill_owner->id_billing_owner)
                                                    ->where('id_unit_owner', '=', $bill_owner->id_unit_owner)
                                                    ->where('id_payment_owner', '!=', $id)
                                                    ->where('status', '=', 1)
                                                    ->sum('jml_bayar');
            $ttlJmlBayar = $sumJmlByrPaymentOwner + $request->jml_bayar;
            $bill_owner->jml_bayar = $ttlJmlBayar;
            //hitung ulang sisa tagihan pd table billing_owner
            $bill_owner->sisa_tagihan = $sisa_tagihan2;
            $bill_owner->save();       
        }        
        $payment_owner->save();
        return redirect()->route('setPay', ['id' => $bill_owner->id_billing_owner]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function receipt(Request $request, $id)
    {
        $payment_owner = PaymentOwner::select(DB::raw('payment_owner.*,billing_owner.kode_billing,mst_unit_owner.*, mst_title.*, mst_unit_apart.*, mst_floor.*, mst_tower.*'))
            ->join('billing_owner','billing_owner.id_billing_owner','=','payment_owner.id_billing_owner')
            ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','billing_owner.id_unit_owner')
            ->join('mst_title','mst_unit_owner.id_title','=','mst_title.id_title')
            ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
            ->where('payment_owner.id_payment_owner', '=', $id)
            ->get();
        
        // $payment_owner->periode_bayar= \DateTime::createFromFormat('Y-m-d', $payment_owner->periode_bayar)->format('d-m-Y');
        view()->share('payment_owner', $payment_owner);
        $customPaper = array(0,0,612.00,792.00); // <-- 8,5 x 11
        $pdf = PDF::loadView('receipt')->setPaper($customPaper,'landscape');
        return $pdf->stream('receipt.pdf');
    }
}
