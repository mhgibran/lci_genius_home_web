<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitApartTenant;
use App\Tower;

class UnitApartTenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('app', [
                                    'module' => 'unit_apart_tenant',
                                    'data' => UnitApartTenant::select('*')
                                    ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart_tenant.id_tower')
                                    ->where('mst_unit_apart_tenant.status', '=', 1)
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
        $temp = Tower::all();
        return view('app', [
                                'module' => 'unit_apart_tenant',
                                'action' => 'add',
                                'towers' => $temp
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
        $unit_apart_tenant = new UnitApartTenant;

        $unit_apart_tenant->id_unit_apart_tenant = $request->id_unit_apart_tenant;
        $unit_apart_tenant->no_unit_apart_tenant = $request->no_unit_apart_tenant;
        $unit_apart_tenant->id_tower = $request->id_tower;
        $unit_apart_tenant->status = $request->status;

        $unit_apart_tenant->save();
        return redirect('/unit_apart_tenant')->with('success', 'New Unit Tenant has been Submit!!');
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
        $data_master_tower  = Tower::where('status', 1)
                                        ->get();
        $data = UnitApartTenant::find($id);
        return view('app', [
                                'id'                => $id,
                                'module'            => 'unit_apart_tenant',
                                'action'            => 'view',
                                'data'              =>  $data,
                                'data_master_tower' => $data_master_tower
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
        $data_master_tower  = Tower::where('status', 1)
                                        ->get();
        $data = UnitApartTenant::find($id);
        return view('app', [
                                'id'                => $id,
                                'module'            => 'unit_apart_tenant',
                                'action'            => 'edit',
                                'data'              =>  $data,
                                'data_master_tower' => $data_master_tower
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
        $unit_apart_tenant = UnitApartTenant::find($id);

        $unit_apart_tenant->no_unit_apart_tenant = $request->no_unit_apart_tenant;
        $unit_apart_tenant->id_tower = $request->id_tower;
        $unit_apart_tenant->status = $request->status;

        $unit_apart_tenant->save();
        return redirect('/unit_apart_tenant')->with('success', 'Unit Tenant ' . $unit_apart_tenant->no_unit_apart_tenant . ' has been Updated!!');
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
        $unit_apart_tenant = UnitApartTenant::find($id);
        $unit_apart_tenant->status = 0;

        $unit_apart_tenant->save();
        return redirect('/unit_apart_tenant')->with('success', 'Unit Tenant ' . $unit_apart_tenant->no_unit_apart_tenant . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = UnitApartTenant::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'unit_apart_tenant',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
