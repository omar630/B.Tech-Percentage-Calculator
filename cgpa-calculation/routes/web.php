<?php
use App\Subject;
use App\user_data;
use App\Regulation;
use Illuminate\Http\Request;
use App\Branche;
use App\Feedback;
use App\Track;
use App\User;
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
	$regulations = Regulation::all();
	$branches = Branche::all();
    return view('welcome',['all_sem_records' => $all_records, 'regulations' => $regulations,'branches' => $branches]);
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
	$branch = $request->input('branch');
	$regulation = $request->input('regulation');
	$ip = $request->ip();
	//dd($ip);
	$name = $request->input('name');
	$check = user_data::where('ip_address',$ip)->where('regulation_id',$regulation)->where('branch_id',$branch)->where('name',$name)->get();
	$user = new user_data();
	$user_id=1;
	if(count($check)==0){		
		$user->name = $request->input('name');
		$user->regulation_id = $regulation;
		$user->branch_id = $branch;
		$user->ip_address = $ip;
		$user_id=$user->save();
		$user_id = $user->id;
	}
	else{
		$user_id = $check[0]->id;
	}
	
	$visitor_count = count(user_data::all());
	$visitor_count = str_split ( $visitor_count ,1  );
	$all_records = array();
	for($i=1;$i<=4;$i++){
		for($j=1;$j<3;$j++)
			$all_records[$i.'-'.$j] = Subject::where('year',$i)->where('sem',$j)->where('branch_id',$branch)->where('regulation_id',$regulation)->get();
	}
    return view('home',['all_sem_records' => $all_records,'name' => $name, 'course' => Branche::find($request->input('branch')),'regulation' => Regulation::find($request->input('regulation')),'visitor_count' => $visitor_count,'user_id' => $user_id]);
});

Route::any('submitFeedback',function(Request $request){
	$feedback = new Feedback();
	$feedback->name = $request->input('name');
	$feedback->rating = $request->input('rating');
	$feedback->message = $request->input('message');
	$feedback->save();
	return 'submitted';
});

Route::any('getusersdata',function(Request $request){
   $data = DB::table('user_datas')->join('branches','user_datas.branch_id','branches.id')->join('regulations','regulations.id','user_datas.regulation_id')->select('name','branch','regulation')->latest('user_datas.created_at')->get();
   foreach ($data as $key => $value) {
   	echo $key.' '.$value->name.'&emsp;'.$value->regulation.'&emsp;'.$value->branch.'<br>';
   }
});

Route::get('updateTrack',function(Request $request){
	$name = $request->input('name');
	$user_id = $request->input('id');
	$track = new Track();
	$track->name = $name;
	$track->user_datas_id = $user_id;
	$track->save();
	return 'true';
});
Route::get('getfeedbacks',function(){
   $data = Feedback::all();
   foreach ($data as $key => $value) {
   	echo ($key+1).') <b>Message:</b>'.$value->message.'&emsp; <b>name</b>='.$value->name.'<br>';
   }
});
Route::get('getclicks',function(){
	$track_record = Track::join('user_datas','user_datas.id','tracks.user_datas_id')->get();
	foreach ($track_record as $key => $value) {
		echo ($key+1).')&emsp; icon='.$value->name.'<br>';
	}
});

Route::get('addsubject',function(){
	$regulations = Regulation::all();
	$branches = Branche::all();
	return view('addsubject',['regulations' => $regulations,'branches' => $branches]);
});
Route::get('addsubjects',function(Request $request){
	$sem= $request->input('sem');
	$year_sem=explode('-',$sem);
	$year = $year_sem[0];	
	$sem = $year_sem[1];
	$branch_name_fk = $request->input('branch');
	$regulation_id_fk = $request->input('regulation');
	$subject_count = $request->input('count');
	$subjects = array(array());
	for($i=1;$i<=$subject_count;$i++){
		if($request->input('subject'.$i)!=null){
			$subjects[$i-1]=array("name"=>$request->input('subject'.$i),"credit"=>$request->input('credits'.$i),"year"=>$year,"sem"=>$sem,"branch_id"=>$branch_name_fk,"regulation_id"=>$regulation_id_fk);
		}
	}
	if(Subject::insert($subjects)){
		$regulations = Regulation::all();
		$branches = Branche::all();
		return view('addsubject',['regulations' => $regulations,'branches' => $branches]);
	}
	else
		return 'some error occurred';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('savemarks','MarksDataController@store')->name('savemarks');

Route::any('getregisteredusers',function(){
	$user = User::all();
	echo "<ol>";
	foreach ($user as $key ) {
		echo "<li>".$key->email."&nbsp;=>".$key->name."</li>";
	}
});

Route::get('addregulation',function(){
	return view('regulation.add');
});
Route::post('addregulation','RegulationController@store')->name('addregulation');
Route::any('edit',function(){
	return view('Admin.subjects.index');
});





//one-one return subjects of particuar branch
Route::any('getsubjects',function(){
	ddd (Branche::find(2)->subjects);
});
//belongs to inverse one-one return branch of specific subject
Route::any('getbranch/{id}',function($id){
	dd(Subject::findOrFail($id)->getbranch->branch);
});

//one-many user has many subjects marks
Route::any('getusermarks/{id}',function($id){
	dd(User::find($id)->getmarks);
});
