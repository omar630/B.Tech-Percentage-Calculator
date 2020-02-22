<?php
use App\Subject;
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
	$record = new Subject();
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

Route::get('/addsubject/{year}/{sem}/{subjectname}/{credits}',function($y,$s,$sub,$c){
	$ss = new Subject();
	$ss->regulation_id = 1;
	$ss->name = $sub;
	$ss->year = (int)$y;
	$ss->sem = (int)$s;
	$ss->credit = (int)$c+1;;
	$ss->save();
	return Subject::all();
});
