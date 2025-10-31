<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $user = Auth::user();
        $roleName = $user->getRole ? $user->getRole->role : '';
        
        return view('admin.dashboard', ['role' => $roleName, 'id_role' => $user->id_roles]);
    }
    public function publicDashboard()
    {
        return view('public.dashboard');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', ['user' => $user]);
    }
}
