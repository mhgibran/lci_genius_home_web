<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Floor;

class FloorController extends Controller
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
                                'module' => 'floor',
                                'data' => Floor::where('status','=',1)->get()
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
                                'module' => 'floor',
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
        $floor = new Floor;

        $floor->no_floor = $request->no_floor;
        $floor->status = $request->status;

        $floor->save();
        return redirect('/floor')->with('success', 'New Floor has been Submit!!');
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
        $data = Floor::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'floor',
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
        $floor = Floor::find($id);

        $floor->no_floor = $request->no_floor;
        $floor->status = $request->status;

        $floor->save();
        return redirect('/floor')->with('success', 'Floor Number ' . $floor->no_floor . ' has been Updated!!');
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
        $floor = Floor::find($id);
        $floor->status = 0;

        $floor->save();
        return redirect('/floor')->with('success', 'Floor Number ' . $floor->no_floor . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = Floor::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'floor',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
