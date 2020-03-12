<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
        $role = Role::where('name', $request->role)->get()[0];
        if(User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'dob'=>$request->dob,
            'gender'=>$request->gender,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'picture'=>'user.png',
            'account_name'=>$request->account_name,
            'bank_name'=>$request->bank_name,
            'status'=>'active',
            'role_id'=>$role->id
        ])){
            return view('admin.user.list');
        }
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return TYPE_NAME|User
     */
    public function show(User $user)
    {
        /** @var TYPE_NAME $user */
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function suspend($id){
        if(User::where('id', $id)->update(['status'=> 'suspended'])){
            return view('admin.user.list');
        }
        return view('admin.user.list');
    }

    public function activate($id){
        if(User::where('id', $id)->update(['status'=>'active'])){
            return view('admin.user.list');
        }
        return view('admin.user.list');
    }
}
