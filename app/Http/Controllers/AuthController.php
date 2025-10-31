<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
<<<<<<< Updated upstream
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    
    public function register(Request $request)
=======
    protected $roles = [
        1 => 'bimbingan',
        2 => 'ekskul',
        3 => 'prestasi',
        4 => 'utama'
    ];

    public function showRegistrationForm()
    {
        Log::info('Accessing registration form');

        try {
            Log::info('Rendering registration view');
            return view('auth.register');
        } catch (\Exception $e) {
            Log::error('Error showing registration form', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat form registrasi');
        }
    }

    /* public function register(Request $request)
>>>>>>> Stashed changes
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

            $roleName = $user->getRole ? $user->getRole->role : '';

            return view('admin.dashboard', ['role' => $roleName]);

        // Redirect ke dashboard
    }
 */
    public function showLoginForm(Request $request)
    {
<<<<<<< Updated upstream
        return view('auth.login');
=======
        if (session()->has('jwt_token')) {
            return redirect('admin/dashboard');
            dd('berhasil yahahah showLoginForm');
        }

        dd($request->cookie());

        // dd('gagal  yahahah showLoginForm');

        // Log::info('Accessing login form');

        // try {
        //     Log::info('Rendering login view');
        //     return view('auth.login');
        // } catch (\Exception $e) {
        //     Log::error('Error showing login form', [
        //         'exception' => $e->getMessage(),
        //         'file' => $e->getFile(),
        //         'line' => $e->getLine()
        //     ]);

        //     return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat form login');
        // }
>>>>>>> Stashed changes
    }

    /* public function login(Request $request)
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
<<<<<<< Updated upstream
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
=======
        Log::info('Starting logout process');
        
        try {
            $user = Auth::user();
            
            Log::info('User logging out', [
                'user_id' => $user ? $user->id : 'unknown',
                'username' => $user ? $user->username : 'unknown'
            ]);
            
            Auth::logout();
            
            Log::info('User logged out successfully');
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            Log::info('Session invalidated and token regenerated');
            Log::info('Redirecting to home page after logout');
            
            return redirect('/');
            
        } catch (\Exception $e) {
            Log::error('Error in logout process', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return redirect('/')->with('error', 'Terjadi kesalahan saat logout');
        }
    } */

    public function register()
    {
        //register ke api jwt di App\Http\Controllers\Api\RegisterController
        $response = Http::post('http://besiswa.test/api/register', [
            'username' => request('username'),
            'password' => request('password'),
            'password_confirmation' => request('password_confirmation'),
            'email' => request('email'),
            'instagram' => request('instagram'),
            'facebook' => request('facebook'),
            'no_telp' => request('no_telp'),
            'id_roles' => request('id_roles'),
        ]);
        $data = $response->json();
        $jwtToken = cookie('jwt_token', json_encode($data['token']));
        $adminData = cookie('user_data', json_encode($data['user']));

        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.')->withCookie($jwtToken)->withCookie($adminData);
>>>>>>> Stashed changes
    }

    public function login() {}
    public function logout()
    {
        $jwtToken = cookie()->forget('jwt_token');
        $adminData = cookie()->forget('user_data');
        return redirect('/')->with('success', 'Logout berhasil.')->withCookie($jwtToken)->withCookie($adminData);
    }

}
