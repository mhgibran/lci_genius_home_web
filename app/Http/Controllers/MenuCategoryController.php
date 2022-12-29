<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuCategory;

class MenuCategoryController extends Controller
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
                                'module' => 'menu_category',
                                'data' => MenuCategory::where('status','=',1)->get()
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
                                'module' => 'menu_category',
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
        $menu_category = new MenuCategory;

        $menu_category->nama_menu_category = $request->nama_menu_category;
        $menu_category->status = $request->status;

        $menu_category->save();
        return redirect('/menu_category')->with('success', 'New Menu Category has been Submit!!');
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
        $data = MenuCategory::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'menu_category',
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
        $menu_category = MenuCategory::find($id);

        $menu_category->nama_menu_category = $request->nama_menu_category;
        $menu_category->status = $request->status;

        $menu_category->save();
        return redirect('/menu_category')->with('success', 'Menu Category ' . $menu_category->nama_menu_category . ' has been Updated!!');
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
        $menu_category = MenuCategory::find($id);
        $menu_category->status = 0;

        $menu_category->save();
        return redirect('/menu_category')->with('success', 'Menu Category ' . $menu_category->nama_menu_category . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = MenuCategory::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'menu_category',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
