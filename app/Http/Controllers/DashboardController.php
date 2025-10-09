<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        Log::info('Accessing admin dashboard');
        
        try {
            $user = Auth::user();
            Log::info('User authenticated for admin dashboard', [
                'user_id' => $user->id,
                'username' => $user->username
            ]);
            
            $roleName = $user->getRole ? $user->getRole->role : '';
            Log::info('User role determined for admin dashboard', [
                'role_name' => $roleName,
                'id_roles' => $user->id_roles
            ]);
            
            Log::info('Rendering admin dashboard view');
            return view('admin.dashboard', [
                'role' => $roleName, 
                'id_role' => $user->id_roles
            ]);
        } catch (\Exception $e) {
            Log::error('Error accessing admin dashboard', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengakses dashboard');
        }
    }
    
    public function profileDashboard()
    {
        Log::info('Accessing profile dashboard');
        
        try {
            $user = Auth::user();
            Log::info('User authenticated for profile dashboard', [
                'user_id' => $user->id,
                'username' => $user->username
            ]);
            
            $roleName = $user->getRole ? $user->getRole->role : '';
            Log::info('User role determined for profile dashboard', [
                'role_name' => $roleName,
                'id_roles' => $user->id_roles
            ]);
            
            Log::info('Making API request to get profile', ['id_admin' => $user->id]);
            $response = Http::post('http://besiswa.test/api/getProfile', ['id_admin' => $user->id]);
            
            if (!$response->successful()) {
                Log::error('Failed to retrieve profile data', [
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                    'id_admin' => $user->id
                ]);
                throw new \Exception('Failed to retrieve profile data');
            }
            
            Log::info('Profile data retrieved successfully', [
                'user_id' => $user->id,
                'response_status' => $response->status()
            ]);
            
            Log::info('Rendering profile dashboard view');
            return view('admin.profile', [
                'user' => $response->json()['data'], 
                'role' => $roleName, 
                'id_role' => $user->id_roles, 
                'adminName' => $user->username
            ]);
        } catch (\Exception $e) {
            Log::error('Error accessing profile dashboard', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengakses profil');
        }
    }
    
    public function publicDashboard()
    {
        Log::info('Accessing public dashboard');
        
        try {
            Log::info('Rendering public dashboard view');
            return view('public.dashboard');
        } catch (\Exception $e) {
            Log::error('Error accessing public dashboard', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengakses dashboard publik');
        }
    }
}
