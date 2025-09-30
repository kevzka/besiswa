<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $user = Auth::user();
        $roleName = $user->getRole ? $user->getRole->role : '';
        
        return view('admin.dashboard', ['role' => $roleName, 'id_role' => $user->id_roles]);
    }
    public function profileDashboard()
    {
        $response = Http::post('http://besiswa.test/api/getProfile', ['id_admin' => Auth::user()->id]);
        return view('admin.profile', ['user' => $response->json()]);
    }
    public function publicDashboard()
    {
        return view('public.dashboard');
    }
}
