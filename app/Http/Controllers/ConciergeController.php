<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Concierge;
use App\ConciergeCategory;
use App\ConciergeEmployee;
use App\UnitOwner;
use App\ConciergeStatus;
use DB;
use Auth;
use DateTime;

class ConciergeController extends Controller
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
                                'module' => 'concierge',
                                'data' => Concierge::select('*')
                                    ->join('mst_concierge_status','mst_concierge_status.id_concierge_status','=','concierge.id_concierge_status')
                                    ->join('mst_concierge_category','mst_concierge_category.id_concierge_category','=','concierge.id_concierge_category')
                                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','concierge.id_unit_owner')
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->where('concierge.status', '=', 1)
                                    ->get()
                            ]); 
        }
        elseif (Auth::user()->priv_status==10) {
            return view('app', [
                                'module' => 'concierge',
                                'data' => Concierge::select('*')
                                    ->join('mst_concierge_status','mst_concierge_status.id_concierge_status','=','concierge.id_concierge_status')
                                    ->join('mst_concierge_category','mst_concierge_category.id_concierge_category','=','concierge.id_concierge_category')
                                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','concierge.id_unit_owner')
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->where('concierge.status', '=', 1)
                                    ->where('mst_unit_owner.login', '=', Auth::user()->login)
                                    ->get()
                            ]);
        }
        elseif (Auth::user()->priv_status==13) {
            return view('app', [
                                'module' => 'concierge',
                                'data' => Concierge::select('*')
                                    ->join('mst_concierge_status','mst_concierge_status.id_concierge_status','=','concierge.id_concierge_status')
                                    ->join('mst_concierge_category','mst_concierge_category.id_concierge_category','=','concierge.id_concierge_category')
                                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','concierge.id_unit_owner')
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->join('mst_concierge_employee','mst_concierge_employee.concierge_login','=','concierge.concierge_login')
                                    ->where('mst_concierge_status.id_concierge_status', '=', 2)
                                    ->where('concierge.concierge_login', '=', Auth::user()->login)
                                    ->get()
                            ]);
        }
        else{
            return view('app', [
                                'module' => 'concierge',
                                'data' => Concierge::select('*')
                                    ->join('mst_concierge_status','mst_concierge_status.id_concierge_status','=','concierge.id_concierge_status')
                                    ->join('mst_concierge_category','mst_concierge_category.id_concierge_category','=','concierge.id_concierge_category')
                                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','concierge.id_unit_owner')
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->where('concierge.status', '=', 1)
                                    ->whereIn('concierge.id_concierge_status', [2,3])
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
        if (Auth::user()->priv_status ==1 || Auth::user()->priv_status==2 || Auth::user()->priv_status==3) {
            $dataUnitOwner = DB::table("mst_unit_owner")
                                    ->select(DB::raw("mst_unit_owner.id_unit_owner, concat(mst_unit_apart.no_unit_apart, ' - ', mst_title.nama_title, '. ', mst_unit_owner.nama_depan, ' ', mst_unit_owner.nama_belakang) as namaPenghuni"))
                                    ->leftJoin('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->leftJoin('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
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
                                'module' => 'concierge',
                                'action' => 'add',
                                'namaCategoryConcierge' => ConciergeCategory::where('status','=',1)->get(),
                                'unit_owner' => $dataUnitOwner
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
            
            $arrConciergeCategory = array();
            $arrConciergeCategory = $request->conciergeCategory;

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
                
            foreach ($arrConciergeCategory as $key) {
                if(isset($key["id"])){
                    $concierge = new Concierge;
                    $tgl = date("dmY");
                    $collec_kode_concierge_category = ConciergeCategory::where('id_concierge_category', '=', $key["id"])
                                                                ->pluck('kode_concierge_category')
                                                                ->toArray();
                    $kode_concierge_category = $collec_kode_concierge_category[0];
                    $collec_no_concierge = DB::table('concierge')
                                                        ->select(DB::raw('noConcierge'))
                                                        ->where('id_concierge_category', '=', $key["id"])
                                                        ->where('id_unit_owner', '=', $request->id_unit_owner)
                                                        ->orderBy('noConcierge', 'desc')
                                                        ->first();
                    if (!empty($collec_no_concierge)) {
                        $nextNomor = $collec_no_concierge->noConcierge;
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
                    
                    $generateNoConcierge = $kode_concierge_category."/".$no_apart."/".$strNextNomor;
    
                    $concierge->no_concierge = $generateNoConcierge;
                    $concierge->noConcierge = $nextNomor;
                    $concierge->id_concierge_category = $key["id"];
                    $concierge->id_unit_owner = $request->id_unit_owner;
                    $concierge->concierge_login = 0;
                    $concierge->id_concierge_status = $request->id_concierge_status;
                    $concierge->description = $key["description"];
                    $concierge->admin_response = $request->response_admin;
                    $concierge->concierge_response = $request->response_conc;
                    $concierge->status = $request->status;
                    $concierge->tgl_concierge = date("Y-m-d H:i:s");
                    $concierge->submitted_by = Auth::user()->name;
                    $concierge->save();
                    $j++;
                }
            }     
        return redirect('/concierge')->with('success', 'New Concierge has been Submit!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $data2 = Concierge::find($id);
        $dataKodeConciergeCategory = ConciergeCategory::where('id_concierge_category', $data2->id_concierge_category)
                                                        ->pluck('nama_concierge_category')
                                                        ->toArray();
        
        $dataNoUnitApart = DB::table('concierge')
            ->select(DB::raw("concat(mst_unit_apart.no_unit_apart, ' / ', mst_title.nama_title, '. ', mst_unit_owner.nama_depan, ' ', mst_unit_owner.nama_belakang) as NamaPenghuni, mst_concierge_status.id_concierge_status, mst_concierge_status.nama_concierge_status,
                concierge.*"))
            ->leftJoin('mst_unit_owner', 'mst_unit_owner.id_unit_owner', '=', 'concierge.id_unit_owner')
            ->leftJoin('mst_unit_apart', 'mst_unit_apart.id_unit_apart', '=', 'mst_unit_owner.id_unit_apart')
            ->leftJoin('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
            ->leftJoin('mst_concierge_status', 'mst_concierge_status.id_concierge_status', '=', 'concierge.id_concierge_status')
            ->where('concierge.id_concierge', $id)
            ->get();

        if (Auth::user()->priv_status==1 || Auth::user()->priv_status==3) {
            $data_concierge_status = ConciergeStatus::where('status', 1)
                                                        ->get();    
        }
        else{
            $data_concierge_status = ConciergeStatus::where('status', '=', 1)
                                                        ->where('id_concierge_status', '!=', 4)
                                                        ->get();
        }
                                                    
        return view('app', [
                                'id'                      => $id,
                                'module'                  => 'concierge',
                                'action'                  => 'view',
                                'kode_concierge_category'  =>  $dataKodeConciergeCategory,
                                'data2'                   =>  $data2,
                                'data_no_unit_apart'      => $dataNoUnitApart,
                                'data_concierge_status'    => $data_concierge_status,
                                'namaCategoryConcierge'    => ConciergeCategory::where('status','=',1)->get()
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
        $data2 = Concierge::find($id2);
        $dataKodeConciergeCategory = ConciergeCategory::where('id_concierge_category', $data2->id_concierge_category)
                                                        ->pluck('nama_concierge_category')
                                                        ->toArray();
        
        $dataNoUnitApart = DB::table('concierge')
            ->select(DB::raw("concat(mst_unit_apart.no_unit_apart, ' / ', '. ', mst_unit_owner.nama_depan, ' ', mst_unit_owner.nama_belakang) as NamaPenghuni, mst_concierge_status.id_concierge_status, mst_concierge_status.nama_concierge_status,
                concierge.*"))
            ->leftJoin('mst_unit_owner', 'mst_unit_owner.id_unit_owner', '=', 'concierge.id_unit_owner')
            ->leftJoin('mst_unit_apart', 'mst_unit_apart.id_unit_apart', '=', 'mst_unit_owner.id_unit_apart')
            ->leftJoin('mst_concierge_status', 'mst_concierge_status.id_concierge_status', '=', 'concierge.id_concierge_status')
            ->where('concierge.id_concierge', $id2)
            ->get();

        if (Auth::user()->priv_status==1 || Auth::user()->priv_status==3) {
            $data_concierge_status = ConciergeStatus::where('status', 1)
                                                        ->get();    
        }
        else{
            $data_concierge_status = ConciergeStatus::where('status', '=', 1)
                                                        ->where('id_concierge_status', '!=', 4)
                                                        ->get();
        }

        $get_employee = ConciergeEmployee::where('status','=',1)
                                                        ->get();
        if($get_employee->count() !== 0){
            $data_concierge_employee = $get_employee;
        }else{
            $data_concierge_employee = 'Error';
        }
                                                    
        return view('app', [
                                'id'                      => $id,
                                'id2'                     => $id2,
                                'module'                  => 'concierge',
                                'action'                  => 'edit',
                                'kode_concierge_category' =>  $dataKodeConciergeCategory,
                                'data2'                   =>  $data2,
                                'data_no_unit_apart'      => $dataNoUnitApart,
                                'data_concierge_status'   => $data_concierge_status,
                                'data_concierge_employee' => $data_concierge_employee,
                                'namaCategoryConcierge'   => ConciergeCategory::where('status','=',1)->get()
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
        $concierge = Concierge::find($id2);
        $employee = ConciergeEmployee::where("concierge_login","=",$request->concierge_login)->first();

        if (Auth::user()->priv_status == 1 || Auth::user()->priv_status == 2 || Auth::user()->priv_status == 3 || Auth::user()->priv_status == 13) {
            $concierge->id_concierge_status = $request->id_concierge_status;
            if ($concierge->id_concierge_status == 2) {
                $concierge->tgl_onproses = new DateTime();
                $concierge->concierge_login = $request->concierge_login;
                $concierge->admin_response = $request->response_admin;
                $concierge->concierge_response = $request->response_conc;
                $concierge->onproses_by = Auth::user()->name;
                $concierge->save();
                
                $employee->status = 0;
                $employee->save();
                return redirect('/concierge')->with('success', 'Concierge ' . $concierge->no_concierge . '  has been Updated!!');
            }
            if ($concierge->id_concierge_status == 3) {
                $tglSkrg = new DateTime();
                $concierge->concierge_login = $request->concierge_login;
                $concierge->admin_response = $request->response_admin;
                $concierge->concierge_response = $request->response_conc;
                $concierge->tgl_done = $tglSkrg;
                $concierge->done_by = Auth::user()->name;
                $concierge->save();

                $employee->status = 1;
                $employee->save();
                return redirect('/concierge')->with('success', 'Concierge ' . $concierge->no_concierge . '  has been Updated!!');
            }
            if ($concierge->id_concierge_status == 4) {
                $concierge->tgl_cancel = new DateTime();
                $concierge->concierge_login = $request->concierge_login;
                $concierge->admin_response = $request->response_admin;
                $concierge->concierge_response = $request->response_conc;
                $concierge->cancel_by = Auth::user()->name;
                $concierge->save();

                $employee->status = 1;
                $employee->save();
                return redirect('/concierge')->with('success', 'Concierge ' . $concierge->concierge . '  has been Updated!!');
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
        $concierge = Concierge::find($id);
        $concierge->status = 0;

        $concierge->save();
        return redirect('/concierge')->with('success', 'Concierge ' . $concierge->no_concierge . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = Concierge::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'concierge',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
