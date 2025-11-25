<?php

namespace App\Http\Controllers\Api;

use App\Models\TbLombas;
use App\Models\TbSiswas;
use App\Models\TbEvidences;
use Illuminate\Http\Request;
use App\Models\TbSiswasLombas;
use App\Http\Controllers\Controller;

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

    public function portofolioData(){
        try{
            $totalTbLombas = TbLombas::count();
            $totalInternasional = TbLombas::where('tingkat_lomba', 'internasional')->count();
            $totalNasional = TbLombas::where('tingkat_lomba', 'nasional')->count();
            $totalProvinsi = TbLombas::where('tingkat_lomba', 'provinsi')->count();
            $totalKotaKabupaten = TbLombas::where('tingkat_lomba', 'kota')->count();
            $totanPerAngkatan = [];
            $totalAngkatan = TbSiswas::pluck('angkatan')->unique();
            $totalAngkatan->map(function($angkatan) use (&$totanPerAngkatan){
                $totalPrestasi = TbSiswasLombas::whereHas('tb_siswa', function ($query) use ($angkatan){
                    $query->where('angkatan', $angkatan);
                })->count();

                $totalJiwaPerAngkatan = TbSiswas::where('angkatan', $angkatan)->sum('poin_jiwa');
                $totalJiwa = TbSiswas::all()->sum('poin_jiwa');
                $totanPerAngkatan[$angkatan] = [
                    'totalPrestasi' => $totalPrestasi,
                    'totalJiwa' => [$totalJiwaPerAngkatan, (100/$totalJiwa)*$totalJiwaPerAngkatan]
                ];
            });

            return response()->json([
                'data' => [
                    'totalPrestasi' => $totalTbLombas,
                    'totalInternasional' => [$totalInternasional, (100/$totalTbLombas)*$totalInternasional],
                    'totalNasional' => [$totalNasional, (100/$totalTbLombas)*$totalNasional],
                    'totalProvinsi' => [$totalProvinsi, (100/$totalTbLombas)*$totalProvinsi],
                    'totalKotaKabupaten' => [$totalKotaKabupaten, (100/$totalTbLombas)*$totalKotaKabupaten],
                    'angkatan' => $totanPerAngkatan,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
