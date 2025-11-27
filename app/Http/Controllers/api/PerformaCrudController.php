<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
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
use Illuminate\Support\Facades\DB;

class PerformaCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info("Fetching all TbLombas with related evidences and siswa lombas");
        try {
            Log::info("Fetching all TbLombas with related evidences and siswa lombas");
            $tbLombas = TbLombas::with(['tb_evidences', 'tb_siswas_lombas'])->get($columns = ['*']);
            $data_terformat = [];

            Log::info("Formatting fetched data");
            foreach ($tbLombas as $lomba) {
                $nis_siswa_array = [];

                foreach ($lomba->tb_siswas_lombas as $siswa_lomba) {
                    $nis_siswa_array[] = (int)$siswa_lomba->nis_siswa;
                }

                $evidence = $lomba->tb_evidences;

                if ($evidence) {
                    $nama_file = basename($evidence->file);
                    $tanggal_lomba_format = Carbon::parse($evidence->date)->format('Y-m-d');

                    $data_lomba = [
                        "idLomba" => (int)$lomba->id_lomba,
                        "nisSiswa" => $nis_siswa_array,
                        "namaLomba" => $evidence->title,
                        "fileDokumentasi" => $nama_file,
                        "deskripsiLomba" => $evidence->description,
                        "tanggalLomba" => $tanggal_lomba_format,
                        "tingkatLomba" => $lomba->tingkat_lomba,
                        "tingkatJuara" => $lomba->tingkat_juara,
                        "poinLomba" => (int)$lomba->poin_lomba,
                        "idAdmin" => (int)$evidence->id_admin,
                    ];

                    $data_terformat[] = $data_lomba;
                }
            }
            Log::info("Data formatting complete, returning response");

            return response()->json(['data' => $data_terformat], 200);
        } catch (\Exception $e) {
            Log::error("Error fetching TbLombas: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
                    'username' => 'required|string|max:255',
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
        Log::info("Fetching all TbLombas with related evidences and siswa lombas");
        try {
            Log::info("Fetching all TbLombas with related evidences and siswa lombas");
            $tbLombas = TbLombas::where('id_lomba', $id)->with(['tb_evidences', 'tb_siswas_lombas'])->get($columns = ['*']);
            // return response()->json(['data' => $tbLombas], 200);


            $data_terformat = [];

            if ($tbLombas->isEmpty()) {
                Log::warning("No TbLombas found with id: " . $id);
                return response()->json(['error' => 'Resource not found'], 404);
            }

            Log::info("Formatting fetched data");
            foreach ($tbLombas as $lomba) {
                $nis_siswa_array = [];

                foreach ($lomba->tb_siswas_lombas as $siswa_lomba) {
                    $nis_siswa_array[] = (int)$siswa_lomba->nis_siswa;
                }

                $evidence = $lomba->tb_evidences;

                if ($evidence) {
                    $nama_file = basename($evidence->file);
                    $tanggal_lomba_format = Carbon::parse($evidence->date)->format('Y-m-d');

                    $data_lomba = [
                        "idLomba" => (int)$lomba->id_lomba,
                        "nisSiswa" => implode(", ", $nis_siswa_array),
                        "namaLomba" => $evidence->title,
                        "fileDokumentasi" => $nama_file,
                        "deskripsiLomba" => $evidence->description,
                        "tanggalLomba" => $tanggal_lomba_format,
                        "tingkatLomba" => $lomba->tingkat_lomba,
                        "tingkatJuara" => $lomba->tingkat_juara,
                        "poinLomba" => (int)$lomba->poin_lomba,
                    ];

                    $data_terformat[] = $data_lomba;
                }
            }
            Log::info("Data formatting complete, returning response");

            return response()->json(['data' => $data_terformat], 200);
        } catch (\Exception $e) {
            Log::error("Error fetching TbLombas: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info('API update called', [
            'id_lomba' => $id,
            'remote_addr' => $request->ip(),
            'method' => $request->method(),
            'content_type' => $request->header('content-type'),
            'request_keys' => array_keys($request->all())
        ]);

        try {
            Log::info('Starting update process', ['id_lomba' => $id]);

            // cek keberadaan parent record
            $dataTbLombas = TbLombas::where('id_lomba', $id)->first();
            if (!$dataTbLombas) {
                Log::warning('TbLombas not found for update', ['id_lomba' => $id]);
                return response()->json(['success' => false, 'message' => 'Lomba not found'], 404);
            }

            Log::info('Loaded existing TbLombas', [
                'id_lomba' => $dataTbLombas->id_lomba,
                'id_evidence' => $dataTbLombas->id_evidence,
                'current_tingkat_lomba' => $dataTbLombas->tingkat_lomba,
                'current_tingkat_juara' => $dataTbLombas->tingkat_juara,
                'current_poin_lomba' => $dataTbLombas->poin_lomba,
            ]);

            // normalisasi NIS input menjadi array
            $nisInput = (string) $request->input('nis', '');
            $nis_array = array_values(array_filter(array_map(function ($nis) {
                return trim(str_replace(',', '', $nis));
            }, preg_split('/[\s,]+/', $nisInput)), fn($v) => $v !== ''));

            Log::info('Normalized NIS input', ['nis_input_raw' => $nisInput, 'nis_array' => $nis_array]);

            // cek setiap NIS ada di tabel siswa
            foreach ($nis_array as $nis) {
                if (!TbSiswas::where('nis', $nis)->exists()) {
                    Log::warning('NIS validation failed', ['missing_nis' => $nis]);
                    return response()->json(['success' => false, 'message' => "NIS not found: {$nis}"], 422);
                }
            }

            Log::info('Validation of NIS completed', ['nis_array' => $nis_array]);

            // log payload preview (tanpa mengeluarkan teks panjang)
            $payloadPreview = $request->only([
                'nama_lomba','deskripsi_lomba','tanggal_lomba','tingkat_lomba','tingkat_juara','poin_lomba','nis'
            ]);
            Log::info('Request payload preview', ['payload' => $payloadPreview]);

            Log::info('Validating request data (laravel validator) start', ['id_lomba' => $id]);
            // validasi request
            $request->validate([
                'nama_lomba' => 'required|string|max:255',
                'deskripsi_lomba' => 'nullable|string',
                'tanggal_lomba' => 'required|date',
                'tingkat_lomba' => 'required|string|max:255',
                'tingkat_juara' => 'required|string|max:255',
                'poin_lomba' => 'required|integer',
            ]);
            Log::info('Validation passed', ['id_lomba' => $id]);

            // panggil update helper dan normalisasi respons
            Log::info('Calling updateTbEvidences', ['id_evidence' => $dataTbLombas->id_evidence]);
            $respEvidence = $this->updateTbEvidences($request, $dataTbLombas->id_evidence);
            $dataEvidence = $respEvidence instanceof \Illuminate\Http\JsonResponse
                ? $respEvidence->getData(true)
                : (is_array($respEvidence) ? $respEvidence : ['success' => true]);

            Log::info('updateTbEvidences result', ['result' => $dataEvidence]);

            if (isset($dataEvidence['success']) && $dataEvidence['success'] === false) {
                Log::error('updateTbEvidences returned failure', ['detail' => $dataEvidence]);
                return response()->json(['success' => false, 'message' => 'Failed to update evidence', 'detail' => $dataEvidence], 500);
            }

            Log::info('Calling updateTbLombas', ['id_lomba' => $id]);
            $respLomba = $this->updateTbLombas($request, $id);
            $dataLomba = $respLomba instanceof \Illuminate\Http\JsonResponse
                ? $respLomba->getData(true)
                : (is_array($respLomba) ? $respLomba : ['success' => true]);

            Log::info('updateTbLombas result', ['result' => $dataLomba]);

            if (isset($dataLomba['success']) && $dataLomba['success'] === false) {
                Log::error('updateTbLombas returned failure', ['detail' => $dataLomba]);
                return response()->json(['success' => false, 'message' => 'Failed to update lomba', 'detail' => $dataLomba], 500);
            }

            Log::info('Calling updateTbSiswasLombas', ['id_lomba' => $id, 'nis_count' => count($nis_array)]);
            $respSiswas = $this->updateTbSiswasLombas($request, $id, $nis_array);
            $dataSiswas = $respSiswas instanceof \Illuminate\Http\JsonResponse
                ? $respSiswas->getData(true)
                : (is_array($respSiswas) ? $respSiswas : ['success' => true]);

            Log::info('updateTbSiswasLombas result', ['result' => $dataSiswas]);

            if (isset($dataSiswas['success']) && $dataSiswas['success'] === false) {
                Log::error('updateTbSiswasLombas returned failure', ['detail' => $dataSiswas]);
                return response()->json(['success' => false, 'message' => 'Failed to update siswa-lomba associations', 'detail' => $dataSiswas], 500);
            }

            Log::info('All update helpers completed successfully', [
                'id_lomba' => $id,
                'evidence' => isset($dataEvidence['data']) ? $dataEvidence['data'] : $dataEvidence,
                'lomba' => isset($dataLomba['data']) ? $dataLomba['data'] : $dataLomba,
                'siswas' => isset($dataSiswas['data']) ? $dataSiswas['data'] : $dataSiswas,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Update completed',
                'data' => [
                    'evidence' => $dataEvidence,
                    'lomba' => $dataLomba,
                    'siswas' => $dataSiswas,
                ]
            ], 200);
        } catch (ValidationException $e) {
            Log::warning('ValidationException in update', ['id_lomba' => $id, 'errors' => $e->errors()]);
            return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Unexpected error in update', [
                'id_lomba' => $id,
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => substr($e->getTraceAsString(), 0, 1000)
            ]);
            return response()->json(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Log::info('Destroy called', ['id_lomba' => $id]);

        DB::beginTransaction();
        try {
            Log::info('Looking up parent record tb_lombas', ['id_lomba' => $id]);
            $lomba = TbLombas::find($id);

            if (!$lomba) {
                Log::warning('TbLombas not found', ['id_lomba' => $id]);
                DB::rollBack(); 
                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found',
                ], 404);
            }

            Log::info('Fetching related child records tb_siswas_lombas', ['id_lomba' => $id]);
            $childrenQuery = TbSiswasLombas::where('id_lomba', $id);
            $childrenCount = $childrenQuery->count();

            if ($childrenCount > 0) {
                Log::info('Deleting child records', ['count' => $childrenCount, 'id_lomba' => $id]);
                $childrenQuery->delete();
            } else {
                Log::info('No child records to delete', ['id_lomba' => $id]);
            }

            Log::info('Fetching related evidence record', ['id_evidence' => $lomba->id_evidence]);
            $evidence = TbEvidences::find($lomba->id_evidence);

            Log::info('Deleting parent tb_lombas record', ['id_lomba' => $lomba->id_lomba]);
            $lomba->delete();

            if ($evidence) {
                Log::info('Found associated evidence', ['id_evidence' => $evidence->id_evidence, 'file' => $evidence->file]);

                if ($evidence->file && Storage::disk('public')->exists($evidence->file)) {
                    Log::info('Deleting associated file from storage', ['file_path' => $evidence->file]);
                    Storage::disk('public')->delete($evidence->file);
                    Log::info('File deleted from storage', ['file_path' => $evidence->file]);
                } else {
                    Log::info('No file found on storage or file path empty', ['file_path' => $evidence->file ?? null]);
                }

                Log::info('Deleting evidence record', ['id_evidence' => $evidence->id_evidence]);
                $evidence->delete();
            } else {
                Log::info('No associated evidence record found', ['id_evidence' => $lomba->id_evidence]);
            }

            DB::commit();

            Log::info('Delete operation completed successfully', ['id_lomba' => $id]);
            return response()->json([
                'success' => true,
                'message' => 'Resource and related records deleted successfully',
                'data' => [
                    'id_lomba' => (int)$id,
                    'deleted_children' => $childrenCount,
                    'deleted_evidence_id' => $evidence ? (int)$evidence->id_evidence : null,
                ],
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting resource', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'id_lomba' => $id,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete resource',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function addTbEvidences(Request $request)
    {
        Log::info("Adding TbEvidences with request data: ", $request->all());
        try {
            if ($request->hasFile('file_evidence')) {
                Log::info("File uploaded: " . $request->file('file_evidence')->getClientOriginalName());
                $file = $request->file('file_evidence');
                // $fileName = time() . '_' . $file->getClientOriginalName();
                $sanitizedTitle = str_replace(' ', '_', $request->nama_lomba);

                // Create unique filename with timestamp
                $finalFileName = time() . '_' . $sanitizedTitle . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('kegiatan', $finalFileName, 'public');

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

    public function updateTbEvidences(Request $request, $id_evidence)
    {
        Log::info('updateTbEvidences called', [
            'id_evidence' => $id_evidence,
            'incoming_title' => $request->input('title') ?? $request->input('nama_lomba') ?? null
        ]);

        try {
            Log::info('Looking up evidence record', ['id_evidence' => $id_evidence]);
            $evidence = TbEvidences::findOrFail($id_evidence);

            Log::info('Current evidence data', [
                'id_evidence' => $evidence->id_evidence,
                'title_current' => $evidence->title,
                'file_current' => $evidence->file
            ]);

            $newFilePath = $evidence->file;

            if ($request->hasFile('file') || $request->hasFile('file_evidence')) {
                // support both keys for safety
                $fileKey = $request->hasFile('file') ? 'file' : 'file_evidence';
                $uploadedFile = $request->file($fileKey);

                Log::info('New file uploaded, preparing to replace', [
                    'id_evidence' => $id_evidence,
                    'uploaded_name' => $uploadedFile->getClientOriginalName()
                ]);

                // delete old file if exists
                if ($evidence->file && Storage::disk('public')->exists($evidence->file)) {
                    Log::info('Deleting old evidence file from storage', ['file_path' => $evidence->file]);
                    Storage::disk('public')->delete($evidence->file);
                } else {
                    Log::info('Old file not found in storage, skipping delete', ['file_path' => $evidence->file]);
                }

                // create sanitized filename
                $titleForFilename = $request->input('title') ?? $evidence->title ?? 'evidence';
                $sanitizedTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', trim($titleForFilename));
                $finalFileName = time() . '_' . $sanitizedTitle . '.' . $uploadedFile->getClientOriginalExtension();

                Log::info('Storing new file to public disk', ['filename' => $finalFileName]);
                $newFilePath = $uploadedFile->storeAs('kegiatan', $finalFileName, 'public');

                if (!$newFilePath) {
                    Log::error('Failed to store new file', ['id_evidence' => $id_evidence]);
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload new file'
                    ], 500);
                }

                Log::info('New file stored', ['stored_path' => $newFilePath]);
            }

            Log::info('Updating evidence record in database', ['id_evidence' => $id_evidence]);
            $evidence->update([
                'title' => $request->input('title') ?? $request->input('nama_lomba') ?? $evidence->title,
                'description' => $request->input('description') ?? $request->input('deskripsi_lomba') ?? $evidence->description,
                'file' => $newFilePath,
                'date' => $request->input('date') ?? $request->input('tanggal_lomba') ?? $evidence->date,
                'updated_at' => Carbon::now(),
            ]);

            Log::info('Evidence updated successfully', [
                'id_evidence' => $evidence->id_evidence,
                'new_title' => $evidence->title,
                'new_file' => $evidence->file
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Evidence updated successfully',
                'data' => [
                    'id_evidence' => (int)$evidence->id_evidence,
                    'title' => $evidence->title,
                    'file' => $evidence->file,
                    'date' => $evidence->date,
                ],
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed while updating evidence', [
                'id_evidence' => $id_evidence,
                'errors' => $e->errors()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Evidence not found for update', ['id_evidence' => $id_evidence]);

            return response()->json([
                'success' => false,
                'message' => 'Evidence not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Unexpected error while updating evidence', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'id_evidence' => $id_evidence
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update evidence',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateTbLombas(Request $request, $id_lombas)
    {
        Log::info('updateTbLombas called', [
            'id_lombas' => $id_lombas,
            'payload' => $request->only(['tingkat_lomba','tingkat_juara','tingkat_juara_lainnya','poin_lomba'])
        ]);

        try {
            $lomba = TbLombas::where('id_lomba', $id_lombas)->first();
            if (!$lomba) {
                Log::warning('TbLombas not found for update', ['id_lombas' => $id_lombas]);
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found',
                    'data' => null
                ], 404);
            }

            $tingkatJuara = $request->input('tingkat_juara') === 'lainnya'
                ? $request->input('tingkat_juara_lainnya')
                : $request->input('tingkat_juara');

            $updateData = [
                'tingkat_lomba' => $request->input('tingkat_lomba'),
                'tingkat_juara' => $tingkatJuara,
                'poin_lomba' => $request->input('poin_lomba'),
                'updated_at' => Carbon::now(),
            ];

            Log::info('Updating TbLombas', ['id_lombas' => $id_lombas, 'update' => $updateData]);
            $lomba->update($updateData);

            Log::info('TbLombas updated successfully', ['id_lombas' => $id_lombas]);
            return response()->json([
                'success' => true,
                'message' => 'Lomba updated successfully',
                'data' => [
                    'id_lomba' => (int)$lomba->id_lomba,
                    'tingkat_lomba' => $lomba->tingkat_lomba,
                    'tingkat_juara' => $lomba->tingkat_juara,
                    'poin_lomba' => (int)$lomba->poin_lomba,
                    'updated_at' => $lomba->updated_at,
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating TbLombas', [
                'id_lombas' => $id_lombas,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update Lomba',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateTbSiswasLombas(Request $request, $id_lomba, $nis_siswas)
    {
        Log::info('updateTbSiswasLombas called', [
            'id_lomba' => $id_lomba,
            'nis_siswas_raw' => $nis_siswas,
            'request_keys' => array_keys($request->all())
        ]);

        try {
            // ambil semua association yang ada
            $existing = TbSiswasLombas::where('id_lomba', $id_lomba)->get();
            $deletedCount = $existing->count();
            Log::info('Existing TbSiswasLombas fetched', ['id_lomba' => $id_lomba, 'count' => $deletedCount]);

            // hapus yang lama
            foreach ($existing as $item) {
                Log::info('Deleting TbSiswasLombas record', [
                    'id_siswa_lomba' => $item->id_siswa_lomba,
                    'nis_siswa' => $item->nis_siswa
                ]);
                $item->delete();
            }

            // normalisasi input nis_siswas jadi array jika perlu
            if (!is_array($nis_siswas)) {
                $nisArray = preg_split('/[\s,]+/', trim((string) $nis_siswas));
            } else {
                $nisArray = $nis_siswas;
            }
            $nisArray = array_values(array_filter($nisArray, fn($v) => $v !== '' && $v !== null));

            // buat association baru
            $created = [];
            foreach ($nisArray as $nis) {
                $record = TbSiswasLombas::create([
                    'nis_siswa' => $nis,
                    'id_lomba' => $id_lomba,
                ]);
                $created[] = [
                    'id_siswa_lomba' => $record->id_siswa_lomba ?? null,
                    'nis_siswa' => $record->nis_siswa,
                ];
                Log::info('Created TbSiswasLombas record', [
                    'id_siswa_lomba' => $record->id_siswa_lomba ?? null,
                    'nis_siswa' => $record->nis_siswa
                ]);
            }

            Log::info('updateTbSiswasLombas completed', [
                'id_lomba' => $id_lomba,
                'deleted_count' => $deletedCount,
                'created_count' => count($created)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Siswa-lomba associations updated',
                'data' => [
                    'id_lomba' => (int) $id_lomba,
                    'deleted_count' => $deletedCount,
                    'created_count' => count($created),
                    'created' => $created
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in updateTbSiswasLombas', [
                'id_lomba' => $id_lomba,
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update siswa-lomba associations',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
