<?php

namespace App\Http\Controllers;

use App\Models\TbEvidences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class CrudController extends Controller
{
    protected $routeModuleMapping = [
        'admin.bimbingan.index' => [1, 'bimbingan'],
        'admin.prestasi.index' => [2, 'prestasi'],
        'admin.ekskul.index' => [3, 'ekskul'],
        'admin.bimbingan.store' => [1, 'bimbingan'],
        'admin.prestasi.store' => [2, 'prestasi'],
        'admin.ekskul.store' => [3, 'ekskul'],
        'admin.bimbingan.update' => [1, 'bimbingan'],
        'admin.prestasi.update' => [2, 'prestasi'],
        'admin.ekskul.update' => [3, 'ekskul'],
        'admin.bimbingan.destroy' => [1, 'bimbingan'],
        'admin.prestasi.destroy' => [2, 'prestasi'],
        'admin.ekskul.destroy' => [3, 'ekskul'],
        'admin.bimbingan.edit' => [1, 'bimbingan'],
        'admin.prestasi.edit' => [2, 'prestasi'],
        'admin.ekskul.edit' => [3, 'ekskul'],
        'admin.bimbingan.create' => [1, 'bimbingan'],
        'admin.prestasi.create' => [2, 'prestasi'],
        'admin.ekskul.create' => [3, 'ekskul'],
        'admin.bimbingan.dashboard' => [1, 'bimbingan'],
        'admin.prestasi.dashboard' => [2, 'prestasi'],
        'admin.ekskul.dashboard' => [3, 'ekskul'],
    ];
    protected $roles = [
        1 => 'bimbingan',
        2 => 'prestasi',
        3 => 'ekskul',
        4 => 'utama'
    ];
    
    public function home(Request $request)
    {
        Log::info('Accessing home dashboard');

        try {
            $user = Auth::user();
            Log::info('User authenticated', ['user_id' => $user->id_admin, 'username' => $user->username]);

            $roleName = $user->getRole ? $user->getRole->role : '';
            $role = $this->roles[$user->id_role] ?? 'guest';
            Log::info('User role determined', ['role_name' => $roleName, 'role' => $role, 'id_roles' => $user->id_role]);

            Log::info('Making API request to home endpoint', ['id_admin' => $user->id_admin]);
            $response = Http::get('http://' . Config::get('app.API') . '/api/home', ['id_admin' => $user->id_admin]);

            if (!$response->successful()) {
                Log::error('Failed to retrieve home dashboard data', [
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                    'id_admin' => $user->id
                ]);
                throw new \Exception('Failed to retrieve home dashboard data');
            }

            Log::info('Home dashboard data retrieved successfully', [
                'data_keys' => array_keys($response->json()),
                'user_id' => $user->id
            ]);

            Log::info('Rendering dashboard view', ['view' => "admin.$role.dashboard"]);
            return view("admin.$role.dashboard", [
                'data' => $response->json()['data'],
                'role' => $roleName,
                'id_role' => $user->id_role,
                'adminName' => $user->username
            ]);
        } catch (\Exception $e) {
            Log::error('Error accessing home dashboard', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function index(Request $request)
    {
        Log::info('Accessing index method', ['route' => $request->route()->getName()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Log::info('Accessing create method');
        try {
            $currentRouteName = $request->route()->getName();
            Log::info('Current route determined', ['route_name' => $currentRouteName]);
            
            $activityType = $this->routeModuleMapping[$currentRouteName][0];
            Log::info('Activity type mapped', ['activity_type' => $activityType]);
            
            $user = Auth::user();
            Log::info('User authenticated for create', ['user_id' => $user->id_admin, 'username' => $user->username]);
            
            $roleName = $user->getRole ? $user->getRole->role : '';
            Log::info('User role for create', ['role_name' => $roleName]);

            Log::info('Making API request to create endpoint', ['type' => $activityType]);
            $activities = Http::post('http://' . Config::get('app.API') . '/api/crud/create', ['type' => $activityType]);

            if (!$activities->successful()) {
                Log::error('Failed to retrieve activities data', [
                    'status_code' => $activities->status(),
                    'response_body' => $activities->body(),
                    'activity_type' => $activityType
                ]);
                throw new \Exception('Failed to retrieve activities data');
            }
            Log::info('Activities data retrieved successfully', [
                'activity_type' => $activityType,
                'data_count' => count($activities->json()['data'] ?? [])
            ]);
            
            $activities = $activities->json()['data'];
            $viewName = "admin.{$this->routeModuleMapping[$currentRouteName][1]}.create";
            Log::info('Rendering create view', ['view' => $viewName]);

            return view($viewName, compact('activities'), [
                'role' => $roleName,
                'id_role' => $user->id_role,
                'adminId' => $user->id_admin,
                'adminName' => $user->username
            ]);
        } catch (\Exception $e) {
            Log::error('Error in create method', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'route' => $request->route()->getName()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Starting store method');
        try {
            $user = Auth::user();
            Log::info('User authenticated for store', ['user_id' => $user->id_admin]);
            
            $currentRouteName = $request->route()->getName();
            $activityType = $this->routeModuleMapping[$currentRouteName][0];
            Log::info('Store operation details', [
                'route_name' => $currentRouteName,
                'activity_type' => $activityType
            ]);

            Log::info('Validating request data');
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4,avi,mov|max:10240',
                'date' => 'required|date',
            ]);

            Log::info('Request validation passed');

            $requestData = array_merge(
                $request->except(['_token', 'files']),
                [
                    'id_admin' => $user->id_admin,
                    'type' => $activityType
                ]
            );
            Log::info('Request data prepared', ['data_keys' => array_keys($requestData)]);

            $httpRequest = Http::asMultipart();

            // Add form data to multipart request
            foreach ($requestData as $key => $value) {
                $httpRequest = $httpRequest->attach($key, $value);
            }
            Log::info('Form data attached to multipart request');

            // Handle file attachment if present
            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                Log::info('File upload detected', [
                    'original_name' => $uploadedFile->getClientOriginalName(),
                    'size' => $uploadedFile->getSize(),
                    'mime_type' => $uploadedFile->getMimeType()
                ]);
                
                $httpRequest = $httpRequest->attach(
                    'file',
                    file_get_contents($uploadedFile->getRealPath()),
                    $uploadedFile->getClientOriginalName()
                );
                Log::info('File attached to multipart request');
            }

            Log::info('Making API request to store endpoint');
            $response = $httpRequest->post('http://' . Config::get('app.API') . '/api/crud');

            if ($response->successful()) {
                Log::info('Store operation successful', [
                    'status_code' => $response->status(),
                    'activity_type' => $activityType
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil ditambahkan'
                ]);
            } else {
                Log::error('Store operation failed', [
                    'status_code' => $response->status(),
                    'response_body' => $response->body()
                ]);
            }
            
            Log::info('Redirecting to create page');
            return redirect()->route("admin.{$this->routeModuleMapping[$currentRouteName][1]}.create");
        } catch (\Exception $e) {
            Log::error('Error in store method', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Pastikan di isi semua ya field nya!!!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TbEvidences $TbEvidences)
    {
        // Log::info('Accessing show method', ['kegiatan_id' => $TbEvidences->id_evidence ?? 'null']);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        Log::info('Accessing edit method', ['id' => $id]);
        try {
            $currentRouteName = $request->route()->getName();
            $activityType = $this->routeModuleMapping[$currentRouteName][0];
            Log::info('Edit operation details', [
                'route_name' => $currentRouteName,
                'activity_type' => $activityType
            ]);

            Log::info('Making API request to edit endpoint', ['id' => $id]);
            $activityData = Http::get('http://' . Config::get('app.API') . '/api/crud/' . $id . '/edit')->json()['data'];
            Log::info('Activity data retrieved for edit', ['activity_id' => $id]);
            
            $user = Auth::user();
            $roleName = $user->getRole ? $user->getRole->role : '';
            Log::info('User details for edit', [
                'user_id' => $user->id_admin,
                'role_name' => $roleName
            ]);
            
            $viewName = "admin.{$this->routeModuleMapping[$currentRouteName][1]}.edit";
            Log::info('Rendering edit view', ['view' => $viewName]);
            
            return view($viewName, compact('activityData'), [
                'role' => $roleName, 
                'id_role' => $user->id_role, 
                'adminName' => $user->username
            ]);
        } catch (\Exception $e) {
            Log::error('Error in edit method', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'id' => $id
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $activityId)
    {
        Log::info('Starting update method', ['activity_id' => $activityId]);
        try {
            $requestData = array_merge(
                $request->except(['_token', 'files'])
            );
            Log::info('Update request data prepared', [
                'activity_id' => $activityId,
                'data_keys' => array_keys($requestData)
            ]);

            $httpRequest = Http::asMultipart();

            // Add form data to multipart request
            foreach ($requestData as $key => $value) {
                $httpRequest = $httpRequest->attach($key, $value);
            }
            Log::info('Form data attached for update');

            // Handle file attachment if present
            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                Log::info('File upload detected for update', [
                    'original_name' => $uploadedFile->getClientOriginalName(),
                    'size' => $uploadedFile->getSize(),
                    'mime_type' => $uploadedFile->getMimeType()
                ]);
                
                $httpRequest = $httpRequest->attach(
                    'file',
                    file_get_contents($uploadedFile->getRealPath()),
                    $uploadedFile->getClientOriginalName()
                );
                Log::info('File attached for update');
            }

            Log::info('Making API request to update endpoint', ['activity_id' => $activityId]);
            $response = $httpRequest->post('http://' . Config::get('app.API') . '/api/crud/' . $activityId);

            if ($response->successful()) {
                Log::info('Update operation successful', [
                    'activity_id' => $activityId,
                    'status_code' => $response->status()
                ]);
            } else {
                Log::error('Update operation failed', [
                    'activity_id' => $activityId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body()
                ]);
            }

            $currentRouteName = $request->route()->getName();
            Log::info('Redirecting after update', ['route_name' => $currentRouteName]);
            return redirect()->route("admin.{$this->routeModuleMapping[$currentRouteName][1]}.create");
        } catch (\Exception $e) {
            Log::error('Error in update method', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'activity_id' => $activityId
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        Log::info('Starting destroy method', ['id' => $id]);
        try {
            $currentRouteName = $request->route()->getName();
            Log::info('Destroy operation details', ['route_name' => $currentRouteName]);
            
            Log::info('Making API request to delete endpoint', ['id' => $id]);
            $response = Http::delete('http://' . Config::get('app.API') . '/api/crud/'.$id);

            if ($response->successful()) {
                Log::info('Delete operation successful', [
                    'id' => $id,
                    'status_code' => $response->status()
                ]);
                return redirect()->back()->with('success', 'Data berhasil dihapus');
            } else {
                Log::error('Delete operation failed', [
                    'id' => $id,
                    'status_code' => $response->status(),
                    'response_body' => $response->body()
                ]);
                return redirect()->back()->with('error', 'Data Tidak berhasil dihapus');
            }
        } catch (\Exception $e) {
            Log::error('Error in destroy method', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'id' => $id
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
