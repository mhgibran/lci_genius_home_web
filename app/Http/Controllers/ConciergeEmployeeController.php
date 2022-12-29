<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\ConciergeEmployee;
use App\User;

class ConciergeEmployeeController extends Controller
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
                                'module' => 'concierge_employee',
                                'data' => ConciergeEmployee::where('status','=',1)->get()
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
                                'module' => 'concierge_employee',
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
        $concierge_employee = new ConciergeEmployee;

        $concierge_employee->nama_concierge_employee = $request->nama_concierge_employee;

        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_lahir);
        $concierge_employee->tgl_lahir      = $date;
        $concierge_employee->status_available = $request->status_available;
        $concierge_employee->status = $request->status;
        $concierge_employee->concierge_login = $request->nama_concierge_employee.'-concierge';
        $concierge_employee->save();

        $user = new User;
        $user->login = $request->nama_concierge_employee.'-concierge';
        $user->username = $request->nama_concierge_employee.'-concierge';
        $user->name = $request->nama_concierge_employee;
        $user->priv_status = 13;
        $user->status = 1;
        $user->password = Hash::make('password');
        $user->save();

        return redirect('/concierge_employee')->with('success', 'New Concierge Employee has been Submit!!');
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
        $data = ConciergeEmployee::find($id);
        $data->tgl_lahir= \DateTime::createFromFormat('Y-m-d', $data->tgl_lahir)->format('d-m-Y');

        return view('app', [
                                'id'        => $id,
                                'module'    => 'concierge_employee',
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
        $concierge_employee = ConciergeEmployee::find($id);
        $user = User::where("login","=",$concierge_employee->concierge_login)->first();

        $concierge_employee->nama_concierge_employee = $request->nama_concierge_employee;
        $date = \DateTime::createFromFormat('d-m-Y', $request->tgl_lahir);
        $concierge_employee->tgl_lahir = $date;
        $concierge_employee->status_available = $request->status_available;
        $concierge_employee->status = $request->status;
        $concierge_employee->save();                            

        $user->login = $request->nama_concierge_employee.'-concierge';
        $user->username = $request->nama_concierge_employee.'-concierge';
        $user->name = $request->nama_concierge_employee;
        $user->save();

        $concierge_employee->concierge_login = $request->nama_concierge_employee.'-concierge';
        $concierge_employee->save();
        return redirect('/concierge_employee')->with('success', 'Concierge  Employee ' . $concierge_employee->nama_concierge_employee . ' has been Updated!!');
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
        $concierge_employee = ConciergeEmployee::find($id);
        $concierge_employee->status = 0;

        $concierge_employee->save();

        $user = User::where("login","=",$concierge_employee->concierge_login)->first();
        $user->status = 0;
        $user->save();
        return redirect('/concierge_employee')->with('success', 'Concierge  Employee ' . $concierge_employee->nama_concierge_employee . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = ConciergeEmployee::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'concierge_employee',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
