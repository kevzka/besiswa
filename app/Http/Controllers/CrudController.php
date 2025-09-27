<?php

namespace App\Http\Controllers;

use App\Models\tb_kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $adminTypes = [
        'admin.bimbingan.index' => [1, 'bimbingan'], // Tipe untuk bimbingan
        'admin.prestasi.index' => [2, 'prestasi'], // Tipe untuk prestasi
        'admin.ekskul.index' => [3, 'ekskul'], // Tipe untuk ekstrakurikuler
        'admin.bimbingan.store' => [1, 'bimbingan'], // Tipe untuk bimbingan
        'admin.prestasi.store' => [2, 'prestasi'], // Tipe untuk prestasi
        'admin.ekskul.store' => [3, 'ekskul'], // Tipe untuk ekstrakurikuler
        'admin.bimbingan.update' => [1, 'bimbingan'], // Tipe untuk bimbingan
        'admin.prestasi.update' => [2, 'prestasi'], // Tipe untuk prestasi
        'admin.ekskul.update' => [3, 'ekskul'], // Tipe untuk ekstrakurikuler
        'admin.bimbingan.destroy' => [1, 'bimbingan'], // Tipe untuk bimbingan
        'admin.prestasi.destroy' => [2, 'prestasi'], // Tipe untuk prestasi
        'admin.ekskul.destroy' => [3, 'ekskul'], // Tipe untuk ekstrak
        'admin.bimbingan.edit' => [1, 'bimbingan'], // Tipe untuk bimbingan
        'admin.prestasi.edit' => [2, 'prestasi'], // Tipe
        'admin.ekskul.edit' => [3, 'ekskul'], // Tipe untuk ekstrakurikuler
    ];

    public function index(Request $request)
    {
        //sejenis dengan role nya
        $routeName = $request->route()->getName();
        $type = $this->adminTypes[$routeName][0];
        $kegiatan = Tb_kegiatan::where('type', $type)->get();
        return view("admin.{$this->adminTypes[$routeName][1]}.create", compact('kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $routeName = $request->route()->getName();
        $type = $this->adminTypes[$routeName][0];
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240', // max 10MB
            'date' => 'required|date'
        ]);
        $user = Auth::user();
        $filePath = null;
        $fileName = null;

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $cleanTitle = str_replace(' ', '_', $request->title);
            
            // Generate unique filename
            $fileName = time() . '_' . $cleanTitle . '.' . $file->getClientOriginalExtension();

            // Store file dalam folder storage/app/public/kegiatan
            $filePath = $file->storeAs('kegiatan', $fileName, 'public');
        }
        
        // Simpan ke database
        tb_kegiatan::create([
            'id_admin' => $user->id, // Ambil ID user yang login
            'type' => $type, // Set type ke 'bimbingan'
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filePath, // simpan path relatif
            'date' => $request->date,
        ]);

        return redirect()->route('admin.' . $this->adminTypes[$routeName][1] . '.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(tb_kegiatan $tb_kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($bimbingan, Request $request)
    {
        $routeName = $request->route()->getName();
        $tb_kegiatan = tb_kegiatan::findOrFail($bimbingan); // Gunakan findOrFail untuk konsistensi
        return view("admin.{$this->adminTypes[$routeName][1]}.edit", ['item' => $tb_kegiatan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $bimbingan)
    {
        // Hapus dd() ini untuk production
        // dd($request->all());
        $routeName = $request->route()->getName();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240', // ubah ke nullable
            'date' => 'required|date'
        ]);
        
        $item = tb_kegiatan::findOrFail($bimbingan);
        $filePath = $item->file; // Default ke file lama
        
        // Handle file upload jika ada file baru
        if ($request->hasFile('file')) {
            // 1. Hapus file lama jika ada
            if ($item->file && Storage::disk('public')->exists($item->file)) {
                Storage::disk('public')->delete($item->file);
            }
            
            // 2. Upload file baru
            $file = $request->file('file');
            $cleanTitle = str_replace(' ', '_', $request->title);
            
            // Generate unique filename
            $fileName = time() . '_' . $cleanTitle . '.' . $file->getClientOriginalExtension();
            
            // Store file dalam folder storage/app/public/kegiatan
            $filePath = $file->storeAs('kegiatan', $fileName, 'public');
        }
        
        // 3. Update data di database
        $item->update([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filePath, // file path baru atau tetap yang lama
            'date' => $request->date,
        ]);
        
        return redirect()->route("admin.{$this->adminTypes[$routeName][1]}.index")->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bimbingan, Request $request)
    {
        $routeName = $request->route()->getName();
        $tb_kegiatan = tb_kegiatan::findOrFail($bimbingan);

        // Hapus file dari storage jika ada
        if ($tb_kegiatan->file && Storage::disk('public')->exists($tb_kegiatan->file)) {
            Storage::disk('public')->delete($tb_kegiatan->file);
        }

        // Hapus data dari database
        $tb_kegiatan->delete();

        return redirect()->route("admin.{$this->adminTypes[$routeName][1]}.index")->with('success', 'Data berhasil dihapus!');
    }
}