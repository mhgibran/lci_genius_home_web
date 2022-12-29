<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitApart;
use App\UnitOwner;
use DB;

class ElectricityPowerInstalledController extends Controller
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
    }
    public function import(Request $request) 
    {
    }
    public function get_power($id){
        $data = DB::table('mst_unit_owner AS A')
                    ->join('mst_unit_apart AS B','B.id_unit_apart','=','A.id_unit_apart')
                    ->where('A.id_unit_owner','=',$id)
                    ->first();
        return response()->json(array('ElectricityPowerInstalled' => $data), 200);
    }
}
