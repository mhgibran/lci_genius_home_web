<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConciergeCategory;

class ConciergeCategoryController extends Controller
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
                                'module' => 'concierge_category',
                                'data' => ConciergeCategory::where('status','=',1)->get()
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
                                'module' => 'concierge_category',
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
        $concierge_category = new ConciergeCategory;

        $concierge_category->kode_concierge_category = $request->kode_concierge_category;
        $concierge_category->nama_concierge_category = $request->nama_concierge_category;
        $concierge_category->status = $request->status;

        $concierge_category->save();
        return redirect('/concierge_category')->with('success', 'New Concierge Category has been Submit!!');
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
        $data = ConciergeCategory::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'concierge_category',
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
        $concierge_category = ConciergeCategory::find($id);

        $concierge_category->kode_concierge_category = $request->kode_concierge_category;
        $concierge_category->nama_concierge_category = $request->nama_concierge_category;
        $concierge_category->status = $request->status;

        $concierge_category->save();
        return redirect('/concierge_category')->with('success', 'Concierge Category ' . $concierge_category->nama_complain_category . '  has been Updated!!');
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
        $concierge_category = ConciergeCategory::find($id);
        $concierge_category->status = 0;

        $concierge_category->save();
        return redirect('/concierge_category')->with('success', 'Concierge Category ' . $concierge_category->nama_complain_category . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = ConciergeCategory::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'concierge_category',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
