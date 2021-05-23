<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\User;
use App\Models\user_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:super-admin|admin'])->except(['login', 'performLogin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::check() && auth()->user()->isAdmin()) {
            return redirect(route('admin.dashboard'));
        }
        return view('admin.login');
    }

    public function performLogin(Request $request)
    {
        $fields = $request->only(['email', 'password']);
        if (Auth::attempt($fields)) {
            return redirect(route('admin.dashboard'));
        }
        $request->session()->flash('alert-type', 'danger');
        $request->session()->flash('message', "invalid credentials");
        return redirect(route('admin.login.get'));
    }

    public function dashboard(Request $request)
    {
        $registeredUsers = User::all()->count();
        $visitedUsers = user_data::all()->count();
        $clicks = Track::groupBy('name')->select(DB::raw("count(*) as count, name"))->get();
        return view('admin.dashboard')
            ->with('registeredUserCount', $registeredUsers)
            ->with('clicks', $clicks)
            ->with('visitedUserCount', $visitedUsers);
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
}
