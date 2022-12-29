<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ElectricityMeter;
use App\ElectricityMeterHistory;
use App\UnitOwner;
use App\Title;
use Excel;
use DB;
use App\Exports\ElectricityMeterExport;
use App\Imports\ElectricityMeterImport;

class ElectricityMeterController extends Controller
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
        //
        return view('app', [
                                'module' => 'electricity_meter',
                                'data' => ElectricityMeter::select('*')
                                    ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','listrik_meter.id_unit_apart')
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
        //
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
    public function deleteTemplate($id)
    {
        //
    }
    public function export() 
    {
        return Excel::download(new ElectricityMeterExport, 'ElectricityMeter.xlsx');
    }
    public function import(Request $request) 
    {
        Excel::import(new ElectricityMeterImport, $request->file('upload'));
        
        return redirect('/electricity_meter')->with('success', 'Upload Success!!');
    }
    public function get_meter($id){
        $data = DB::table('listrik_meter AS A')
                    ->join('mst_unit_apart AS B','B.id_unit_apart','=','A.id_unit_apart')
                    ->join('mst_unit_owner AS C','C.id_unit_apart','=','B.id_unit_apart')
                    ->where('C.id_unit_owner','=',$id)
                    ->first();
        return response()->json(array('ElectricityMeter' => $data), 200);
    }
}
