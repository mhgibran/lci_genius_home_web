<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Complain;
use App\ComplainCategory;
use App\UnitOwner;
use App\ComplainStatus;
use App\respon;
use DB;
use Auth;
use DateTime;

class ComplainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->priv_status==1 || Auth::user()->priv_status==2 || Auth::user()->priv_status==3) {
            return view('app', [
                                'module' => 'complain',
                                'data' => Complain::select('*')
                                    ->join('mst_complain_status','mst_complain_status.id_complain_status','=','mst_complain.id_complain_status')
                                    ->join('mst_complain_category','mst_complain_category.id_complain_category','=','mst_complain.id_complain_category')
                                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','mst_complain.id_unit_owner')
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->where('mst_complain.status', '=', 1)
                                    ->get()
                            ]); 
        }
        elseif (Auth::user()->priv_status==10) {
            return view('app', [
                                'module' => 'complain',
                                'data' => Complain::select('*')
                                    ->join('mst_complain_status','mst_complain_status.id_complain_status','=','mst_complain.id_complain_status')
                                    ->join('mst_complain_category','mst_complain_category.id_complain_category','=','mst_complain.id_complain_category')
                                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','mst_complain.id_unit_owner')
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->where('mst_complain.status', '=', 1)
                                    ->where('mst_unit_owner.login', '=', Auth::user()->login)
                                    ->get()
                            ]);
        }
        else{
            return view('app', [
                                'module' => 'complain',
                                'data' => Complain::select('*')
                                    ->join('mst_complain_status','mst_complain_status.id_complain_status','=','mst_complain.id_complain_status')
                                    ->join('mst_complain_category','mst_complain_category.id_complain_category','=','mst_complain.id_complain_category')
                                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','mst_complain.id_unit_owner')
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->where('mst_complain.status', '=', 1)
                                    ->whereIn('mst_complain.id_complain_status', [2,3])
                                    ->where('mst_complain_category.priv_status', '=', Auth::user()->priv_status)
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
        $userLogin = Auth::user()->login;
        //$namaCompCategory = new ComplainCategory::where('status','=',1)->get();
        // $id_unit_owner = UnitOwner::select('mst_unit_owner.*')
        //                               ->join('mst_unit_apart', 'mst_unit_apart.id_unit_apart', '=', 'mst_unit_owner.id_unit_apart')  
        //                               ->where('mst_unit_owner.login', '=', $userLogin)
        //                               ->first();
        if (Auth::user()->priv_status ==1 || Auth::user()->priv_status==2 || Auth::user()->priv_status==3) {
            $dataUnitOwner = DB::table("mst_unit_owner")
                                    ->select(DB::raw("mst_unit_owner.id_unit_owner, concat(mst_unit_apart.no_unit_apart, ' - ', mst_title.nama_title, '. ', mst_unit_owner.nama_depan, ' ', mst_unit_owner.nama_belakang) as namaPenghuni"))
                                    ->leftJoin('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->leftJoin('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
                                    //->where('mst_unit_owner.login', '=', $userLogin)
                                    ->get();
        }
        else{
            $dataUnitOwner = DB::table("mst_unit_owner")
                                    ->select(DB::raw('mst_unit_apart.no_unit_apart, mst_unit_owner.id_unit_owner'))
                                    ->leftJoin('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->where('mst_unit_owner.login', '=', $userLogin)
                                    ->get();
        }
        

        return view('app', [
                                'module' => 'complain',
                                'action' => 'add',
                                'namaCategoryComplain' => ComplainCategory::where('status','=',1)->get(),
                                'unit_owner' => $dataUnitOwner
                                //'dump' => var_dump($id_unit_owner)
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
            
            $arrComplainCategory = array();
            $arrComplainCategory = $request->complainCategory;
           
            $arrDesc = array();
            $arrDesc = $request->description;
            $j=0;

            $data_unit_owner = DB::table("mst_unit_owner")
                                    ->select(DB::raw('mst_unit_apart.no_unit_apart'))
                                    ->leftJoin('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->where('mst_unit_owner.id_unit_owner', '=', $request->id_unit_owner)
                                    ->get();
            foreach ($data_unit_owner as $value) {
                $no_apart = $value->no_unit_apart;
            }
                
            foreach ($arrComplainCategory as $key) {
                if(isset($key["id"])){
                    $complain = new Complain;
                    $tgl = date("dmY");
                    $collec_kode_complain_category = ComplainCategory::where('id_complain_category', '=', $key["id"])
                                                                ->pluck('kode_complain_category')
                                                                ->toArray();
                    $kode_complain_category = $collec_kode_complain_category[0];
                    $collec_no_complain = DB::table('mst_complain')
                                                        ->select(DB::raw('noComplain'))
                                                        ->where('id_complain_category', '=', $key["id"])
                                                        ->where('id_unit_owner', '=', $request->id_unit_owner)
                                                        ->orderBy('noComplain', 'desc')
                                                        ->first();
                    if (!empty($collec_no_complain)) {
                        $nextNomor = $collec_no_complain->noComplain;
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
                    
                    $generateNoComplain = $kode_complain_category."/".$no_apart."/".$strNextNomor;

                    $complain->no_complain = $generateNoComplain;
                    $complain->noComplain = $nextNomor;
                    $complain->id_complain_category = $key["id"];
                    $complain->id_unit_owner = $request->id_unit_owner;
                    $complain->id_complain_status = $request->id_complain_status;
                    $complain->description = $key["description"];
                    $complain->status = $request->status;
                    $complain->tgl_complain = date("Y-m-d H:i:s");
                    $complain->submitted_by = Auth::user()->name;
                    $complain->save();
                    $j++;
            }           
        }
        return redirect('/complain')->with('success', 'New Complain has been Submit!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $data2 = Complain::find($id);
        $dataKodeComplainCategory = ComplainCategory::where('id_complain_category', $data2->id_complain_category)
                                                        ->pluck('nama_complain_category')
                                                        ->toArray();
        
        $dataNoUnitApart = DB::table('mst_complain')
            ->select(DB::raw("concat(mst_unit_apart.no_unit_apart, ' / ', mst_title.nama_title, '. ', mst_unit_owner.nama_depan, ' ', mst_unit_owner.nama_belakang) as NamaPenghuni, mst_complain_status.id_complain_status, mst_complain_status.nama_complain_status,
                respon.ket_respon, mst_complain.*"))
            ->leftJoin('mst_unit_owner', 'mst_unit_owner.id_unit_owner', '=', 'mst_complain.id_unit_owner')
            ->leftJoin('mst_unit_apart', 'mst_unit_apart.id_unit_apart', '=', 'mst_unit_owner.id_unit_apart')
            ->leftJoin('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
            ->leftJoin('mst_complain_status', 'mst_complain_status.id_complain_status', '=', 'mst_complain.id_complain_status')
            ->leftJoin('respon', 'respon.id_respon', '=', 'mst_complain.id_respon')
            ->where('mst_complain.id_complain', $id)
            ->get();

        if (Auth::user()->priv_status==1 || Auth::user()->priv_status==3) {
            $data_complain_status = ComplainStatus::where('status', 1)
                                                        ->get();    
        }
        else{
            $data_complain_status = ComplainStatus::where('status', '=', 1)
                                                        ->where('id_complain_status', '!=', 4)
                                                        ->get();
        }
                                                    
        return view('app', [
                                'id'                      => $id,
                                'module'                  => 'complain',
                                'action'                  => 'view',
                                'kode_complain_category'  =>  $dataKodeComplainCategory,
                                'data2'                   =>  $data2,
                                'data_no_unit_apart'      => $dataNoUnitApart,
                                'data_complain_status'    => $data_complain_status,
                                'namaCategoryComplain'    => ComplainCategory::where('status','=',1)->get()
                            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id2)
    {
        //
        //$data = Complain::where(['id_unit_owner' => $id, 'status' => 1])
          //                  ->orderBy('id_complain_category', 'asc')
            //                ->get();
        $data2 = Complain::find($id2);
        $dataKodeComplainCategory = ComplainCategory::where('id_complain_category', $data2->id_complain_category)
                                                        ->pluck('nama_complain_category')
                                                        ->toArray();
        
        $dataNoUnitApart = DB::table('mst_complain')
            ->select(DB::raw("concat(mst_unit_apart.no_unit_apart, ' / ', mst_title.nama_title, '. ', mst_unit_owner.nama_depan, ' ', mst_unit_owner.nama_belakang) as NamaPenghuni, mst_complain_status.id_complain_status, mst_complain_status.nama_complain_status,
                respon.ket_respon, mst_complain.*"))
            ->leftJoin('mst_unit_owner', 'mst_unit_owner.id_unit_owner', '=', 'mst_complain.id_unit_owner')
            ->leftJoin('mst_unit_apart', 'mst_unit_apart.id_unit_apart', '=', 'mst_unit_owner.id_unit_apart')
            ->leftJoin('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
            ->leftJoin('mst_complain_status', 'mst_complain_status.id_complain_status', '=', 'mst_complain.id_complain_status')
            ->leftJoin('respon', 'respon.id_respon', '=', 'mst_complain.id_respon')
            ->where('mst_complain.id_complain', $id2)
            ->get();

        if (Auth::user()->priv_status==1 || Auth::user()->priv_status==3) {
            $data_complain_status = ComplainStatus::where('status', 1)
                                                        ->get();    
        }
        else{
            $data_complain_status = ComplainStatus::where('status', '=', 1)
                                                        ->where('id_complain_status', '!=', 4)
                                                        ->get();
        }
                                                    
        return view('app', [
                                'id'                      => $id,
                                'id2'                     => $id2,
                                'module'                  => 'complain',
                                'action'                  => 'edit',
                                'kode_complain_category'  =>  $dataKodeComplainCategory,
                                'data2'                   =>  $data2,
                                'data_no_unit_apart'      => $dataNoUnitApart,
                                'data_complain_status'    => $data_complain_status,
                                'namaCategoryComplain'    => ComplainCategory::where('status','=',1)->get()
                            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id2)
    {
        //
        $complain = Complain::find($id2);

        if (Auth::user()->priv_status == 8 || Auth::user()->priv_status == 9) {
            $cekidRespon = DB::table("respon")
                            ->select("id_respon")
                            ->where('id_complain', '=', $id2)
                            ->first();
            if (empty($cekidRespon->id_respon)) {
                $respon = new respon;
                $respon->priv_status = Auth::user()->priv_status;
                $respon->ket_respon = $request->engineer_respon;
                $respon->status = 1;
                $respon->id_complain = $id2;
                $respon->respon_by = Auth::user()->name;
                $respon->tgl_respon = new DateTime();
                $respon->save();
                $idRespon = DB::table("respon")
                            ->select("id_respon")
                            ->where('id_complain', '=', $id2)
                            ->first();    
                $complain->id_respon = $idRespon->id_respon;
                $complain->save();

            }   
            return redirect('/complain')->with('success', 'Complain ' . $complain->no_complain . '  has been Updated!!'); 
        }
        if (Auth::user()->priv_status == 1 || Auth::user()->priv_status == 2 || Auth::user()->priv_status == 3) {
            $complain->id_complain_status = $request->id_complain_status;
            if ($complain->id_complain_status == 2) {
                $complain->tgl_onproses = new DateTime();
                $complain->onproses_by = Auth::user()->name;
                $complain->save();
                return redirect('/complain')->with('success', 'Complain ' . $complain->no_complain . '  has been Updated!!');
            }
            if ($complain->id_complain_status == 3) {
                $dataRespon = respon::select("*")
                            ->where('id_complain', '=', $id2)
                            ->first();
                if (!empty($dataRespon->id_respon)) {
                    $tglSkrg = new DateTime();
                   // $lama_respon = (strtotime($dataRespon->tgl_respon) - strtotime($tglSkrg)) /3600;
                    //$respon = new respon;
                    //$respon->lama_respon = $lama_respon;
                    //$dataRespon->save();
                    $complain->tgl_done = $tglSkrg;
                    $complain->done_by = Auth::user()->name;
                    $complain->save();
                    return redirect('/complain')->with('success', 'Complain ' . $complain->no_complain . '  has been Updated!!');
                }
                else{
                    return redirect('/complain')->with('Warning', 'Complain ' . $complain->no_complain . '  Cannot be updated, need Engineer Respon First!');
                    //exit;
                }
                
            }
            if ($complain->id_complain_status == 4) {
                $complain->tgl_reject = new DateTime();
                $complain->reject_by = Auth::user()->name;
                $complain->save();
                return redirect('/complain')->with('success', 'Complain ' . $complain->no_complain . '  has been Updated!!');
            }
            
        }
        
        
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
        $complain = Complain::find($id);
        $complain->status = 0;

        $complain->save();
        return redirect('/complain')->with('success', 'Complain ' . $complain->no_complain . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = Complain::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'complain',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
