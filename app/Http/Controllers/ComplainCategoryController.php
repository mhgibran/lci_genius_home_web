<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComplainCategory;

class ComplainCategoryController extends Controller
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
                                'module' => 'complain_category',
                                'data' => ComplainCategory::where('status','=',1)->get()
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
                                'module' => 'complain_category',
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
        $complain_category = new ComplainCategory;

        $complain_category->kode_complain_category = $request->kode_complain_category;
        $complain_category->nama_complain_category = $request->nama_complain_category;
        $complain_category->status = $request->status;

        $complain_category->save();
        return redirect('/complain_category')->with('success', 'New Complain Category has been Submit!!');
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
        $data = ComplainCategory::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'complain_category',
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
        $complain_category = ComplainCategory::find($id);

        $complain_category->kode_complain_category = $request->kode_complain_category;
        $complain_category->nama_complain_category = $request->nama_complain_category;
        $complain_category->status = $request->status;

        $complain_category->save();
        return redirect('/complain_category')->with('success', 'Complain Category ' . $complain_category->nama_complain_category . '  has been Updated!!');
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
        $complain_category = ComplainCategory::find($id);
        $complain_category->status = 0;

        $complain_category->save();
        return redirect('/complain_category')->with('success', 'Complain Category ' . $complain_category->nama_complain_category . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = ComplainCategory::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'complain_category',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
