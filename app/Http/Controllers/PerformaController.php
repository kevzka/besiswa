<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class PerformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get("http://" . Config::get('app.API') . "/api/performa");
        $datas = $response->json()['data'];
        return view('admin.portofolio.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portofolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            // dd($request->all());
            $uploadedFile = $request->file('file_evidence');
            $tingkat_juara = $request->tingkat_juara == "lainnya" ? $request->tingkat_juara_lainnya : $request->tingkat_juara;
            
            $response = Http::attach('file_evidence', file_get_contents($uploadedFile), 'image.jpg')
                    ->post("http://" . Config::get('app.API') . "/api/performa", [
                'username' => $user->username,
                'id_admin' => $user->id_admin,
                'nis' => $request->nis,
                'nama_lomba' => $request->nama_lomba,
                'deskripsi_lomba' => $request->deskripsi_lomba,
                'tanggal_lomba' => $request->tanggal_lomba,
                'tingkat_lomba' => $request->tingkat_lomba,
                'tingkat_juara' => $tingkat_juara,
                'poin_lomba' => $request->poin_lomba,
            ]);
            
            dd($response->json());
            // return redirect()->route('tes.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("http://" . Config::get('app.API') . "/api/performa/" . $id);
        if (isset($response->json()['error'])) {
            return redirect()->route('tes.index')->with('error', 'Data tidak ditemukan');
        }
        $data = $response->json()['data'][0];

        return view('admin.portofolio.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = Http::get("http://" . Config::get('app.API') . "/api/performa/" . $id);
        if (isset($response->json()['error'])) {
            return redirect()->route('tes.index')->with('error', 'Data tidak ditemukan');
        }
        $data = $response->json()['data'][0];

        return view('admin.portofolio.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = Auth::user();
            $uploadedFile = $request->file('file_evidence');
            $tingkat_juara = $request->tingkat_juara == "lainnya" ? $request->tingkat_juara_lainnya : $request->tingkat_juara;

            $url = "http://" . Config::get('app.API') . "/api/performa/" . $id;

            $payload = [
                'username' => $user->username,
                'id_admin' => $user->id_admin,
                'nis' => $request->nis,
                'nama_lomba' => $request->nama_lomba,
                'deskripsi_lomba' => $request->deskripsi_lomba,
                'tanggal_lomba' => $request->tanggal_lomba,
                'tingkat_lomba' => $request->tingkat_lomba,
                'tingkat_juara' => $tingkat_juara,
                'poin_lomba' => $request->poin_lomba,
            ];

            if ($uploadedFile && $uploadedFile->isValid()) {
                // kirim multipart sebagai POST dan spoof method PUT
                $payload['_method'] = 'PUT';
                $response = Http::attach(
                    'file_evidence',
                    file_get_contents($uploadedFile->getRealPath()),
                    $uploadedFile->getClientOriginalName()
                )->post($url, $payload);
            } else {
                // tidak ada file -> langsung PUT biasa
                $response = Http::put($url, $payload);
            }

            if ($response->successful()) {
                return redirect()->route('tes.index')->with('success', 'Data berhasil diperbarui');
            }

            return response()->json($response->json());
            // return redirect()->back()->with('error', 'API error: ' . $response->body())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://" . Config::get('app.API') . "/api/performa/" . $id);
        return redirect()->route('tes.index')->with('success', 'Data berhasil dihapus');
    }
}
