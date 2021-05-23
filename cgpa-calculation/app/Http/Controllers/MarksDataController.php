<?php

namespace App\Http\Controllers;

use App\Models\MarksData;
use Auth;
use Illuminate\Http\Request;

class MarksDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request = $request->all();
        $user = Auth::user();
        unset($request['_token']);
        $data = [];
        foreach ($request as $key => $value) {
            $data[] = ['user_id' => $user->id, 'subject_id' => $key, 'gradepoint' => $value];
        }
        if (MarksData::where('user_id', '=', $user->id)->count() == 0) {
            if (MarksData::insert($data)) {
                return 'true';
            }
        } else {
            foreach ($request as $key => $value) {
                $marks = MarksData::where('user_id', '=', $user->id)->where('subject_id', '=', $key)->update(['gradepoint' => $value]);
            }

            return 'true';
        }

        return 'false';
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
