<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\ReceiveableCard;
use App\UnitOwner;
use App\Title;
use App\BillOwner;
use App\UnitApart;
use App\User;
use DB;
use Auth;

class ReceiveableCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app', [
                                    'module' => 'receiveable_card',
                                    'data' => ReceiveableCard::select('*')
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
        $unit_owner = UnitOwner::find($id);
        $dataUnitOwner = DB::table("mst_unit_owner")
                                    ->select(DB::raw("mst_unit_owner.id_unit_owner, 
                                        concat(mst_title.nama_title, '. ', mst_unit_owner.nama_depan, ' ', mst_unit_owner.nama_belakang) as namaPenghuni, concat(mst_tower.kode_tower,mst_floor.no_floor,mst_unit_apart.no_unit_apart) as nomorUnit"))
                                    ->leftJoin('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                                    ->leftJoin('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                                    ->leftJoin('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                                    ->leftJoin('mst_title', 'mst_title.id_title', '=', 'mst_unit_owner.id_title')
                                    ->where('mst_unit_owner.id_unit_owner', $unit_owner->id_unit_owner)
                                    ->first();
        
        return view('app', [
                        'id' => $id,
                        'module' => 'receiveable_card',
                        'action' => 'view',
                        'data_unit_owner' => $dataUnitOwner,
                        'unit_owner' => $unit_owner
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
    }
}