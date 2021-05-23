<?php

namespace App\Services;

use Illuminate\Http\Response;

class ApiResponseService
{
    public function response($response)
    {
        return response()->json($response);
    }

    public function success($response)
    {
        return response()->json(['error' => false, 'message' => $response]);
    }

    public function error($response)
    {
        return response()->json(['error' => true, 'message' => $response])->setStatusCode(401);
    }

    public function responseWithStatus($status = '', $message = '', $data = '')
    {
        return response()->json([
            'error'  => false,
            'status' => $status,
            'message' => $message,
            'data'   => $data
        ]);
    }
}
