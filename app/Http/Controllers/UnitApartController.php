<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitApart;
use App\Tower;
use App\Floor;

class UnitApartController extends Controller
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
                                    'module' => 'unit_apart',
                                    'data' => UnitApart::select('*')
                                    ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                                    ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                                    ->where('mst_unit_apart.status', '=', 1)
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
        $temp1 = Floor::all();
        return view('app', [
                                'module' => 'unit_apart',
                                'action' => 'add',
                                'towers' => $temp,
                                'floors' => $temp1
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
        $unit_apart = new UnitApart;

        $unit_apart->id_unit_apart  = $request->id_unit_apart;
        $unit_apart->no_unit_apart  = $request->no_unit_apart;
        $unit_apart->luas_unit      = $request->luas_unit;
        $unit_apart->luas_unit_semigross      = $request->luas_unit_semigross;
        $unit_apart->id_tower       = $request->id_tower;
        $unit_apart->id_floor       = $request->id_floor;
        $unit_apart->status         = $request->status;
        $unit_apart->no_meter_air   = $request->no_meter_air;
        $unit_apart->no_meter_listrik   = $request->no_meter_listrik;
        $unit_apart->jml_daya_terpasang   = $request->jml_daya_terpasang;
        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_stk);
        // $unit_owner->tgl_stk      = $date;
        $unit_apart->tgl_stk = $date;

        $unit_apart->save();
        return redirect('/unit_apart')->with('success', 'New Unit Apartment has been Submit!!');
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
        $data_master_floor  = Floor::where('status', 1)
                                        ->get();
        $data = UnitApart::find($id);
        $data->tgl_stk= \DateTime::createFromFormat('Y-m-d', $data->tgl_stk)->format('d-m-Y');                                
        return view('app', [
                                'id'                => $id,
                                'module'            => 'unit_apart',
                                'action'            => 'view',
                                'data'              =>  $data,
                                'data_master_tower' => $data_master_tower,
                                'data_master_floor' => $data_master_floor,
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
        $data_master_floor  = Floor::where('status', 1)
                                        ->get();
        $data = UnitApart::find($id);
        $data->tgl_stk= \DateTime::createFromFormat('Y-m-d', $data->tgl_stk)->format('d-m-Y');
        return view('app', [
                                'id'                => $id,
                                'module'            => 'unit_apart',
                                'action'            => 'edit',
                                'data'              =>  $data,
                                'data_master_tower' => $data_master_tower,
                                'data_master_floor' => $data_master_floor,
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
        $unit_apart = UnitApart::find($id);

        $unit_apart->no_unit_apart  = $request->no_unit_apart;
        $unit_apart->luas_unit      = $request->luas_unit;
        $unit_apart->luas_unit_semigross      = $request->luas_unit_semigross;
        $unit_apart->id_tower       = $request->id_tower;
        $unit_apart->id_floor       = $request->id_floor;
        $unit_apart->status         = $request->status;
        $unit_apart->no_meter_air   = $request->no_meter_air;
        $unit_apart->no_meter_listrik   = $request->no_meter_listrik;
        $unit_apart->jml_daya_terpasang   = $request->jml_daya_terpasang;
        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_stk);
        $unit_apart->tgl_stk = $date;

        $unit_apart->save();
        return redirect('/unit_apart')->with('success', 'Unit Apartment ' . $unit_apart->no_unit_apart . ' has been Updated!!');
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
        $unit_apart = UnitApart::find($id);
        $unit_apart->status = 0;

        $unit_apart->save();
        return redirect('/unit_apart')->with('success', 'Unit Apartment ' . $unit_apart->no_unit_apart . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = UnitApart::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'unit_apart',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
