<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    protected $roles = [
        1 => 'bimbingan',
        2 => 'ekskul',
        3 => 'prestasi',
        4 => 'utama'
    ];
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
            'instagram' => [],
            'facebook' => [],
            'no_telp' => ['required', 'string', 'max:15', 'unique:admins,no_telp'],
        ]);

        // Simpan user baru
        $user = User::create([
            'username' => $validated['username'],
            'id_roles' => $validated['id_roles'], // Set role sebagai user biasa
            'password' => Hash::make($validated['password']),
            'no_telp' => $validated['no_telp'],
            'email' => $validated['email'],
            'instagram' => $validated['instagram'],
            'facebook' => $validated['facebook']
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        $roleName = $user->getRole ? $user->getRole->role : '';
        $role = $this->roles[$user->id_roles] ?? 'guest';
        $response = Http::get('http://besiswa.test/api/home', ['id_admin' => $user->id])->json();

        return view("admin.$role.dashboard", ['data' => $response, 'role' => $roleName, 'id_role' => $user->id_roles, 'adminName' => $user->username]);
        // return redirect()->route("admin.{$this->routeModuleMapping[$currentRouteName][1]}.create");

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
            $roleName = $user->getRole ? $user->getRole->role : '';

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
