<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tb_kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrudApiController extends Controller
{
    public function test(Request $request)
    {
        return response()->json(['message' => $request->query()]);
    }
    public function home(Request $request)
    {
        $activities = Tb_kegiatan::where('id_admin', $request->id_admin)->get();
        $countBimbingan = $activities->where('type', 1)->count();    
        $countPrestasi = $activities->where('type', 2)->count();
        $countEkskul = $activities->where('type', 3)->count();
        return response()->json(['message' => 'API is working', 'countBimbingan' => $countBimbingan, 'countPrestasi' => $countPrestasi, 'countEkskul' => $countEkskul, 'activities' => $activities]);
    }
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $activities = Tb_kegiatan::where('type', $request->query('type'))->get();
        return response()->json(['message' => 'Activities retrieved successfully', 'data' => $activities]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $activities = Tb_kegiatan::where('type', $request->type)->get();
        return response()->json(['message' => 'Activities retrieved successfully', 'data' => $activities]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        try {
            // Validate input data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240',
                'date' => 'required|date',
                'id_admin' => 'required',
                'type' => 'required'
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
                
                // Check if file was actually stored
                if (!$storedFilePath) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload file'
                    ], 500);
                }
            }
            
            // Create new activity record
            $activity = Tb_kegiatan::create([
                'id_admin' => $validatedData['id_admin'],
                'type' => $validatedData['type'],
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'file' => $storedFilePath,
                'date' => $validatedData['date'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Activity created successfully',
                'data' => [
                    'id' => $activity->id,
                    'file_name' => $finalFileName
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // Any other errors
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tb_kegiatan $Tb_kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($activityId, Request $request)
    {
        $activity = Tb_kegiatan::findOrFail($activityId);
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
        
        $activity = Tb_kegiatan::findOrFail($id);
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
        $activity = Tb_kegiatan::findOrFail($activityId);

        // Remove associated file if it exists
        if ($activity->file && Storage::disk('public')->exists($activity->file)) {
            Storage::disk('public')->delete($activity->file);
        }

        // Delete activity record
        $activity->delete();
        
        return response()->json(['message' => 'Activity deleted successfully']);
    }
}