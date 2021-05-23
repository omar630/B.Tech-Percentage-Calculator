<?php

namespace App\Http\Controllers;

use App\Models\Regulation;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;

class RegulationController extends Controller
{

    public function __construct(ApiResponseService $apiResponseService)
    {
        $this->apiService  = $apiResponseService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllRegulations()
    {
        $regulations = Regulation::withCount('user')->get();
        return view('admin.regulation')->with('regulations', $regulations);
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regulation = new Regulation();
        $regulation->regulation = $request->input('regulation');
        if ($regulation->save()) {
            return
                $this->apiService->success([
                    'notify' => [
                        'type' => 'success',
                        'message' => 'Added'
                    ]
                ]);
        } else {
            return $this->apiService->error([
                'notify' => [
                    'type' => 'error',
                    'message' => 'problem saving regulation',
                ],
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRegulation(Request $request)
    {
        $id = $request->input('regulation_id');
        $regulation = Regulation::find($id);
        if ($regulation) {
            $existingRegulation = Regulation::where('regulation', $request->regulation_name)->first();
            if ($existingRegulation) {
                return
                    $this->apiService->error([
                        'notify' => [
                            'type' => 'error',
                            'message' => 'Regulation with name already exists',
                        ]
                    ]);
            }
            $regulation->regulation = $request->regulation_name;
            $regulation->save();
            $response = [
                'notify' => [
                    'type' => 'success',
                    'message' => 'Saved'
                ]
            ];
            return $this->apiService->success($response);
        }
        return $this->apiService->error([
            'notify' => [
                'type' => 'error',
                'message' => 'Regulation not found',
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteRegulation(Request $request)
    {
        Regulation::destroy($request->regulation_id);
        return
            $this->apiService->success([
                'notify' => [
                    'type' => 'success',
                    'message' => 'Deleted'
                ]
            ]);
    }
}
