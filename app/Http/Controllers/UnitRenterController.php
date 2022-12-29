<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\UnitRenter;
use App\Title;
use App\Gender;
use App\UnitApart;
use App\UnitOwner;
use App\User;
use App\Country;
use DB;

class UnitRenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app', [
                            'module' => 'unit_renter',
                            'data' => UnitRenter::select('*')
                            ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_renter.id_unit_apart')
                            ->join('mst_title','mst_title.id_title','=','mst_unit_renter.id_title')
                            ->join('mst_gender','mst_gender.id_gender','=','mst_unit_renter.id_gender')
                            ->join('mst_country','mst_country.id_country','=','mst_unit_renter.id_country')
                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                            ->where('mst_unit_renter.status', '=', 1)
                            ->where('mst_unit_renter.status_sewa', '=', 1)
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
                            ->select(DB::raw("CONCAT(nama_depan, ' ' ,nama_belakang,' - ',no_unit_apart,' - ',nama_tower) as nama_apart, mst_unit_apart.id_unit_apart"))
                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                            ->join('mst_unit_owner','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                            ->where('mst_unit_apart.status', '=', 1)
                            ->where('mst_unit_apart.status_unit_picked', '=', 1)
                            ->where('mst_unit_owner.status_sewa', '=', 0)
                            ->get();
        $temp3 = Country::all();
        return view('app', [
                                'module'        => 'unit_renter',
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
        $unit_owner = UnitOwner::where("id_unit_apart","=",$unit_apart->id_unit_apart)->first();

        $nama_username = UnitApart::select('kode_tower','no_floor','no_unit_apart','id_unit_apart')
                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                            ->where('mst_unit_apart.id_unit_apart', '=', $request->id_unit_apart)
                            ->first();

        $username =  $nama_username->kode_tower.$nama_username->no_floor.$nama_username->no_unit_apart;
        
        $unit_renter = new UnitRenter;        
        $unit_renter->id_title       = $request->id_title;
        $unit_renter->nama_depan     = $request->nama_depan;
        $unit_renter->nama_belakang  = $request->nama_belakang;
        $unit_renter->id_unit_apart  = $request->id_unit_apart;
        $unit_renter->login          = $username.'-rent';

        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_lahir);
        $unit_renter->tgl_lahir      = $date;
        $unit_renter->id_gender      = $request->id_gender;
        $unit_renter->alamat_ktp     = $request->alamat_ktp;
        $unit_renter->alamat_surat   = $request->alamat_surat;
        $unit_renter->no_ktp         = $request->no_ktp;
        $unit_renter->no_npwp        = $request->no_npwp;
        $unit_renter->id_country     = $request->id_country;
        $unit_renter->no_passport    = $request->no_passport;
        $unit_renter->jml_penghuni   = $request->jml_penghuni;
        $unit_renter->no_telp        = $request->no_telp;
        $unit_renter->no_hp          = $request->no_hp;
        $unit_renter->emergency_name = $request->emergency_name;
        $unit_renter->emergency_no   = $request->emergency_no;
        $unit_renter->email          = $request->email;
        $unit_renter->status         = $request->status;
        $date1 = \DateTime::createFromFormat('d-m-Y', $request->start_rent);
        $unit_renter->start_rent     = $date1;
        $date2 = \DateTime::createFromFormat('d-m-Y', $request->end_rent);
        $unit_renter->end_rent       = $date2;
        $unit_renter->save();
        
        $user_owner = User::where("login","=",$unit_owner->login)->first();
        $user_owner->status = 0;
        $user_owner->save();

        $unit_owner1 = UnitOwner::find($unit_owner->id_unit_owner);
        $unit_owner1->status_sewa = 1;
        $unit_owner1->save();

        $user = new User;
        $user->login        = $username.'-rent';
        $user->username     = $username.'-rent';
        $user->name         = $request->nama_depan;
        $user->email        = $request->email;
        $user->priv_status  = 11;
        $user->status       = 1;
        $user->password     = Hash::make('rental');
        $user->save();
        
        return redirect('/unit_renter')->with('success', 'New Unit Renter has been Submit!!');
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
        $data = UnitRenter::find($id);

        $data_master_title  = Title::where('status', 1)
                                        ->get();
        $data_master_gender = Gender::where('status', 1)
                                        ->get();
        $data_master_unit_apart = DB::table('mst_unit_apart')
        ->select(DB::raw("CONCAT(nama_depan, ' ' ,nama_belakang,' - ',no_unit_apart,' - ',nama_tower) as nama_apart, mst_unit_apart.id_unit_apart"))
        ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
        ->join('mst_unit_owner','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
        ->where('mst_unit_apart.status', '=', 1)
        ->where('mst_unit_apart.status_unit_picked', '=', 1)
        ->where('mst_unit_owner.status_sewa', '=', 0)
        ->get();
        $data_master_country = Country::where('status', 1)
                                        ->get();
        $data_edit  = UnitApart::where('id_unit_apart','=', $data->id_unit_apart)
                                ->get();
        $data_master_unit_apart = $data_master_unit_apart->merge($data_edit);
        
        $data->tgl_lahir= \DateTime::createFromFormat('Y-m-d', $data->tgl_lahir)->format('d-m-Y');
        $data->start_rent= \DateTime::createFromFormat('Y-m-d', $data->start_rent)->format('d-m-Y');
        $data->end_rent= \DateTime::createFromFormat('Y-m-d', $data->end_rent)->format('d-m-Y');
        return view('app', [
                                'id'                        => $id,
                                'module'                    => 'unit_renter',
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
        $data = UnitRenter::find($id);

        $data_master_title  = Title::where('status', 1)
                                        ->get();
        $data_master_gender = Gender::where('status', 1)
                                        ->get();
        $data_master_unit_apart = DB::table('mst_unit_apart')
                                        ->select(DB::raw("CONCAT(nama_depan, ' ' ,nama_belakang,' - ',no_unit_apart,' - ',nama_tower) as nama_apart, mst_unit_apart.id_unit_apart"))
                                        ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                                        ->join('mst_unit_owner','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                        ->where('mst_unit_apart.status', '=', 1)
                                        ->where('mst_unit_apart.status_unit_picked', '=', 1)
                                        ->where('mst_unit_owner.status_sewa', '=', 0)
                                        ->get();
        $data_master_country = Country::where('status', 1)
                                        ->get();
        $data_edit  = UnitApart::where('id_unit_apart','=', $data->id_unit_apart)
                                ->get();
        $data_master_unit_apart = $data_master_unit_apart->merge($data_edit);
        
        $data->tgl_lahir= \DateTime::createFromFormat('Y-m-d', $data->tgl_lahir)->format('d-m-Y');
        $data->start_rent= \DateTime::createFromFormat('Y-m-d', $data->start_rent)->format('d-m-Y');
        $data->end_rent= \DateTime::createFromFormat('Y-m-d', $data->end_rent)->format('d-m-Y');
        return view('app', [
                                'id'                        => $id,
                                'module'                    => 'unit_renter',
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
        $unit_renter = UnitRenter::find($id);
        $user = User::where("login","=",$unit_renter->login)->first();
        

        if($unit_renter->id_unit_apart!=$request->id_unit_apart){
            $temp = UnitOwner::where("id_unit_apart","=",$unit_renter->id_unit_apart)->first();
            
            $temp->status_sewa = 0;
            $temp->save();
        }
        
        $unit_renter->id_title = $request->id_title;
        $unit_renter->nama_depan = $request->nama_depan;
        $unit_renter->nama_belakang = $request->nama_belakang;
        $unit_renter->id_unit_apart = $request->id_unit_apart;
        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_lahir);
        $unit_renter->tgl_lahir = $date;
        $unit_renter->id_gender = $request->id_gender;
        $unit_renter->alamat_ktp = $request->alamat_ktp;
        $unit_renter->alamat_surat = $request->alamat_surat;
        $unit_renter->no_ktp = $request->no_ktp;
        $unit_renter->no_npwp = $request->no_npwp;
        $unit_renter->no_passport = $request->no_passport;
        $unit_renter->id_country = $request->id_country;
        $unit_renter->jml_penghuni = $request->jml_penghuni;
        $unit_renter->no_telp = $request->no_telp;
        $unit_renter->no_hp = $request->no_hp;
        $unit_renter->emergency_name         = $request->emergency_name;
        $unit_renter->emergency_no         = $request->emergency_no;
        $unit_renter->email = $request->email;
        $date1 = \DateTime::createFromFormat('d-m-Y', $request->start_rent);
        $unit_renter->start_rent = $date;
        $date2 = \DateTime::createFromFormat('d-m-Y', $request->end_rent);
        $unit_renter->end_rent = $date;
        $unit_renter->status = $request->status;

        $unit_apart = UnitApart::find($request->id_unit_apart);

        $nama_username = UnitApart::select('kode_tower','no_floor','no_unit_apart','id_unit_apart')
                            ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                            ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                            ->where('mst_unit_apart.id_unit_apart', '=', $request->id_unit_apart)
                            ->first();

        $username =  $nama_username->kode_tower.$nama_username->no_floor.$nama_username->no_unit_apart;

        $user->login = $username.'-rent';
        $user->username = $username.'-rent';
        $user->save();

        $unit_renter->login = $username.'-rent';
        $unit_renter->save();
                
        $unit_owner = UnitOwner::where("id_unit_apart","=",$request->id_unit_apart)->first();
        $unit_owner->status_sewa = 1;
        $unit_owner->save();

        return redirect('/unit_renter')->with('success', 'Unit Renter ' . $unit_owner->nama_depan . ' has been Updated!!');
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
        $unit_renter = UnitRenter::find($id);
        $unit_renter->status = 0;
        $unit_renter->status_sewa = 0;
        $unit_renter->save();
        
        $unit_owner = UnitOwner::where("id_unit_apart","=",$unit_renter->id_unit_apart)->first();
        $unit_owner->status_sewa = 0;
        $unit_owner->save();

        $user_owner = User::where("login","=",$unit_owner->login)->first();
        $user_owner->status = 1;
        $user_owner->save();

        $user_renter = User::where("login","=",$unit_renter->login)->first();
        $user_renter->status = 0;
        $user_renter->save();

        return redirect('/unit_renter')->with('success', 'Unit Renter ' . $unit_renter->nama_depan . ' ' . $unit_renter->nama_belakang . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = UnitRenter::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'unit_renter',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}