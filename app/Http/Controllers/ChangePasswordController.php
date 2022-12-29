<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
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
        $data = User::find($id);
        return view('app', [
                                'id'        => $id,
                                'module'    => 'change_password',
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
        $user = User::find($id);

        if($request->new_password !== $request->re_new_password){
            return redirect('/change_password/'.$id.'/edit')->with('success', 'The new password you entered does not match!!');
        }else if(Hash::check($request->curr_password, $user->password)){
            $user->password = hash::make($request->new_password);       
            $user->save();
            return redirect('/change_password/'.$id.'/edit')->with('success', 'The password has been changed, please log out first');
        }else{
            return redirect('/change_password/'.$id.'/edit')->with('success', 'The current password you entered does not match!!');    
        }
    }

}
