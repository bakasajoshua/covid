<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $users = User::with(['user_type', 'lab'])
        ->when($user->user_type_id == 4, function($query) use($user){
            return $query->where(['organisation_id' => $user->organisation_id]);
        })
        ->get();
        return view('tables.users', compact('users'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $labs = DB::table('labs')->get();
        $user_types = DB::table('user_types')->get();
        $organisations = DB::table('organisations')->get();
        return view('forms.user', compact('labs', 'user_types', 'organisations'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->fill($request->all());
        if(auth()->user()->user_type_id == 4){
            $user->organisation_id = auth()->user()->organisation_id;
            $user->user_type_id = 5;
        }
        $user->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $labs = DB::table('labs')->get();
        $user_types = DB::table('user_types')->get();
        $organisations = DB::table('organisations')->get();
        return view('forms.user', compact('labs', 'user_types', 'user', 'organisations')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->save();
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
