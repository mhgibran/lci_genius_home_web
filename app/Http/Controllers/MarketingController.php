<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marketing;

class MarketingController extends Controller
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
                                'module' => 'marketing',
                                'data' => Marketing::where('status','=',1)->get()
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
                                'module' => 'marketing',
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
        $marketing = new Marketing;

        $marketing->nama_marketing = $request->nama_marketing;
        $marketing->status = $request->status;

        $marketing->save();
        return redirect('/marketing')->with('success', 'New Marketing has been Submit!!');
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
        $data = Marketing::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'marketing',
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
        $marketing = Marketing::find($id);

        $marketing->nama_marketing = $request->nama_marketing;
        $marketing->status = $request->status;

        $marketing->save();
        return redirect('/marketing')->with('success', 'Marketing ' . $marketing->nama_marketing . ' has been Updated!!');
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
        $marketing = Marketing::find($id);
        $marketing->status = 0;

        $marketing->save();
        return redirect('/marketing')->with('success', 'Marketing ' . $marketing->nama_marketing . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = Marketing::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'marketing',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
