<?php

namespace App\Http\Controllers;

use App\Models\SubjectType;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;

class SubjectTypeController extends Controller
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
    public function index()
    {
        $subjectTypes = SubjectType::withCount('subject')->get();
        return view('admin.subject-type')->with('subjectTypes', $subjectTypes);
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
        $existingSubjectType = SubjectType::where('name', $request->subject_type_name)->first();
        if ($existingSubjectType) {
            return $this->apiService->error([
                'notify' => [
                    'type' => 'error',
                    'message' => 'subject type already exists'
                ]
            ]);
        }
        $subjectType = new SubjectType();
        $subjectType->name = $request->subject_type_name;
        if ($subjectType->save()) {
            return $this->apiService->success([
                'notify' => [
                    'type' => 'success',
                    'message' => 'Added'
                ]
            ]);
        }
        return $this->apiService->success([
            'notify' => [
                'type' => 'error',
                'message' => 'Unable to save'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectType  $subjectType
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectType $subjectType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectType  $subjectType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectType  $subjectType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $existingSubjectType = SubjectType::where('name', $request->subject_type_name)->first();
        if ($existingSubjectType && $existingSubjectType->id != $request->subject_type_id) {
            return $this->apiService->error([
                'notify' => [
                    'type' => 'error',
                    'message' => 'subject type already exists'
                ]
            ]);
        }
        $subjectType = SubjectType::find($request->subject_type_id);
        if ($subjectType) {
            $subjectType->name = $request->subject_type_name;
            if ($subjectType->save()) {
                return $this->apiService->success([
                    'notify' => [
                        'type' => 'success',
                        'message' => 'Updated'
                    ]
                ]);
            }
        }
        return $this->apiService->success([
            'notify' => [
                'type' => 'error',
                'message' => 'Unable to save'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectType  $subjectType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        SubjectType::destroy($request->subject_type_id);
        return $this->apiService->success([
            'notify' => [
                'type' => 'success',
                'message' => 'Added'
            ]
        ]);
    }
}
