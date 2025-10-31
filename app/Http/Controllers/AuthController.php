<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
<<<<<<< HEAD
    protected $roles = [
        1 => 'bimbingan',
        2 => 'ekskul',
        3 => 'prestasi',
        4 => 'utama'
    ];
    
=======
<<<<<<< Updated upstream
>>>>>>> 5582c58f29a520ba73d8d55abedc6bcf68152c84
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
        Log::info('Starting registration process');
        
        try {
            Log::info('Validating registration data', [
                'username' => $request->username,
                'email' => $request->email,
                'id_roles' => $request->id_roles
            ]);
            
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
            
            Log::info('Registration validation passed', [
                'username' => $validated['username'],
                'email' => $validated['email'],
                'role_id' => $validated['id_roles']
            ]);

            Log::info('Creating new user');
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
            
            Log::info('User created successfully', [
                'user_id' => $user->id,
                'username' => $user->username,
                'role_id' => $user->id_roles
            ]);

            Log::info('Auto-login after registration');
            // Login otomatis setelah register
            Auth::login($user);
            
            Log::info('User authenticated after registration', [
                'user_id' => $user->id,
                'username' => $user->username
            ]);

            $roleName = $user->getRole ? $user->getRole->role : '';
            $role = $this->roles[$user->id_roles] ?? 'guest';
            
            Log::info('User role determined after registration', [
                'role_name' => $roleName,
                'role' => $role,
                'id_roles' => $user->id_roles
            ]);
            
            Log::info('Making API request to home endpoint after registration', [
                'id_admin' => $user->id
            ]);
            
            $response = Http::get('http://besiswa.test/api/home', ['id_admin' => $user->id]);
            
            if (!$response->successful()) {
                Log::error('Failed to retrieve home data after registration', [
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                    'id_admin' => $user->id
                ]);
                throw new \Exception('Failed to retrieve dashboard data');
            }
            
            Log::info('Home data retrieved successfully after registration', [
                'user_id' => $user->id,
                'response_status' => $response->status()
            ]);

            Log::info('Rendering dashboard after registration', [
                'view' => "admin.$role.dashboard"
            ]);
            
            return view("admin.$role.dashboard", [
                'data' => $response->json(), 
                'role' => $roleName, 
                'id_role' => $user->id_roles, 
                'adminName' => $user->username
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Registration validation failed', [
                'errors' => $e->errors(),
                'input' => $request->except(['password', 'password_confirmation'])
            ]);
            
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Log::error('Error in registration process', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage())
                        ->withInput($request->except(['password', 'password_confirmation']));
        }
    }
 */
    public function showLoginForm(Request $request)
    {
<<<<<<< HEAD
        Log::info('Accessing login form');
        
        try {
            Log::info('Rendering login view');
            return view('auth.login');
        } catch (\Exception $e) {
            Log::error('Error showing login form', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat form login');
        }
=======
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
>>>>>>> 5582c58f29a520ba73d8d55abedc6bcf68152c84
    }

    /* public function login(Request $request)
    {
        Log::info('Starting login process', [
            'username' => $request->username,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        try {
            Log::info('Validating login credentials');
            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);
            
            Log::info('Login validation passed', [
                'username' => $credentials['username']
            ]);
            
            Log::info('Attempting authentication', [
                'username' => $credentials['username']
            ]);
            
            if (Auth::attempt($credentials)) {
                Log::info('Authentication successful', [
                    'username' => $credentials['username']
                ]);
                
                $request->session()->regenerate();
                
                $user = Auth::user();
                $roleName = $user->getRole ? $user->getRole->role : '';
                
                Log::info('User logged in successfully', [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role_name' => $roleName,
                    'id_roles' => $user->id_roles
                ]);
                
                Log::info('Redirecting to admin dashboard after login');
                return redirect()->intended('/admin/dashboard');
            }
            
            Log::warning('Authentication failed', [
                'username' => $credentials['username'],
                'ip_address' => $request->ip()
            ]);

            return back()->withErrors([
                'username' => 'username atau password salah.',
                'password' => 'username atau password salah.',
            ])->onlyInput('username');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Login validation failed', [
                'errors' => $e->errors(),
                'input' => $request->only('username')
            ]);
            
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Log::error('Error in login process', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'username' => $request->username ?? 'unknown'
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat login')
                        ->withInput($request->only('username'));
        }
    }

    public function logout(Request $request)
    {
<<<<<<< HEAD
=======
<<<<<<< Updated upstream
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
=======
>>>>>>> 5582c58f29a520ba73d8d55abedc6bcf68152c84
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
<<<<<<< HEAD
=======
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
>>>>>>> 5582c58f29a520ba73d8d55abedc6bcf68152c84
    }

    public function login() {}
    public function logout()
    {
        $jwtToken = cookie()->forget('jwt_token');
        $adminData = cookie()->forget('user_data');
        return redirect('/')->with('success', 'Logout berhasil.')->withCookie($jwtToken)->withCookie($adminData);
    }

}
