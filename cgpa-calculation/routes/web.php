<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectTypeController;
use App\Http\Controllers\UserController;
use App\Imports\SubjectsImport;
use App\Models\Branche;
use App\Models\Feedback;
use App\Models\Regulation;
use App\Models\Subject;
use App\Models\Track;
use App\Models\User;
use App\Models\user_data;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/', [UserController::class, 'index'])->name('home');

Route::get('/addsubject/{year}/{sem}/{subjectname}/{credits}/{branch}', function ($y, $s, $sub, $c, $b) {
    $ss = new Subject();
    $ss->regulation_id = 1;
    $ss->name = $sub;
    $ss->year = (int) $y;
    $ss->sem = (int) $s;
    $ss->credit = (int) $c + 1;
    $ss->branch_id = (int) $b;
    $ss->save();

    return Subject::all();
});

Route::get('/submitDetails', function (Request $request) {
    $branch = $request->input('branch');
    $regulation = $request->input('regulation');
    $ip = $request->ip();
    //dd($ip);
    $name = $request->input('name');
    $check = user_data::where('ip_address', $ip)->where('regulation_id', $regulation)->where('branch_id', $branch)->where('name', $name)->get();
    $user = new user_data();
    $user_id = 1;
    if (count($check) == 0) {
        $user->name = $request->input('name');
        $user->regulation_id = $regulation;
        $user->branch_id = $branch;
        $user->ip_address = $ip;
        $user_id = $user->save();
        $user_id = $user->id;
    } else {
        $user_id = $check[0]->id;
    }

    $visitor_count = count(user_data::all());
    $visitor_count = str_split($visitor_count, 1);
    $all_records = [];
    for ($i = 1; $i <= 4; $i++) {
        for ($j = 1; $j < 3; $j++) {
            $all_records[$i . '-' . $j] = Subject::where('year', $i)->where('sem', $j)->where('branch_id', $branch)->where('regulation_id', $regulation)->get();
        }
    }

    return view('home', ['all_sem_records' => $all_records, 'name' => $name, 'course' => Branche::find($request->input('branch')), 'regulation' => Regulation::find($request->input('regulation')), 'visitor_count' => $visitor_count, 'user_id' => $user_id]);
});

Route::any('submitFeedback', function (Request $request) {
    $feedback = new Feedback();
    $feedback->name = $request->input('name');
    $feedback->rating = $request->input('rating');
    $feedback->message = $request->input('message');
    $feedback->save();

    return 'submitted';
});

Route::any('getusersdata', function (Request $request) {
    $data = DB::table('user_datas')->join('branches', 'user_datas.branch_id', 'branches.id')->join('regulations', 'regulations.id', 'user_datas.regulation_id')->select('name', 'branch', 'regulation')->latest('user_datas.created_at')->get();
    foreach ($data as $key => $value) {
        echo $key . ' ' . $value->name . '&emsp;' . $value->regulation . '&emsp;' . $value->branch . '<br>';
    }
});

Route::get('updateTrack', function (Request $request) {
    $name = $request->input('name');
    $user_id = $request->input('id');
    $track = new Track();
    $track->name = $name;
    $track->user_datas_id = $user_id;
    $track->save();

    return 'true';
});
Route::get('getfeedbacks', function () {
    $data = Feedback::all();
    foreach ($data as $key => $value) {
        echo ($key + 1) . ') <b>Message:</b>' . $value->message . '&emsp; <b>name</b>=' . $value->name . '<br>';
    }
});
Route::get('getclicks', function () {
    $track_record = Track::join('user_datas', 'user_datas.id', 'tracks.user_datas_id')->get();
    foreach ($track_record as $key => $value) {
        echo ($key + 1) . ')&emsp; icon=' . $value->name . '<br>';
    }
});

Route::get('addsubject', function () {
    $regulations = Regulation::all();
    $branches = Branche::all();

    return view('addsubject', ['regulations' => $regulations, 'branches' => $branches]);
});
Route::get('addsubjects', function (Request $request) {
    $sem = $request->input('sem');
    $year_sem = explode('-', $sem);
    $year = $year_sem[0];
    $sem = $year_sem[1];
    $branch_name_fk = $request->input('branch');
    $regulation_id_fk = $request->input('regulation');
    $subject_count = $request->input('count');
    $subjects = [[]];
    for ($i = 1; $i <= $subject_count; $i++) {
        if ($request->input('subject' . $i) != null) {
            $subjects[$i - 1] = ['name' => $request->input('subject' . $i), 'credit' => $request->input('credits' . $i), 'year' => $year, 'sem' => $sem, 'branch_id' => $branch_name_fk, 'regulation_id' => $regulation_id_fk];
        }
    }
    if (Subject::insert($subjects)) {
        $regulations = Regulation::all();
        $branches = Branche::all();

        return view('addsubject', ['regulations' => $regulations, 'branches' => $branches]);
    } else {
        return 'some error occurred';
    }
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('savemarks', 'MarksDataController@store')->name('savemarks');

Route::any('getregisteredusers', function () {
    $user = User::all();
    echo '<ol>';
    foreach ($user as $key) {
        echo '<li>' . $key->email . '&nbsp;=>' . $key->name . '</li>';
    }
});
Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('save-profile', [UserController::class, 'saveProfile'])->name('user.save-profile');

Route::get('addregulation', function () {
    return view('regulation.add');
});
Route::post('addregulation', 'RegulationController@store')->name('addregulation');
Route::any('edit', function () {
    return view('Admin.subjects.index');
});

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login.get');
Route::post('perform-login', [AdminController::class, 'performLogin'])->name('admin.login.post');
Route::middleware(['role:admin|super-admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('permission:dashboard');

    Route::get('regulation', [RegulationController::class, 'getAllRegulations'])->name('regulation.get')->middleware('permission:regulation');
    Route::post('update-regulation', [RegulationController::class, 'updateRegulation'])->name('regulation.update.post');
    Route::delete('delete-regulation', [RegulationController::class, 'deleteRegulation'])->name('regulation.delete.post');
    Route::put('add-regulation', [RegulationController::class, 'store'])->name('regulation.add.post');

    Route::get('branch', [BranchController::class, 'getAllBranch'])->name('branch.get')->middleware('permission:branch');
    Route::post('update-branch', [BranchController::class, 'updateBranch'])->name('branch.update.post');
    Route::delete('delete-branch', [BranchController::class, 'deleteBranch'])->name('branch.delete.post');
    Route::put('add-branch', [BranchController::class, 'addBranch'])->name('branch.add.post');

    Route::get('subject-type', [SubjectTypeController::class, 'index'])->name('subject-type.get')->middleware('permission:subject-type');
    Route::post('update-subject-type', [SubjectTypeController::class, 'update'])->name('subject-type.update.post');
    Route::delete('delete-subject-type', [SubjectTypeController::class, 'destroy'])->name('subject-type.delete.post');
    Route::put('add-subject-type', [SubjectTypeController::class, 'store'])->name('subject-type.add.post');

    Route::get('subject', [SubjectController::class, 'index'])->name('subject.get')->middleware('permission:subjects');
    Route::post('update-subject', [SubjectController::class, 'update'])->name('subject.update.post');
    Route::delete('delete-subject', [SubjectController::class, 'destroy'])->name('subject.delete.post');
    Route::put('add-subject', [SubjectController::class, 'store'])->name('subject.add.post');

    Route::get('visited-users', [UserController::class, 'getAllVisitedUsers'])->name('visited-user.get')->middleware('permission:visitor');

    Route::get('registered-users', [UserController::class, 'getAllRegisteredUsers'])->name('registered-user.get')->middleware('permission:registered-user');

    Route::get('upload-subjects', [SubjectController::class, 'uploadSubjectView'])->name('upload-subjects.get')->middleware('permission:upload-subject');
    Route::post('upload-subjects-execl', [SubjectController::class, 'uploadSubjectsExcel'])->name('upload-subjects-excel.post');
    Route::any('save-subjects', [SubjectController::class, 'saveSubjects'])->name('save-subjects.post');
});
