<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            //set validation
            $validator = Validator::make($request->all(), [
                'id_roles' => ['required', 'int'],
                'username' => ['required', 'string', 'max:255', 'unique:admins,username'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
                'instagram' => [],
                'facebook' => [],
                'no_telp' => ['required', 'string', 'max:15', 'unique:admins,no_telp'],
            ]);
    
            //if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            //create user
            $user = User::create([
                'username' => $request['username'],
                'id_roles' => $request['id_roles'], // Set role sebagai user biasa
                'password' => bcrypt($request['password']),
                'no_telp' => $request['no_telp'],
                'email' => $request['email'],
                'instagram' => $request['instagram'],
                'facebook' => $request['facebook']
            ]);
    
            //return response JSON user is created
            if ($user) {
                // Auto-login after registration
                $credentials = $request->only('email', 'password');
                $token = auth()->guard('api')->attempt($credentials);
                return response()->json([
                    'success' => true,
                    'user'    => $user,
                    'token'   => $token
                ], 201);
            }
    
            //return JSON process insert failed 
            return response()->json([
                'success' => false,
            ], 409);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }
}
