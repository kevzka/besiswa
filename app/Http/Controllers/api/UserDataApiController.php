<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TbEvidences;
use Illuminate\Http\Request;

class UserDataApiController extends Controller
{
    public function userData(Request $request)
    {
        try {
            validator($request->all(), [
                'function' => 'required|string',
                'type' => 'required',
            ])->validate();
            switch ($request->function) {
                case 'dataIndex':
                    return $this->dataIndex($request->type);
                    // You can add more cases here for different functions
                default:
                    return response()->json([
                        'error' => 'Invalid function',
                    ], 400);
            }
            return response()->json([
                'user' => "halo",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function dataIndex($type){
        try{
            $data = TbEvidences::where('type', $type)->orderBy('created_at', 'desc')->get();
            if ($data->isEmpty()) {
                return response()->json([
                    'message' => 'No data found',
                ], 404);
            }
            return response()->json([
                'allData' => $data,
                'topData' => $data->take(3),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function detailData($id){
        try{
            $data = TbEvidences::find($id);
            if (!$data) {
                return response()->json([
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
