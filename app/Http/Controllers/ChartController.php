<?php

namespace App\Http\Controllers;

use App\Helpers\Components\Head;
use App\Models\StadeVariete;
use App\Models\Variete;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        return view('chart');
    }

    public function filter(Request $request)
    {
        $validator = validator($request->all(), [
            'qualification' => 'required',
            'mode' => 'required|string|' . \Illuminate\Validation\Rule::in([
                    'DAY',
                    'DECADES',
                    'MONTH',
                ]),
            'dateS' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        $validated = $validator->validated();

        $data = \DB::select("call proc_ByDays(? , ? , ?)" , [(int)$validated['qualification'] ,$validated['dateS'], $validated['mode']  ]);
        return  response()->json([
            'data' => $data
        ]);

    }


}
