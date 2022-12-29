<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\UnitOwner;
use App\Title;
use App\Gender;
use App\UnitApart;
use App\User;
use App\Country;
use DB;
use App\Imports\UnitOwnerImport;
use Maatwebsite\Excel\Facades\Excel;

class UnitOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app', [
                                    'module' => 'unit_owner',
                                    'data' => UnitOwner::select('*')
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                                    ->join('mst_title','mst_title.id_title','=','mst_unit_owner.id_title')
                                    ->join('mst_gender','mst_gender.id_gender','=','mst_unit_owner.id_gender')
                                    ->join('mst_country','mst_country.id_country','=','mst_unit_owner.id_country')
                                    ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                                    ->where('mst_unit_owner.status', '=', 1)
                                    ->get()
                                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $temp = Title::all(); 
        $temp1 = Gender::all();
        $temp2 = DB::table('mst_unit_apart')
                    ->select(DB::raw("CONCAT(kode_tower,no_floor,no_unit_apart) as nama_apart, id_unit_apart"))
                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                            ->where('mst_unit_apart.status', '=', 1)
                            ->where('mst_unit_apart.status_unit_picked', '=', 0)
                            ->get();
        $temp3 = Country::all();
        return view('app', [
                                'module'        => 'unit_owner',
                                'action'        => 'add',
                                'titles'        => $temp,
                                'genders'       => $temp1,
                                'unitaparts'    => $temp2,
                                'countrys'      => $temp3
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
        $unit_apart = UnitApart::find($request->id_unit_apart);

        $nama_username = UnitApart::select('kode_tower','no_floor','no_unit_apart','id_unit_apart')
                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                            ->where('mst_unit_apart.id_unit_apart', '=', $request->id_unit_apart)
                            ->first();

        $username =  $nama_username->kode_tower.$nama_username->no_floor.$nama_username->no_unit_apart;

        $unit_owner = new UnitOwner;
        $unit_owner->id_title       = $request->id_title;
        $unit_owner->nama_depan     = $request->nama_depan;
        $unit_owner->nama_belakang  = $request->nama_belakang;
        $unit_owner->id_unit_apart  = $request->id_unit_apart;
        $unit_owner->no_bast        = $request->no_bast;
        $unit_owner->login          = $username.'-owner';

        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_lahir);
        $unit_owner->tgl_lahir      = $date;
        $unit_owner->id_gender      = $request->id_gender;
        $unit_owner->alamat_ktp     = $request->alamat_ktp;
        $unit_owner->alamat_surat   = $request->alamat_surat;
        $unit_owner->no_ktp         = $request->no_ktp;
        $unit_owner->no_npwp        = $request->no_npwp;
        $unit_owner->id_country     = $request->id_country;
        $unit_owner->no_passport    = $request->no_passport;
        $unit_owner->jml_penghuni   = $request->jml_penghuni;
        $unit_owner->no_telp        = $request->no_telp;
        $unit_owner->no_hp          = $request->no_hp;
        $unit_owner->emergency_name = $request->emergency_name;
        $unit_owner->emergency_no   = $request->emergency_no;
        $unit_owner->email          = $request->email;
        $unit_owner->status         = $request->status;
        $unit_owner->save();
        
        $unit_apart = UnitApart::find($request->id_unit_apart);
        $unit_apart->status_unit_picked = 1;
        $unit_apart->save();

        $user = new User;
        $user->login = $username.'-owner';
        $user->username = $username.'-owner';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->priv_status = 10;
        $user->status = 1;
        $user->password = Hash::make('password');
        $user->save();
        
        return redirect('/unit_owner')->with('success', 'New Unit Owner has been Submit!!');
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
        $data = UnitOwner::find($id);

        $data_master_title  = Title::where('status', 1)
                                        ->get();
        $data_master_gender = Gender::where('status', 1)
                                        ->get();
        $data_master_unit_apart = DB::table('mst_unit_apart')
        ->select(DB::raw("CONCAT(kode_tower,no_floor,no_unit_apart) as nama_apart, id_unit_apart"))
                ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                ->where('mst_unit_apart.status', '=', 1)
                ->where('mst_unit_apart.status_unit_picked', '=', 0)
                ->get();
        $data_master_country = Country::where('status', 1)
                                        ->get();
        $data_edit  = UnitApart::where('id_unit_apart','=', $data->id_unit_apart)
                                ->get();
        $data_master_unit_apart = $data_master_unit_apart->merge($data_edit);
        
        $data->tgl_lahir= \DateTime::createFromFormat('Y-m-d', $data->tgl_lahir)->format('d-m-Y');
        return view('app', [
                                'id'                        => $id,
                                'module'                    => 'unit_owner',
                                'action'                    => 'view',
                                'data'                      =>  $data,
                                'data_master_gender'        => $data_master_gender,
                                'data_master_title'         => $data_master_title,
                                'data_master_unit_apart'    => $data_master_unit_apart,
                                'data_master_country'       => $data_master_country
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
        //
        $data = UnitOwner::find($id);

        $data_master_title  = Title::where('status', 1)
                                        ->get();
        $data_master_gender = Gender::where('status', 1)
                                        ->get();
        $data_master_unit_apart2 = DB::table('mst_unit_apart')
                    ->select(DB::raw("CONCAT(mst_tower.kode_tower,mst_floor.no_floor,mst_unit_apart.no_unit_apart) as nama_apart, mst_tower.kode_tower,mst_floor.no_floor, mst_unit_apart.id_unit_apart, mst_unit_apart.no_unit_apart"))
                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                            ->where('mst_unit_apart.status', '=', 1)
                            ->where('mst_unit_apart.status_unit_picked', '=', 0)
                            ->get();
                            
        $data_master_country = Country::where('status', 1)
                                        ->get();
        $data_edit  = DB::table('mst_unit_apart')
                            ->select(DB::raw("CONCAT(mst_tower.kode_tower,mst_floor.no_floor,mst_unit_apart.no_unit_apart) as nama_apart, mst_tower.kode_tower,mst_floor.no_floor, mst_unit_apart.id_unit_apart, mst_unit_apart.no_unit_apart"))
                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                            ->where('id_unit_apart','=', $data->id_unit_apart)
                            ->get();
        $data_master_unit_apart = $data_master_unit_apart2->merge($data_edit);
        
        $data->tgl_lahir= \DateTime::createFromFormat('Y-m-d', $data->tgl_lahir)->format('d-m-Y');
        return view('app', [
                                'id'                        => $id,
                                'module'                    => 'unit_owner',
                                'action'                    => 'edit',
                                'data'                      =>  $data,
                                'data_master_gender'        => $data_master_gender,
                                'data_master_title'         => $data_master_title,
                                'data_master_unit_apart'    => $data_master_unit_apart,
                                'data_master_country'       => $data_master_country
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
        //
        $unit_owner = UnitOwner::find($id);
        $user = User::where("login","=",$unit_owner->login)->first();

        if($unit_owner->id_unit_apart!=$request->id_unit_apart){
            $temp = UnitApart::find($unit_owner->id_unit_apart);
            $temp->status_unit_picked = 0;
            $temp->save();            
        }
        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_lahir);

        $unit_owner->id_title = $request->id_title;
        $unit_owner->nama_depan = $request->nama_depan;
        $unit_owner->nama_belakang = $request->nama_belakang;
        $unit_owner->id_unit_apart = $request->id_unit_apart;
        $unit_owner->no_bast        = $request->no_bast;
        $unit_owner->tgl_lahir = $date;
        $unit_owner->id_gender = $request->id_gender;
        $unit_owner->alamat_ktp = $request->alamat_ktp;
        $unit_owner->alamat_surat = $request->alamat_surat;
        $unit_owner->no_ktp = $request->no_ktp;
        $unit_owner->no_npwp = $request->no_npwp;
        $unit_owner->no_passport = $request->no_passport;
        $unit_owner->id_country = $request->id_country;
        $unit_owner->jml_penghuni = $request->jml_penghuni;
        $unit_owner->no_telp = $request->no_telp;
        $unit_owner->no_hp = $request->no_hp;
        $unit_owner->emergency_name         = $request->emergency_name;
        $unit_owner->emergency_no         = $request->emergency_no;
        $unit_owner->email = $request->email;
        $unit_owner->status = $request->status;

        $unit_apart = UnitApart::find($request->id_unit_apart);

        $nama_username = UnitApart::select('kode_tower','no_floor','no_unit_apart','id_unit_apart')
                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                            ->where('mst_unit_apart.id_unit_apart', '=', $request->id_unit_apart)
                            ->first();

        $username =  $nama_username->kode_tower.$nama_username->no_floor.$nama_username->no_unit_apart;

        $user->login = $username.'-owner';
        $user->username = $username.'-owner';
        $user->save();

        $unit_owner->login = $username.'-owner';
        $unit_owner->save();

        $unit_apart->status_unit_picked = 1;
        $unit_apart->save();

        return redirect('/unit_owner')->with('success', 'Unit Owner ' . $unit_owner->nama_depan . ' has been Updated!!');
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
        $unit_owner = UnitOwner::find($id);
        $unit_owner->status = 0;
        $unit_owner->save();

        $unit_apart = UnitApart::where("id_unit_apart","=",$unit_owner->id_unit_apart)->first();
        $unit_apart->status_unit_picked = 0;
        $unit_apart->save();

        return redirect('/unit_owner')->with('success', 'Unit Owner ' . $unit_owner->nama_depan . ' ' . $unit_owner->nama_belakang . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = UnitOwner::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'unit_owner',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
    public function import(Request $request) 
    {
        Excel::import(new UnitOwnerImport, $request->file('upload'));
        
        return redirect('/unit_owner')->with('success', 'Upload Success!!');
    }
}