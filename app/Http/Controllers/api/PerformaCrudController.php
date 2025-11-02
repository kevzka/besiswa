<?php

namespace App\Http\Controllers\Api;

use App\Models\TbLombas;
use App\Models\TbSiswas;
use App\Models\TbEvidences;
use Illuminate\Http\Request;
use App\Models\TbSiswasLombas;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PerformaCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $tbLombas = TbLombas::with(['id_evidence'])->get();
        return response()->json(['data' => $tbLombas], 200);

        // return response()->json(['data' => [
        //     "nisSiswa" => [543241009, 543241010],
        //     "namaLomba" => "lomba",
        //     "fileDokumentasi" => "Merah dan Biru Ilustrasi Katakan Tidak Pada Narkoba Poster.png",
        //     "deskripsiLomba" => "lomba",
        //     "tanggalLomba" => "10/10/1000",
        //     "tingkatLomba" => "Nasional",
        //     "tingkatJuara" => 3,
        //     "poinLomba" => 10000

        // ]], 200);
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
                    'id_admin' => 'required|integer',
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
            // $user = $request->user();
            Log::info('User authenticated', ['user_id' => $request->id_admin, 'username' => $request->username]);

            return response()->json($this->addTbLomba($request, $this->addTbEvidences($request), $nis_array));
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
        //buatkan log satu function ini
        Log::info("Deleting resource with id: " . $id);
        try {
            Log::info("Fetching related records for deletion");

            try{
                $idLomba = TbSiswasLombas::where('id_lomba', $id)->get();
                $idEvidence = TbLombas::where('id_lomba', $idLomba[0]->id_lomba)->first();
                $dataEvidence = TbEvidences::where('id_evidence', $idEvidence->id_evidence)->first();
            }catch(\Exception $e){
                Log::error("Error fetching TbSiswasLombas (kemungkinan id tidak ada): " . $e->getMessage());
                return response()->json(['error' => 'Resource not found'], 404);
            }
            
            Log::info("Deleting related TbSiswasLombas records");
            foreach ($idLomba as $lomba) {
                Log::info("Deleting TbSiswasLombas record: " . $lomba->id_siswa_lomba);
                $lomba->delete();
            }
            $idEvidence->delete();
            $dataEvidence->delete();
            
            if ($dataEvidence->file && Storage::disk('public')->exists($dataEvidence->file)) {
                Log::info('Deleting associated file', [
                    'file_path' => $dataEvidence->file
                ]);

                Storage::disk('public')->delete($dataEvidence->file);
                Log::info('File deleted successfully');
            }

            Log::info("Resource and related records deleted successfully");
            return response()->json(['message' => 'Resource deleted successfully'], 200);

        } catch (\Exception $e) {
            Log::error("Error deleting resource: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addTbEvidences(Request $request)
    {
        Log::info("Adding TbEvidences with request data: ", $request->all());
        try {
            if ($request->hasFile('file_evidence')) {
                Log::info("File uploaded: " . $request->file('file_evidence')->getClientOriginalName());
                $file = $request->file('file_evidence');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                TbEvidences::create([
                    'id_admin' => $request->id_admin,
                    'username' => $request->username,
                    'type' => 2,
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
