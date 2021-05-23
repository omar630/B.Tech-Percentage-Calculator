<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;

class BranchController extends Controller
{
    public function __construct(ApiResponseService $apiServiceResponse)
    {
        $this->apiService = $apiServiceResponse;
    }
    public function getAllBranch(Request $request)
    {
        $branches = Branche::withCount('user')->get();
        return view('admin.branch')->with('branches', $branches);
    }

    public function updateBranch(Request $request)
    {
        $existingBranch = Branche::where('branch', $request->branch_name)->first();
        if ($existingBranch && $existingBranch->id != $request->branch_id) {
            return $this->apiService->error([
                'notify' => [
                    'type' => 'error',
                    'message' => 'Branch already exists'
                ]
            ]);
        }
        $id = $request->branch_id;
        $branch = Branche::find($id);
        if ($branch) {
            $branch->branch = $request->branch_name;
            $branch->save();
            return
                $this->apiService->success([
                    'notify' => [
                        'type' => 'success',
                        'message' => 'Updated'
                    ]
                ]);
        }
        return $this->apiService->success([
            'notify' => [
                'type' => 'error',
                'message' => 'Branch not found',
            ],
        ]);
    }

    public function deleteBranch(Request $request)
    {
        Branche::destroy($request->branch_id);
        return
            $this->apiService->success([
                'notify' => [
                    'type' => 'success',
                    'message' => 'Deleted'
                ]
            ]);
    }

    public function addBranch(Request $request)
    {
        $existingBranch = Branche::where('branch', $request->branch_name)->first();
        if ($existingBranch && $existingBranch->id) {
            return $this->apiService->error([
                'notify' => [
                    'type' => 'error',
                    'message' => 'Branch already exists'
                ]
            ]);
        }
        $branch = Branche::create([
            'branch' => $request->branch_name,
        ]);
        if ($branch) {
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
}
