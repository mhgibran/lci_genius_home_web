<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TenantCategory;

class TenantCategoryController extends Controller
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
                                'module' => 'tenant_category',
                                'data' => TenantCategory::where('status','=',1)->get()
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
                                'module' => 'tenant_category',
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
        $tenant_category = new TenantCategory;

        $tenant_category->nama_tenant_category = $request->nama_tenant_category;
        $tenant_category->status = $request->status;

        $tenant_category->save();
        return redirect('/tenant_category')->with('success', 'New Tenant Category has been Submit!!');
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
        $data = TenantCategory::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'tenant_category',
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
        $tenant_category = TenantCategory::find($id);

        $tenant_category->nama_tenant_category = $request->nama_tenant_category;
        $tenant_category->status = $request->status;

        $tenant_category->save();
        return redirect('/tenant_category')->with('success', 'Tenant Category ' . $tenant_category->nama_tenant_category . '  has been Updated!!');
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
        $tenant_category = TenantCategory::find($id);
        $tenant_category->status = 0;

        $tenant_category->save();
        return redirect('/tenant_category')->with('success', 'Tenant Category ' . $tenant_category->nama_tenant_category . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = TenantCategory::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'tenant_category',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
