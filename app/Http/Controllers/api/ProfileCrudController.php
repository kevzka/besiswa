<?php

<<<<<<< HEAD
namespace App\Http\Controllers\api;
=======
namespace App\Http\Controllers\Api;
>>>>>>> 5582c58f29a520ba73d8d55abedc6bcf68152c84

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProfileCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }
    
    public function getProfile(Request $request){
        Log::info('Getting user profile', [
            'id_admin' => $request->id_admin
        ]);

        try {
            if (!$request->id_admin) {
                Log::warning('Missing id_admin parameter in getProfile request');
                return response()->json([
                    'success' => false,
                    'message' => 'Parameter id_admin is required'
                ], 400);
            }

            Log::info('Finding user profile', ['id_admin' => $request->id_admin]);
            $profile = User::where('id', $request->id_admin)->first();
            
            if (!$profile) {
                Log::warning('User profile not found', [
                    'id_admin' => $request->id_admin
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'User profile not found'
                ], 404);
            }

            Log::info('User profile retrieved successfully', [
                'id_admin' => $request->id_admin,
                'username' => $profile->username
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile retrieved successfully',
                'data' => $profile
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving user profile', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'id_admin' => $request->id_admin
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
