<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxMethod;

class TaxMethodController extends Controller
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
                                'module' => 'tax_method',
                                'data' => TaxMethod::where('status','=',1)->get()
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
                                'module' => 'tax_method',
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
        $tax_method = new TaxMethod;

        $tax_method->kode_tax_method = $request->kode_tax_method;
        $tax_method->nama_tax_method = $request->nama_tax_method;
        $tax_method->tax_out = $request->tax_out;
        $tax_method->pph_4_2 = $request->pph_4_2;
        $tax_method->pph_23 = $request->pph_23;
        $tax_method->pph_final = $request->pph_final;
        $tax_method->status = $request->status;

        $tax_method->save();
        return redirect('/tax_method')->with('success', 'New Tax Method has been Submit!!');
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
        $data = TaxMethod::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'tax_method',
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
        $tax_method = TaxMethod::find($id);

        $tax_method->kode_tax_method = $request->kode_tax_method;
        $tax_method->nama_tax_method = $request->nama_tax_method;
        $tax_method->tax_out = $request->tax_out;
        $tax_method->pph_4_2 = $request->pph_4_2;
        $tax_method->pph_23 = $request->pph_23;
        $tax_method->pph_final = $request->pph_final;
        $tax_method->status = $request->status;

        $tax_method->save();
        return redirect('/tax_method')->with('success', 'Tax Method ' . $tax_method->nama_tax_method = $request->nama_tax_method . ' has been Updated!!');
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
        $tax_method = TaxMethod::find($id);
        $tax_method->status = 0;

        $tax_method->save();
        return redirect('/tax_method')->with('success', 'Tax Method ' . $tax_method->nama_tax_method = $request->nama_tax_method . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = TaxMethod::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'tax_method',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
