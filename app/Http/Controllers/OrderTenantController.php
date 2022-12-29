<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderMenuTenant;
use App\MenuTenant;
use Auth;
use DB;

class OrderTenantController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $data = DB::table('mst_menu_unit_tenant')
                            ->join('mst_unit_tenant','mst_unit_tenant.id_unit_tenant','=','mst_menu_unit_tenant.id_unit_tenant')
                            ->where('mst_menu_unit_tenant.id_menu_unit_tenant','=',$id)
                            ->first();
        return view('app', [
                                'id' => $id,
                                'module' => 'order_menu_tenant',
                                'action' => 'add',
                                'data' => $data
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
        $get_unit_apart = DB::table('mst_unit_owner')
                            ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                            ->where('mst_unit_owner.login','=',Auth::User()->login)
                            ->first();

        $get_last_nbr = DB::table("mst_order_menu_tenant")
                                    ->select(DB::raw('order_num'))
                                    ->where('id_unit_tenant','=', $request->id_unit)
                                    ->orderBy('order_num', 'desc')
                                    ->first();
        if (!empty($get_last_nbr)) {
            $nextNomor = $get_last_nbr->order_num;
        }
        else{
            $nextNomor = 0;
        }

        if ($nextNomor > 0 ) {
            $nextNomor++;
        }
        else{
            $nextNomor = 1;
        }

        $strNextNomor = str_pad($nextNomor,4,"0",STR_PAD_LEFT);

        $order = new OrderMenuTenant;
        $date = date('Y-m-d');
        $order->no_order_menu_tenant = 'ORDER'.'/'.$request->code.'/'.$get_unit_apart->no_unit_apart.'/'.$strNextNomor;
        $order->order_num = $nextNomor;
        $order->id_unit_tenant = $request->id_unit;
        $order->id_menu_unit_tenant = $request->id;
        $order->qty = $request->qty;
        $order->total_order = str_replace(",","", $request->total_order);
        $order->tgl_order = $date;
        $order->deskripsi = $request->description;
        $order->id_user = Auth::User()->id_user;
        $order->id_status_order = 1;
        $order->status = $request->status;

        $order->save();
        return redirect('/order_list')->with('success', 'New Order has been Submit!!');
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
        $data = MenuTenant::where('mst_menu_unit_tenant.id_unit_tenant','=',$id)
                            ->join('mst_menu_category','mst_menu_category.id_menu_category','=','mst_menu_unit_tenant.id_menu_category')
                            ->join('mst_unit_tenant','mst_unit_tenant.id_unit_tenant','=','mst_menu_unit_tenant.id_unit_tenant')
                            ->get();
        return view('app', [
                                'module' => 'order_menu_tenant',
                                'action' => 'view',
                                'data' => $data
                            ]);
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
