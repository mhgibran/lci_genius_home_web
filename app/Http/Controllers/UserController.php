<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\privilege;
use Validator;
use Session;

class UserController extends Controller
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
    protected function index()
    {
        $user_list = User::where('users.status', '=', 1)
                            ->join('mst_privilege', 'mst_privilege.priv_status', '=', 'users.priv_status')
                            ->get();
       // $priv_list = privilege::where('status', 1)
         //                   ->get();
        return view('app', [
                                'module' => 'user',
                                'data' => $user_list
           //                     'priv_list' => $priv_list
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
                                'module' => 'user',
                                'action' => 'add',
                                'priv_users' => privilege::where('status', 1)
                                                    ->get()
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
        $user = new User;
        
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->username = $request->login;
        $user->priv_status = $request->priv_status;
        $user->email = "admin@example.com";
        $user->status = 1;
        $user->save();
            
        
        return redirect('/user')->with('success', 'New User has been Submit!!');
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
        $data = User::find($id);
        $priv_list = privilege::where('status', 1)->get();
        return view('app', [
                                'id'                        => $id,
                                'module'                    => 'user',
                                'action'                    => 'edit',
                                'data'                      =>  $data,
                                'priv_list'                 => $priv_list,
                                
                            ]);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id2)
    {
        //
        $user = User::find($id2);

        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->priv_status = $request->priv_status;

        $user->save();
        return redirect('/user')->with('success', 'User ' . $user->login . '  has been Updated!!');

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
        $user = User::find($id);
        $user->status = 0;

        $user->save();
        return redirect('/user')->with('success', 'User ' . $user->login . ' Successfully deleted !!');
    }
    public function deleteTemplate($id)
    {
        $data = User::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'user',
                                'action'    => 'delete',
                                'data'      =>  $data
                            ]);
    }
}
