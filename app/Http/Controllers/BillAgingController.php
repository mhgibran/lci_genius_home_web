<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillAging;
use App\BillType;
use App\PaymentOwner;
use App\UnitOwner;
use DB;
use Session;
use Auth;
use Excel;
use App\Exports\BillAgingExport;

class BillAgingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app', [
                    'module' => 'bill_aging',
                    'data' => DB::table('v_billing_aging')
                    ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','v_billing_aging.id_unit_owner')
                    ->join('mst_title','mst_title.id_title','=','mst_unit_owner.id_title')
                    ->get()
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
    }
    public function deleteTemplate($id)
    {
        //
    }
    public function export() 
    {
        return Excel::download(new BillAgingExport, 'BillingAging.xlsx');
    }
}