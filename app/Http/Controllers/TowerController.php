<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tower;

class TowerController extends Controller
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
                                'module' => 'tower',
                                'data' => Tower::where('status','=',1)->get()
                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app', [
                                'module' => 'tower',
                                'action' => 'add'
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
        $tower = new Tower;

        $tower->kode_tower = $request->kode_tower;
        $tower->nama_tower = $request->nama_tower;
        $tower->status = $request->status;

        $tower->save();
        return redirect('/tower')->with('success', 'New Tower has been Submit!!');
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
        $data = Tower::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'tower',
                                'action'    => 'edit',
                                'data'      =>  $data
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
        $tower = Tower::find($id);

        $tower->kode_tower = $request->kode_tower;
        $tower->nama_tower = $request->nama_tower;
        $tower->status = $request->status;

        $tower->save();
        return redirect('/tower')->with('success', 'Tower ' . $tower->nama_tower . '  has been Updated!!');
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
        $tower = Tower::find($id);
        $tower->status = 0;

        $tower->save();
        return redirect('/tower')->with('success', 'Tower ' . $tower->nama_tower . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = Tower::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'tower',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
