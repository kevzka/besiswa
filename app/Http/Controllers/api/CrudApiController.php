<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TbEvidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CrudApiController extends Controller
{
    public function test(Request $request)
    {
        Log::info('Testing API endpoint', [
            'query_params' => $request->query()
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'API test successful',
            'data' => $request->query()
        ]);
    }

    public function home(Request $request)
    {
        Log::info('Accessing home API endpoint', [
            'id_admin' => $request->id_admin
        ]);

        try {
            if (!$request->id_admin) {
                Log::warning('Missing id_admin parameter in home request');
                return response()->json([
                    'success' => false,
                    'message' => 'Parameter id_admin is required'
                ], 400);
            }

            Log::info('Retrieving activities for admin', [
                'id_admin' => $request->id_admin
            ]);

            $activities = TbEvidence::where('id_admin', $request->id_admin)->get();
            
            $countBimbingan = $activities->where('type', 1)->count();    
            $countPrestasi = $activities->where('type', 2)->count();
            $countEkskul = $activities->where('type', 3)->count();

            Log::info('Home data retrieved successfully', [
                'id_admin' => $request->id_admin,
                'total_activities' => $activities->count(),
                'count_bimbingan' => $countBimbingan,
                'count_prestasi' => $countPrestasi,
                'count_ekskul' => $countEkskul
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Home data retrieved successfully',
                'data' => [
                    'countBimbingan' => $countBimbingan,
                    'countPrestasi' => $countPrestasi,
                    'countEkskul' => $countEkskul,
                    'activities' => $activities
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving home data', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'id_admin' => $request->id_admin
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve home data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Log::info('Accessing activities index', [
            'type' => $request->query('type')
        ]);

        try {
            $type = $request->query('type');
            
            if (!$type) {
                Log::warning('Missing type parameter in index request');
                return response()->json([
                    'success' => false,
                    'message' => 'Parameter type is required'
                ], 400);
            }

            Log::info('Retrieving activities by type', ['type' => $type]);
            $activities = TbEvidence::where('type', $type)->get();

            Log::info('Activities retrieved successfully', [
                'type' => $type,
                'count' => $activities->count()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Activities retrieved successfully',
                'data' => $activities
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving activities index', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'type' => $request->query('type')
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve activities',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Log::info('Accessing create activities', [
            'type' => $request->type
        ]);

        try {
            if (!$request->type) {
                Log::warning('Missing type parameter in create request');
                return response()->json([
                    'success' => false,
                    'message' => 'Parameter type is required'
                ], 400);
            }

            Log::info('Retrieving activities for create form', ['type' => $request->type]);
            $activities = TbEvidence::where('type', $request->type)->get();

            Log::info('Create form data retrieved successfully', [
                'type' => $request->type,
                'count' => $activities->count()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Activities retrieved successfully',
                'data' => $activities
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving create form data', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'type' => $request->type
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve create form data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Starting store activity process', [
            'title' => $request->title,
            'type' => $request->type,
            'id_admin' => $request->id_admin
        ]);

        try {
            Log::info('Validating store request data');
            // Validate input data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240',
                'date' => 'required|date',
                'id_admin' => 'required',
                'type' => 'required'
            ]);

            Log::info('Store validation passed', [
                'title' => $validatedData['title'],
                'type' => $validatedData['type']
            ]);
            
            $storedFilePath = null;
            $finalFileName = null;

            // Process file upload
            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                Log::info('Processing file upload', [
                    'original_name' => $uploadedFile->getClientOriginalName(),
                    'size' => $uploadedFile->getSize(),
                    'mime_type' => $uploadedFile->getMimeType()
                ]);

                $sanitizedTitle = str_replace(' ', '_', $request->title);
                
                // Create unique filename with timestamp
                $finalFileName = time() . '_' . $sanitizedTitle . '.' . $uploadedFile->getClientOriginalExtension();

                Log::info('Storing file', ['filename' => $finalFileName]);
                // Store file in public storage
                $storedFilePath = $uploadedFile->storeAs('kegiatan', $finalFileName, 'public');
                
                // Check if file was actually stored
                if (!$storedFilePath) {
                    Log::error('Failed to store file', [
                        'filename' => $finalFileName,
                        'title' => $request->title
                    ]);

                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload file'
                    ], 500);
                }

                Log::info('File stored successfully', [
                    'stored_path' => $storedFilePath,
                    'filename' => $finalFileName
                ]);
            }
            
            Log::info('Creating activity record');
            // Create new activity record
            $activity = TbEvidence::create([
                'id_admin' => $validatedData['id_admin'],
                'type' => $validatedData['type'],
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'file' => $storedFilePath,
                'date' => $validatedData['date'],
            ]);

            Log::info('Activity created successfully', [
                'activity_id' => $activity->id,
                'title' => $activity->title,
                'type' => $activity->type
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Activity created successfully',
                'data' => [
                    'id' => $activity->id,
                    'title' => $activity->title,
                    'file_name' => $finalFileName,
                    'file_path' => $storedFilePath
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Store validation failed', [
                'errors' => $e->errors(),
                'input' => $request->except(['file'])
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing activity', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'title' => $request->title ?? 'unknown'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create activity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TbEvidence $TbEvidence)
    {
        Log::info('Accessing show activity', [
            'activity_id' => $TbEvidence->id ?? 'null'
        ]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($activityId, Request $request)
    {
        Log::info('Accessing edit activity', ['activity_id' => $activityId]);

        try {
            Log::info('Finding activity for edit', ['activity_id' => $activityId]);
            $activity = TbEvidence::findOrFail($activityId);

            Log::info('Activity found for edit', [
                'activity_id' => $activity->id,
                'title' => $activity->title,
                'type' => $activity->type
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Activity retrieved for editing',
                'data' => $activity
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Activity not found for edit', [
                'activity_id' => $activityId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Activity not found'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error retrieving activity for edit', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'activity_id' => $activityId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve activity for editing',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('Starting update activity process', [
            'activity_id' => $id,
            'title' => $request->title
        ]);

        try {
            Log::info('Validating update request data');
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240',
                'date' => 'required|date'
            ]);

            Log::info('Update validation passed');
            
            Log::info('Finding activity for update', ['activity_id' => $id]);
            $activity = TbEvidence::findOrFail($id);
            
            Log::info('Activity found for update', [
                'activity_id' => $activity->id,
                'current_title' => $activity->title
            ]);

            $updatedFilePath = $activity->file;
            
            // Handle new file upload if provided
            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                Log::info('Processing file update', [
                    'activity_id' => $id,
                    'new_file' => $uploadedFile->getClientOriginalName(),
                    'old_file' => $activity->file
                ]);

                // Delete existing file if it exists
                if ($activity->file && Storage::disk('public')->exists($activity->file)) {
                    Log::info('Deleting old file', ['file_path' => $activity->file]);
                    Storage::disk('public')->delete($activity->file);
                }
                
                // Process and store new file
                $sanitizedTitle = str_replace(' ', '_', $request->title);
                
                // Create unique filename with timestamp
                $finalFileName = time() . '_' . $sanitizedTitle . '.' . $uploadedFile->getClientOriginalExtension();
                
                Log::info('Storing new file', ['filename' => $finalFileName]);
                // Store file in public storage
                $updatedFilePath = $uploadedFile->storeAs('kegiatan', $finalFileName, 'public');

                if (!$updatedFilePath) {
                    Log::error('Failed to store updated file', [
                        'activity_id' => $id,
                        'filename' => $finalFileName
                    ]);

                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload new file'
                    ], 500);
                }

                Log::info('New file stored successfully', [
                    'stored_path' => $updatedFilePath
                ]);
            }
            
            Log::info('Updating activity record', ['activity_id' => $id]);
            // Update activity record
            $activity->update([
                'title' => $request->title,
                'description' => $request->description,
                'file' => $updatedFilePath,
                'date' => $request->date,
            ]);

            Log::info('Activity updated successfully', [
                'activity_id' => $activity->id,
                'new_title' => $activity->title
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Activity updated successfully',
                'data' => $activity
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Update validation failed', [
                'errors' => $e->errors(),
                'activity_id' => $id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Activity not found for update', [
                'activity_id' => $id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Activity not found'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error updating activity', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'activity_id' => $id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update activity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($activityId, Request $request)
    {
        Log::info('Starting delete activity process', [
            'activity_id' => $activityId
        ]);

        try {
            Log::info('Finding activity for deletion', ['activity_id' => $activityId]);
            $activity = TbEvidence::findOrFail($activityId);

            Log::info('Activity found for deletion', [
                'activity_id' => $activity->id,
                'title' => $activity->title,
                'file' => $activity->file
            ]);

            // Remove associated file if it exists
            if ($activity->file && Storage::disk('public')->exists($activity->file)) {
                Log::info('Deleting associated file', [
                    'file_path' => $activity->file
                ]);
                Storage::disk('public')->delete($activity->file);
                Log::info('File deleted successfully');
            }

            Log::info('Deleting activity record', ['activity_id' => $activityId]);
            // Delete activity record
            $activity->delete();

            Log::info('Activity deleted successfully', [
                'activity_id' => $activityId
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Activity deleted successfully'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Activity not found for deletion', [
                'activity_id' => $activityId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Activity not found'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error deleting activity', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'activity_id' => $activityId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete activity',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}