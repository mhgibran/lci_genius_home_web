<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\privilege;

class PrivilegeController extends Controller
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
        $priv_list = privilege::where('status', '=', 1)
                            ->get();
        return view('app', [
                                'module' => 'privilege',
                                'data' => $priv_list
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
        return view('app', [
                                'module' => 'privilege',
                                'action' => 'add',
                                
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
        $privilege = new privilege;

        $privilege->nama_priv = $request->nama_priv;
        $privilege->status = 1;

        $privilege->save();
        return redirect('/priv')->with('success', 'New Privilege has been Submit!!');
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
        $data = privilege::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'privilege',
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
        $privilege = privilege::find($id);

        $privilege->nama_priv = $request->nama_priv;

        $privilege->save();
        return redirect('/priv')->with('success', 'Privilege ' . $privilege->priv_status . ' ('.$privilege->nama_priv.') has been Updated!!');
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
        $privilege = privilege::find($id);
        $privilege->status = 0;

        $privilege->save();
        return redirect('/priv')->with('success', 'Privilege ' . $privilege->nama_priv . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = privilege::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'privilege',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
