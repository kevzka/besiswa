<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TbEvidences;
use Illuminate\Http\Request;

class UserDataApiController extends Controller
{
    public function userData(Request $request)
    {
        switch($request->function){
            case 'bimbingan':
                return $this->bimbinganIndex();
            // You can add more cases here for different functions
            default:
                return response()->json([
                    'error' => 'Invalid function',
                ], 400);
        }
        return response()->json([
            'user' => "halo",
        ]);
    }

    public function bimbinganIndex(){
        $data = TbEvidences::where('type', 1)->orderBy('created_at', 'desc')->get();
        if($data->isEmpty()) {
            return response()->json([
                'message' => 'No data found',
            ], 404);
        }
        return response()->json([
            'allData' => $data,
            'topData' => $data->take(3),
        ]);
    }
}
