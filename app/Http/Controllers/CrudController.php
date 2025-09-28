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

    protected $moduleTypeMapping = [
        'admin.bimbingan.index' => [1, 'bimbingan'], // Type for guidance activities
        'admin.prestasi.index' => [2, 'prestasi'], // Type for achievement activities
        'admin.ekskul.index' => [3, 'ekskul'], // Type for extracurricular activities
        'admin.bimbingan.store' => [1, 'bimbingan'], // Type for guidance activities
        'admin.prestasi.store' => [2, 'prestasi'], // Type for achievement activities
        'admin.ekskul.store' => [3, 'ekskul'], // Type for extracurricular activities
        'admin.bimbingan.update' => [1, 'bimbingan'], // Type for guidance activities
        'admin.prestasi.update' => [2, 'prestasi'], // Type for achievement activities
        'admin.ekskul.update' => [3, 'ekskul'], // Type for extracurricular activities
        'admin.bimbingan.destroy' => [1, 'bimbingan'], // Type for guidance activities
        'admin.prestasi.destroy' => [2, 'prestasi'], // Type for achievement activities
        'admin.ekskul.destroy' => [3, 'ekskul'], // Type for extracurricular activities
        'admin.bimbingan.edit' => [1, 'bimbingan'], // Type for guidance activities
        'admin.prestasi.edit' => [2, 'prestasi'], // Type for achievement activities
        'admin.ekskul.edit' => [3, 'ekskul'], // Type for extracurricular activities
    ];

    public function index(Request $request)
    {
        // Get activities based on their type/role
        $currentRouteName = $request->route()->getName();
        $activityType = $this->moduleTypeMapping[$currentRouteName][0];
        $activityList = Tb_kegiatan::where('type', $activityType)->get();
        return view("admin.{$this->moduleTypeMapping[$currentRouteName][1]}.create", compact('activityList'));
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
        $currentRouteName = $request->route()->getName();
        $activityType = $this->moduleTypeMapping[$currentRouteName][0];
        
        // Input validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240', // max 10MB
            'date' => 'required|date'
        ]);
        
        $authenticatedUser = Auth::user();
        $uploadedFilePath = null;
        $generatedFileName = null;

        // Handle file upload
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $sanitizedTitle = str_replace(' ', '_', $request->title);
            
            // Generate unique filename
            $generatedFileName = time() . '_' . $sanitizedTitle . '.' . $uploadedFile->getClientOriginalExtension();

            // Store file in storage/app/public/kegiatan directory
            $uploadedFilePath = $uploadedFile->storeAs('kegiatan', $generatedFileName, 'public');
        }
        
        // Save to database
        tb_kegiatan::create([
            'id_admin' => $authenticatedUser->id, // Get the logged-in user ID
            'type' => $activityType, // Set the activity type
            'title' => $request->title,
            'description' => $request->description,
            'file' => $uploadedFilePath, // Save relative path
            'date' => $request->date,
        ]);

        return redirect()->route('admin.' . $this->moduleTypeMapping[$currentRouteName][1] . '.index')->with('success', 'Activity successfully added!');
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
    public function edit($activityId, Request $request)
    {
        $currentRouteName = $request->route()->getName();
        $activityRecord = tb_kegiatan::findOrFail($activityId); // Use findOrFail for consistency
        return view("admin.{$this->moduleTypeMapping[$currentRouteName][1]}.edit", ['item' => $activityRecord]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $activityId)
    {
        // Remove this dd() for production
        // dd($request->all());
        $currentRouteName = $request->route()->getName();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240', // Change to nullable
            'date' => 'required|date'
        ]);
        
        $activityRecord = tb_kegiatan::findOrFail($activityId);
        $updatedFilePath = $activityRecord->file; // Default to old file
        
        // Handle file upload if new file exists
        if ($request->hasFile('file')) {
            // 1. Delete old file if exists
            if ($activityRecord->file && Storage::disk('public')->exists($activityRecord->file)) {
                Storage::disk('public')->delete($activityRecord->file);
            }
            
            // 2. Upload new file
            $uploadedFile = $request->file('file');
            $sanitizedTitle = str_replace(' ', '_', $request->title);
            
            // Generate unique filename
            $generatedFileName = time() . '_' . $sanitizedTitle . '.' . $uploadedFile->getClientOriginalExtension();
            
            // Store file in storage/app/public/kegiatan directory
            $updatedFilePath = $uploadedFile->storeAs('kegiatan', $generatedFileName, 'public');
        }
        
        // 3. Update database record
        $activityRecord->update([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $updatedFilePath, // New file path or keep the old one
            'date' => $request->date,
        ]);
        
        return redirect()->route("admin.{$this->moduleTypeMapping[$currentRouteName][1]}.index")->with('success', 'Data successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($activityId, Request $request)
    {
        $currentRouteName = $request->route()->getName();
        $activityRecord = tb_kegiatan::findOrFail($activityId);

        // Delete file from storage if exists
        if ($activityRecord->file && Storage::disk('public')->exists($activityRecord->file)) {
            Storage::disk('public')->delete($activityRecord->file);
        }

        // Delete record from database
        $activityRecord->delete();

        return redirect()->route("admin.{$this->moduleTypeMapping[$currentRouteName][1]}.index")->with('success', 'Data successfully deleted!');
    }
}