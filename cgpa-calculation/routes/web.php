<?php
use App\Subject;
use App\user_data;
use App\Regulation;
use Illuminate\Http\Request;
use App\Branche;
use App\Feedback;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$all_records = array();
	for($i=1;$i<4;$i++){
		for($j=1;$j<3;$j++)
			$all_records[$i.'-'.$j] = Subject::where('year',$i)->where('sem',$j)->get();
	}
	/*foreach ($all_records as $key => $value) {
		echo $key;
		foreach ($value as $key => $value2) {
			echo $key[0]->name.',';
		}
	}*/
	//return $all_records;
    return view('welcome',['all_sem_records' => $all_records]);
});

Route::get('/addsubject/{year}/{sem}/{subjectname}/{credits}/{branch}',function($y,$s,$sub,$c,$b){
	$ss = new Subject();
	$ss->regulation_id = 1;
	$ss->name = $sub;
	$ss->year = (int)$y;
	$ss->sem = (int)$s;
	$ss->credit = (int)$c+1;
	$ss->branch_id = (int)$b;
	$ss->save();
	return Subject::all();
});

Route::get('/submitDetails',function(Request $request){
	$branch = Branche::where('branch',$request->input('branch'))->first();
	$regulation = Regulation::where('regulation',$request->input('regulation'))->first();
	$ip = $request->ip();
	//dd($ip);
	$name = $request->input('name');
	$check = user_data::where('ip_address',$ip)->where('regulation_id',$regulation->id)->where('branch_id',$branch->id)->where('name',$name)->get();
	if(count($check)==0){
		$user = new user_data();
		$user->name = $request->input('name');
		$user->regulation_id = $regulation->id;
		$user->branch_id = $branch->id;
		$user->ip_address = $ip;
		$user->save();
	}
	$visitor_count = count(user_data::all());
	$visitor_count = str_split ( $visitor_count ,1  );
	$all_records = array();
	for($i=1;$i<=4;$i++){
		for($j=1;$j<3;$j++)
			$all_records[$i.'-'.$j] = Subject::where('year',$i)->where('sem',$j)->where('branch_id',$branch->id)->where('regulation_id',$regulation->id)->get();
	}
    return view('home',['all_sem_records' => $all_records,'name' => $name, 'course' => $request->input('branch'),'visitor_count' => $visitor_count]);
});

Route::any('submitFeedback',function(Request $request){
	$feedback = new Feedback();
	$feedback->name = $request->input('name');
	$feedback->rating = $request->input('value');
	$feedback->message = $request->input('message');
	$feedback->save();
	return 'submitted';
});

Route::any('getusersdata',function(Request $request){
   $data = DB::table('user_datas')->join('branches','user_datas.branch_id','branches.id')->join('regulations','regulations.id','user_datas.regulation_id')->select('name','branch','regulation')->oldest('user_datas.created_at')->get();
   foreach ($data as $key => $value) {
   	echo $key.' '.$value->name.'&emsp;'.$value->regulation.'&emsp;'.$value->branch.'<br>';
   }
});