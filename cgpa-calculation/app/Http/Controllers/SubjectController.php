<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use App\Models\Regulation;
use App\Models\Subject;
use App\Models\SubjectType;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function __construct(ApiResponseService $apiResponseService)
    {
        $this->apiService = $apiResponseService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = Subject::with('branch', 'subjectType')->latest('created_at')->get();
        $subjectTypes = SubjectType::all();
        $branches = Branche::all();
        $regulations = Regulation::all();
        return view('admin.subject')
            ->with('subjects', $subjects)
            ->with('branches', $branches)
            ->with('regulations', $regulations)
            ->with('subjectTypes', $subjectTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->name = $request->subject_name;
        $subject->year = $request->subject_year;
        $subject->sem = $request->subject_sem;
        $subject->regulation_id = $request->regulation_id;
        $subject->branch_id = $request->branch_id;
        $subject->credit = $request->subject_credit;
        $subject->subject_type_id = $request->subject_type_id;
        if ($subject->save()) {
            return $this->apiService->success([
                'notify' => [
                    'type' => 'success',
                    'message' => 'subject added'
                ]
            ]);
        }
        return $this->apiService->error([
            'notify' => [
                'type' => 'error',
                'message' => 'Unable to save'
            ]
        ]);
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
    public function updateSubject(Request $request)
    {
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
        $subject = Subject::find($request->subject_id);
        if ($subject) {
            $result = $subject->update([
                'id' => $request->subject_id
            ], $request->except('subject_id'));
            if ($result) {
                return $this->apiService->success([
                    'notify' => [
                        'type' => 'success',
                        'message' => 'Subject Updated'
                    ]
                ]);
            }
        }
        return $this->apiService->error([
            'notify' => [
                'type' => 'error',
                'message' => 'Unable to save'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Subject::destroy($request->subject_id);
        return $this->apiService->success([
            'notify' => [
                'type' => 'success',
                'message' => 'Subject deleted'
            ]
        ]);
    }
}
