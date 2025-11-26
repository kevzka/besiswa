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
                'data' => [
                    'totalPrestasi' => $totalTbLombas,
                    'totalInternasional' => [$totalInternasional, number_format((100/$totalTbLombas)*$totalInternasional, 1)],
                    'totalNasional' => [$totalNasional, number_format((100/$totalTbLombas)*$totalNasional, 1)],
                    'totalProvinsi' => [$totalProvinsi, number_format((100/$totalTbLombas)*$totalProvinsi, 1)],
                    'totalKotaKabupaten' => [$totalKotaKabupaten, number_format((100/$totalTbLombas)*$totalKotaKabupaten, 1)],
                    'angkatan' => $totalPerAngkatan,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function portofolioDetailData($angkatan){
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
            'data' => [
                "totalPrestasi" => $totalPrestasi,
                "prestasi" => $prestasi,
                "totalJiwa" => $totalJiwa,
                "persentasePartisipan" => number_format($persentasePartisipan, 1),
                "siswa" => $siswa
                ]
            ]
        );
    }
}
