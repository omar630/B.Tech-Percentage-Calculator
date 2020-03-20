<?php

namespace App\Http\Controllers;
use App\Branche;
use App\Regulation;
use App\Subject;
use App\user_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $branch = Branche::where('id',$user->branch_id)->first();
    $regulation = Regulation::where('id',$user->regulation_id)->first();
    //dd($ip);
    $name = $user->name;
    $user_id = $user->id;
    
    $visitor_count = count(user_data::all());
    $visitor_count = str_split ( $visitor_count ,1  );
    $all_records = array();
    for($i=1;$i<=4;$i++){
        for($j=1;$j<3;$j++)
            $all_records[$i.'-'.$j] = Subject::where('year',$i)->where('sem',$j)->where('branch_id',$branch->id)->where('regulation_id',$regulation->id)->get();
    }
        return view('home',['all_sem_records' => $all_records,'name' => $name, 'course' => $branch->name,'visitor_count' => $visitor_count,'user_id' => $user_id]);
    }
}
