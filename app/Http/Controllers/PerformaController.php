<?php

namespace App\Http\Controllers;

use App\Models\TbLombas;
use App\Models\TbEvidences;
use App\Models\TbSiswasLombas;
use App\Models\TbSiswas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PerformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info("Accessed the index method");
        return view('admin.tes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Log::info("Accessed the create method");
        return view('admin.tes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info("Storing new resource with data: ", $request->all());
        try {
            try {
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

                $request->validate([
                    'nama_lomba' => 'required|string|max:255',
                    'deskripsi_lomba' => 'nullable|string',
                    'tanggal_lomba' => 'required|date',
                    'tingkat_lomba' => 'required|string|max:255',
                    'tingkat_juara' => 'required|string|max:255',
                    'poin_lomba' => 'required|integer',
                ]);

                Log::info("Validation passed for request data");
            } catch (ValidationException $e) {
                Log::error("Validation failed: " . $e->getMessage());
                throw $e; // rethrow the exception to be caught by the outer catch block
            }

            // Log authenticated user info
            $user = Auth::user();
            Log::info('User authenticated', ['user_id' => $user->id_admin, 'username' => $user->username]);

            dd($this->addTbLomba($request, $this->addTbEvidences($request), $nis_array));
        } catch (\Exception $e) {
            Log::error("Error storing resource: " . $e->getMessage());
            dd($e->getMessage());
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    public function addTbEvidences(Request $request)
    {
        Log::info("Adding TbEvidences with request data: ", $request->all());
        try {
            if ($request->hasFile('file_evidence')) {
                $file = $request->file('file_evidence');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                TbEvidences::create([
                    'id_admin' => Auth::user()->id_admin,
                    'type' => 3,
                    'title' => $request->nama_lomba,
                    'file' => $filePath,
                    'description' => $request->deskripsi_lomba,
                    'date' => $request->tanggal_lomba,
                ]);
                //kembalikan id evidence yang baru dibuat
                return TbEvidences::latest()->first()->id_evidence;
            }
            Log::warning("No file uploaded in the request");
            return "no file";
        } catch (\Exception $e) {
            Log::error("Error adding TbEvidences: " . $e->getMessage());
            return "error";
        }
    }

    public function addTbLomba(Request $request, $id_evidence, $nis_siswas)
    {
        Log::info("Adding TbLomba with request data: ", $request->all());
        try {
            $tingkat_juara = $request->tingkat_juara == "lainnya" ? $request->tingkat_juara_lainnya : $request->tingkat_juara;

            TbLombas::create([
                'id_evidence' => $id_evidence,
                'tingkat_lomba' => $request->tingkat_lomba,
                'tingkat_juara' => $tingkat_juara,
                'poin_lomba' => $request->poin_lomba,
            ]);

            foreach ($nis_siswas as $nis) {
                TbSiswasLombas::create([
                    'nis_siswa' => $nis,
                    'id_lomba' => TbLombas::latest()->first()->id_lomba,
                ]);
            }

            Log::info("Successfully added TbLomba and associated TbSiswaLomba records");
            return "success add TbLomba";
        } catch (\Exception $e) {
            Log::error("Error adding TbLombas: " . $e->getMessage());
            return "error";
        }
    }
}
