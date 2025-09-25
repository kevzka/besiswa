<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_roles' => ['required', 'int'],
            'username' => ['required', 'string', 'max:255', 'unique:admins,username'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        // Simpan user baru
        $user = User::create([
            'username' => $validated['username'],
            'id_roles' => $validated['id_roles'], // Set role sebagai user biasa
            'password' => Hash::make($validated['password']),
            // 'email' => $validated['email'],
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        $roleName = $user->role ? $user->role->nama : '';

            return view('admin.dashboard', ['role' => $roleName]);

        // Redirect ke dashboard
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            // dd();
            $roleName = $user->id_roles ? $user->id_roles : '';

            return view('admin.dashboard', ['role' => $roleName]);

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
            // 'password' => 'Username atau password salah.'
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
