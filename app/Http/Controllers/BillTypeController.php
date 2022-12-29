<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillType;

class BillTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('app', [
                                'module' => 'bill_type',
                                'data' => BillType::where('status','=',1)->get()
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
                                'module' => 'bill_type',
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
        $bill_type = new BillType;
        $bill_type->nama_bill_type = $request->nama_bill_type;
        $bill_type->harga_tarif = $request->harga_tarif;
        
        $bill_type->status = $request->status;

        $bill_type->save();
        return redirect('/bill_type')->with('success', 'New Bill Type has been Submit!!');
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
        $data = BillType::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'bill_type',
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
        $bill_type = BillType::find($id);
        $bill_type->harga_tarif = $request->harga_tarif;
        
        $bill_type->save();
        return redirect('/bill_type')->with('success', "Bill Type '" . $bill_type->nama_bill_type . "' has been Updated!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill_type = BillType::find($id);
        $bill_type->status = 0;

        $bill_type->save();
        return redirect('/bill_type')->with('success', "Bill Type '" . $bill_type->nama_bill_type . "' Successfully deleted !!");
    }
    public function deleteTemplate($id)
    {
        $data = BillType::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'bill_type',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
