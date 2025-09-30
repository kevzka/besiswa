<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\tb_kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrudApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activities = tb_kegiatan::where('type', $request->query('type'))->get();
        return response()->json(['message' => 'Activities retrieved successfully', 'data' => $activities]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $activities = tb_kegiatan::where('type', $request->type)->get();
        return response()->json(['message' => 'Activities retrieved successfully', 'data' => $activities]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240',
            'date' => 'required|date'
        ]);
        
        $storedFilePath = null;
        $finalFileName = null;

        // Process file upload
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $sanitizedTitle = str_replace(' ', '_', $request->title);
            
            // Create unique filename with timestamp
            $finalFileName = time() . '_' . $sanitizedTitle . '.' . $uploadedFile->getClientOriginalExtension();

            // Store file in public storage
            $storedFilePath = $uploadedFile->storeAs('kegiatan', $finalFileName, 'public');
        }
        
        // Create new activity record
        tb_kegiatan::create([
            'id_admin' => $request->id_admin,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $storedFilePath,
            'date' => $request->date,
        ]);

        return response()->json(['message' => 'Activity created successfully', 'file_name' => $finalFileName], 201);
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
        $activity = tb_kegiatan::findOrFail($activityId);
        return response()->json(['message' => 'Activity retrieved for editing', 'data' => $activity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240',
            'date' => 'required|date'
        ]);
        
        $activity = tb_kegiatan::findOrFail($id);
        $updatedFilePath = $activity->file;
        
        // Handle new file upload if provided
        if ($request->hasFile('file')) {
            // Delete existing file if it exists
            if ($activity->file && Storage::disk('public')->exists($activity->file)) {
                Storage::disk('public')->delete($activity->file);
            }
            
            // Process and store new file
            $uploadedFile = $request->file('file');
            $sanitizedTitle = str_replace(' ', '_', $request->title);
            
            // Create unique filename with timestamp
            $finalFileName = time() . '_' . $sanitizedTitle . '.' . $uploadedFile->getClientOriginalExtension();
            
            // Store file in public storage
            $updatedFilePath = $uploadedFile->storeAs('kegiatan', $finalFileName, 'public');
        }
        
        // Update activity record
        $activity->update([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $updatedFilePath,
            'date' => $request->date,
        ]);
        
        return response()->json(['message' => 'Activity updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($activityId, Request $request)
    {
        $activity = tb_kegiatan::findOrFail($activityId);

        // Remove associated file if it exists
        if ($activity->file && Storage::disk('public')->exists($activity->file)) {
            Storage::disk('public')->delete($activity->file);
        }

        // Delete activity record
        $activity->delete();
        
        return response()->json(['message' => 'Activity deleted successfully']);
    }
}