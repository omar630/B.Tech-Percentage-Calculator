<?php

namespace App\Http\Controllers;
use App\Branche;
use App\Regulation;
use App\Subject;
use App\user_data;
use App\MarksData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

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
        $name = $user->name;
        $user_id = $user->id;

        $visitor_count = count(user_data::all());
        $visitor_count = str_split ( $visitor_count ,1  );
        $all_records = array();
        //return $user->id;
        if(MarksData::where('user_id', $user->id)->count()>0){
            for($i=1;$i<=4;$i++){
                for($j=1;$j<3;$j++)
                    $all_records[$i.'-'.$j] = Subject::where('year',$i)->where('sem',$j)->where('branch_id',$branch->id)->where('regulation_id',$regulation->id)->leftjoin('marks_data',function($join) use($user){
                        $join->on('marks_data.subject_id','=','subjects.id')->where('user_id','=',$user->id);
                    })->select('subjects.id','name','credit','gradepoint')->get();
                        //DB::raw("SELECT * FROM subjects left join(select * from marks_data where user_id=1)as b on b.subject_id=subjects.id")

            }
        }
        else{
            for($i=1;$i<=4;$i++){
                for($j=1;$j<3;$j++)
                    $all_records[$i.'-'.$j] = Subject::where('year',$i)->where('sem',$j)->where('branch_id',$branch->id)->where('regulation_id',$regulation->id)->get();

            }
        }
        //dd($all_records['3-1']);
            return view('home',['all_sem_records' => $all_records,'name' => $name, 'course' => $branch->name,'visitor_count' => $visitor_count,'user_id' => $user_id, 'course' => Branche::find($user->branch_id),'regulation' => Regulation::find($user->regulation_id)]);
    }
}
