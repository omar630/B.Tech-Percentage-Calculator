<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use App\Models\Regulation;
use App\Models\Subject;
use App\Models\User;
use App\Models\user_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        $all_records = [];
        for ($i = 1; $i < 4; $i++) {
            for ($j = 1; $j < 3; $j++) {
                $all_records[$i . '-' . $j] = Subject::where('year', $i)->where('sem', $j)->get();
            }
        }
        /*foreach ($all_records as $key => $value) {
        echo $key;
        foreach ($value as $key => $value2) {
            echo $key[0]->name.',';
        }
    }*/
        //return $all_records;
        $regulations = Regulation::all();
        $branches = Branche::all();

        return view('welcome', ['all_sem_records' => $all_records, 'regulations' => $regulations, 'branches' => $branches]);
    }
    public function getAllVisitedUsers(Request $request)
    {
        $visitedUsers = user_data::with('regulation', 'branch')->get();
        return view('admin.visited-users')->with('visitedUsers', $visitedUsers);
    }

    public function getAllRegisteredUsers(Request $request)
    {
        $users = User::with('regulation', 'branch')->get();
        return view('admin.registered-users')->with('users', $users);
    }

    public function profile(Request $request)
    {
        if (Auth::check()) {
            $user = auth()->user();
            $branches = Branche::all();
            $regulations = Regulation::all();
            return view('auth.profile')->with('user', $user)->with('regulations', $regulations)->with('branches', $branches);
        }
        return redirect(route('login'));
    }

    public function saveProfile(Request $request)
    {
        $result = User::where('id', auth()->user()->id)->update($request->except(['_token']));
        dd($result);
        return 'asd';
    }
}
