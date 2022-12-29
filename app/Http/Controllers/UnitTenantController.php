<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\UnitTenant;
use App\UnitApartTenant;
use App\Tower;
use App\User;
use DB;
use Auth;

class UnitTenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::User()->priv_status == 10){
            return view('app', [
                                        'module' => 'tenant_list',
                                        'action' => 'view',
                                        'data' => UnitTenant::select('*')
                                        ->where('status', '=', 1)
                                        ->get()
                                    ]);
        }else{
            return view('app', [
                                        'module' => 'unit_tenant',
                                        'data' => UnitTenant::select('*')
                                        ->where('status', '=', 1)
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
        //
        $temp = UnitTenant::all();
        return view('app', [
                                'module'            => 'unit_tenant',
                                'action'            => 'add',
                                'unitaparttenants'  => $temp
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
        $unit_tenant = new UnitTenant;        
        $unit_tenant->nama_perusahaan_unit_tenant       = $request->nama_perusahaan_unit_tenant;
        $unit_tenant->kode_unit_tenant                  = $request->kode_unit_tenant;
        $unit_tenant->nama_unit_tenant                  = $request->nama_unit_tenant;
        $unit_tenant->no_pks                           = $request->no_pks;
        $unit_tenant->login                             = $request->kode_unit_tenant.'-tenant';

        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_mulai_kontrak);
        $unit_tenant->tgl_mulai_kontrak     = $date;
        $date1 = \DateTime::createFromFormat('d-m-Y', $request->tgl_habis_kontrak);
        $unit_tenant->tgl_habis_kontrak     = $date1;
        $unit_tenant->alamat_kantor          = $request->alamat_kantor;
        $unit_tenant->no_telp                = $request->no_telp;
        $unit_tenant->no_fax                 = $request->no_fax;
        $unit_tenant->email                  = $request->email;
        $unit_tenant->status                 = $request->status;
        $unit_tenant->save();

        $user = new User;
        $user->login        = $unit_tenant->kode_unit_tenant.'-tenant';
        $user->username     = $unit_tenant->kode_unit_tenant.'-tenant';
        $user->name         = $request->nama_unit_tenant;
        $user->email        = $request->email;
        $user->priv_status  = 12;
        $user->status       = 1;
        $user->password     = Hash::make('password');
        $user->save();
        
        return redirect('/unit_tenant')->with('success', 'New Tenant has been Submit!!');
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
        $data = UnitTenant::find($id);
        
        $data->tgl_mulai_kontrak= \DateTime::createFromFormat('Y-m-d', $data->tgl_mulai_kontrak)->format('d-m-Y');
        $data->tgl_habis_kontrak= \DateTime::createFromFormat('Y-m-d', $data->tgl_habis_kontrak)->format('d-m-Y');
        return view('app', [
                                'id'                        => $id,
                                'module'                    => 'unit_tenant',
                                'action'                    => 'view',
                                'data'                      =>  $data
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
        $data = UnitTenant::find($id);
        
        $data->tgl_mulai_kontrak= \DateTime::createFromFormat('Y-m-d', $data->tgl_mulai_kontrak)->format('d-m-Y');
        $data->tgl_habis_kontrak= \DateTime::createFromFormat('Y-m-d', $data->tgl_habis_kontrak)->format('d-m-Y');
        return view('app', [
                                'id'                        => $id,
                                'module'                    => 'unit_tenant',
                                'action'                    => 'edit',
                                'data'                      =>  $data
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
        $unit_tenant = UnitTenant::find($id);
        $user = User::where("login","=",$unit_tenant->login)->first();
        
        $unit_tenant->nama_perusahaan_unit_tenant = $request->nama_perusahaan_unit_tenant;
        $unit_tenant->kode_unit_tenant = $request->kode_unit_tenant;
        $unit_tenant->nama_unit_tenant = $request->nama_unit_tenant;
        $unit_tenant->alamat_kantor        = $request->alamat_kantor;
        $unit_tenant->no_telp        = $request->no_telp;
        $unit_tenant->no_fax        = $request->no_fax;
        $unit_tenant->email        = $request->email;
        $unit_tenant->no_pks        = $request->no_pks;
        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_mulai_kontrak);
        $unit_tenant->tgl_mulai_kontrak = $date;
        $date1 = \DateTime::createFromFormat('d-m-Y', $request->tgl_habis_kontrak);
        $unit_tenant->tgl_habis_kontrak = $date1;
        $unit_tenant->status = $request->status;

        $user->login = $unit_tenant->kode_unit_tenant.'-tenant';
        $user->username = $unit_tenant->kode_unit_tenant.'-tenant';
        $user->save();

        $unit_tenant->login = $unit_tenant->kode_unit_tenant.'-tenant';
        $unit_tenant->save();

        return redirect('/unit_tenant')->with('success', 'Unit Tenant ' . $unit_tenant->nama_unit_tenant . ' has been Updated!!');
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
        $unit_tenant = UnitTenant::find($id);
        $user = User::where("login","=",$unit_tenant->login)->first();
        $user->status = 0;
        $user->save();

        $unit_tenant->status = 0;
        $unit_tenant->save();
        return redirect('/unit_tenant')->with('success', 'Unit Tenant ' . $unit_tenant->nama_unit_tenant . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = UnitTenant::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'unit_tenant',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}