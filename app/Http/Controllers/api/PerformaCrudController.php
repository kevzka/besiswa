<?php

namespace App\Http\Controllers\Api;

use App\Models\TbLomba;
use App\Models\TbSiswas;
use App\Models\TbEvidence;
use App\Models\TbSiswaLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PerformaCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Log::info("Storing new resource with data: ", $request->all());
        try {
            try {
                $request->validate([
                    'nis' => 'required|string',
                    'nama_lomba' => 'required|string|max:255',
                    'deskripsi_lomba' => 'nullable|string',
                    'tanggal_lomba' => 'required|date',
                    'tingkat_lomba' => 'required|string|max:255',
                    'tingkat_juara' => 'required|string|max:255',
                    'poin_lomba' => 'required|integer',
                ]);

                $nis_array = explode(" ", $request->nis);
                $nis_array = array_map(function ($nis) {
                    return str_replace(",", "", $nis);
                }, $nis_array);

                foreach ($nis_array as $nis) {
                    $siswa = TbSiswas::where('nis', $nis)->first();
                    if (!$siswa) {
                        Log::warning("NIS not found: " . $nis);
                        throw ValidationException::withMessages(["nis" => "NIS " . $nis . " not found."]);
                    }
                }


                Log::info("Validation passed for request data");
            } catch (ValidationException $e) {
                Log::error("Validation failed: " . $e->getMessage());
                throw $e; // rethrow the exception to be caught by the outer catch block
            }

            // Log authenticated user info
            Log::info('start user athenticatation');
            $user = Auth::user();
            Log::info('User authenticated', ['user_id' => $user->id, 'username' => $user->username]);

            dd($this->addTbLomba($request, $this->addTbEvidence($request), $nis_array));
        } catch (\Exception $e) {
            Log::error("Error storing resource: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     public function addTbEvidence(Request $request)
    {
        Log::info("Adding TbEvidence with request data: ", $request->all());
        try {
            if ($request->hasFile('file_evidence')) {
                $file = $request->file('file_evidence');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                TbEvidence::create([
                    'id_admin' => Auth::user()->id,
                    'type' => 3,
                    'title' => $request->nama_lomba,
                    'file' => $filePath,
                    'description' => $request->deskripsi_lomba,
                    'date' => $request->tanggal_lomba,
                ]);
                //kembalikan id evidence yang baru dibuat
                return TbEvidence::latest()->first()->id;
            }
            Log::warning("No file uploaded in the request");
            return "no file";
        } catch (\Exception $e) {
            Log::error("Error adding TbEvidence: " . $e->getMessage());
            return "error";
        }
    }

    public function addTbLomba(Request $request, $id_evidence, $nis_siswas)
    {
        Log::info("Adding TbLomba with request data: ", $request->all());
        try {
            $tingkat_juara = $request->tingkat_juara == "lainnya" ? $request->tingkat_juara_lainnya : $request->tingkat_juara;

            TbLomba::create([
                'id_evidence' => $id_evidence,
                'tingkat_lomba' => $request->tingkat_lomba,
                'tingkat_juara' => $tingkat_juara,
                'poin_lomba' => $request->poin_lomba,
            ]);

            foreach ($nis_siswas as $nis) {
                TbSiswaLomba::create([
                    'nis_siswa' => $nis,
                    'id_lomba' => TbLomba::latest()->first()->id_lomba,
                ]);
            }

            Log::info("Successfully added TbLomba and associated TbSiswaLomba records");
            return "success add TbLomba";
        } catch (\Exception $e) {
            Log::error("Error adding TbLomba: " . $e->getMessage());
            return "error";
        }
    }
}
