<?php

namespace App\Http\Controllers\Api;

use App\Models\TbLombas;
use App\Models\TbSiswas;
use App\Models\TbEvidences;
use Illuminate\Http\Request;
use App\Models\TbSiswasLombas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

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
                    Log::warning('Invalid function requested', ['function' => $request->function, 'method' => __METHOD__]);
                    return response()->json([
                        'status' => 'error',
                        'code' => 400,
                        'message' => 'Invalid function',
                    ], 400);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed', ['errors' => $e->errors(), 'method' => __METHOD__]);
            return response()->json([
                'status' => 'error',
                'code' => 422,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Unexpected error in userData', ['exception' => $e, 'method' => __METHOD__]);
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function dataIndex($type){
        try{
            $data = TbEvidences::where('type', $type)->orderBy('created_at', 'desc')->get();
            if ($data->isEmpty()) {
                Log::info('No evidence data found for type', ['type' => $type, 'method' => __METHOD__]);
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'No data found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'allData' => $data,
                'topData' => $data->take(3),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching dataIndex', ['exception' => $e, 'type' => $type, 'method' => __METHOD__]);
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function detailData($id){
        try{
            $data = TbEvidences::find($id);
            if (!$data) {
                Log::info('Evidence detail not found', ['id' => $id, 'method' => __METHOD__]);
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching detailData', ['exception' => $e, 'id' => $id, 'method' => __METHOD__]);
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => $e->getMessage(),
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
            $totalPerAngkatan = [];
            $totalAngkatan = TbSiswas::pluck('angkatan')->unique();
            $totalAngkatan->map(function($angkatan) use (&$totalPerAngkatan){
                $totalPrestasi = TbSiswasLombas::whereHas('tb_siswa', function ($query) use ($angkatan){
                    $query->where('angkatan', $angkatan);
                })->distinct()->count('id_lomba');

                $totalJiwaPerAngkatan = TbSiswas::where('angkatan', $angkatan)->sum('poin_jiwa');
                $totalJiwa = TbSiswas::all()->sum('poin_jiwa');
                $totalPerAngkatan[$angkatan] = [
                    'angkatan' => $angkatan,
                    'totalPrestasi' => $totalPrestasi,
                    'totalJiwa' => [$totalJiwaPerAngkatan, number_format((100/$totalJiwa)*$totalJiwaPerAngkatan, 1)]
                ];
            });

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => [
                    'totalPrestasi' => $totalTbLombas,
                    'totalInternasional' => [$totalInternasional, number_format((100/$totalTbLombas)*$totalInternasional, 1)],
                    'totalNasional' => [$totalNasional, number_format((100/$totalTbLombas)*$totalNasional, 1)],
                    'totalProvinsi' => [$totalProvinsi, number_format((100/$totalTbLombas)*$totalProvinsi, 1)],
                    'totalKotaKabupaten' => [$totalKotaKabupaten, number_format((100/$totalTbLombas)*$totalKotaKabupaten, 1)],
                    'angkatan' => $totalPerAngkatan,
                ],
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching portofolioData', ['exception' => $e, 'method' => __METHOD__]);
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function portofolioDetailData($angkatan){
        try {
            if(TbSiswas::where('angkatan', $angkatan)->count() == 0){
                Log::info('No students found for angkatan', ['angkatan' => $angkatan, 'method' => __METHOD__]);
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'No data found for the specified angkatan',
                ], 404);
            }
            // gabungkan TbLombas dengan TbSiswasLombas dan TbSiswas untuk mendapatkan detail prestasi per siswa berdasarkan angkatan
            $totalPrestasi = TbSiswasLombas::whereHas('tb_siswa', function ($query) use ($angkatan){
                $query->where('angkatan', $angkatan);
            })->distinct()->count('id_lomba');
            $prestasi = [
                'internasional' => TbSiswasLombas::whereHas('tb_siswa', function ($query) use ($angkatan){
                    $query->where('angkatan', $angkatan);
                })->whereHas('tb_lomba', function ($query){
                    $query->where('tingkat_lomba', 'internasional');
                })->count(),
                'nasional' => TbSiswasLombas::whereHas('tb_siswa', function ($query) use ($angkatan){
                    $query->where('angkatan', $angkatan);
                })->whereHas('tb_lomba', function ($query){
                    $query->where('tingkat_lomba', 'nasional');
                })->count(),
                'provinsi' => TbSiswasLombas::whereHas('tb_siswa', function ($query) use ($angkatan){
                    $query->where('angkatan', $angkatan);
                })->whereHas('tb_lomba', function ($query){
                    $query->where('tingkat_lomba', 'provinsi');
                })->count(),
                'kotaKabupaten' => TbSiswasLombas::whereHas('tb_siswa', function ($query) use ($angkatan){
                    $query->where('angkatan', $angkatan);
                })->whereHas('tb_lomba', function ($query){
                    $query->where('tingkat_lomba', 'kota');
                })->count(),
            ];
            $totalJiwa = TbSiswas::where('angkatan', $angkatan)->sum('poin_jiwa');
            $totalJiwaTbSiswaLomba = TbSiswasLombas::whereHas('tb_siswa', function ($query) use ($angkatan){
                $query->where('angkatan', $angkatan);
            })->with('tb_lomba')->get()->map(function($item){
                return $item->tb_lomba->poin_lomba;
            })->sum();
            $totalJiwa = ($totalJiwa + $totalJiwaTbSiswaLomba);
            $persentasePartisipan = ((100 / TbSiswas::where('angkatan', $angkatan)->count())*TbSiswasLombas::whereHas('tb_siswa', function ($query) use ($angkatan){
                $query->where('angkatan', $angkatan);
            })->distinct()->count('nis_siswa'));
            $siswa = [];
            TbSiswas::where('angkatan', $angkatan)->get()->map(function($query) use (&$siswa){
                $prestasiSiswa = [
                    'total' => TbSiswasLombas::where('nis_siswa', $query->nis)->count(),
                    'internasional' => TbSiswasLombas::where('nis_siswa', $query->nis)->whereHas('tb_lomba', function ($q){
                        $q->where('tingkat_lomba', 'internasional');
                    })->count(),
                    'nasional' => TbSiswasLombas::where('nis_siswa', $query->nis)->whereHas('tb_lomba', function ($q){
                        $q->where('tingkat_lomba', 'nasional');
                    })->count(),
                    'provinsi' => TbSiswasLombas::where('nis_siswa', $query->nis)->whereHas('tb_lomba', function ($q){
                        $q->where('tingkat_lomba', 'provinsi');
                    })->count(),
                    'kotaKabupaten' => TbSiswasLombas::where('nis_siswa', $query->nis)->whereHas('tb_lomba', function ($q){
                        $q->where('tingkat_lomba', 'kota');
                    })->count(),
                ];
                $siswa[] = [
                    'nama' => $query->nama,
                    'prestasi' => $prestasiSiswa,
                ];
            });

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => [
                    "totalPrestasi" => $totalPrestasi,
                    "prestasi" => $prestasi,
                    "totalJiwa" => $totalJiwa,
                    "persentasePartisipan" => number_format($persentasePartisipan, 1),
                    "siswa" => $siswa
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching portofolioDetailData', ['exception' => $e, 'angkatan' => $angkatan, 'method' => __METHOD__]);
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
