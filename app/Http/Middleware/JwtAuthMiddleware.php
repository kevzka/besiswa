<?php

// app/Http/Middleware/JwtAuthMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class JwtAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // debug logging (jangan dd karena menghentikan request)
        Log::info('JwtAuthMiddleware hit', [
            'uri' => $request->getRequestUri(),
            'expectsJson' => $request->expectsJson(),
            'cookies' => array_keys($request->cookies->all()),
        ]);

        try {
            if ($token = $request->cookie('jwt_token')) {
                Log::info('Jwt token found', ['token_present' => true]);
                JWTAuth::setToken($token)->authenticate();
            } else {
                Log::warning('Jwt token missing in cookie');
                throw new \Tymon\JWTAuth\Exceptions\JWTException('Token not provided');
            }
        } catch (JWTException $e) {
            Log::warning('JwtAuthMiddleware exception', ['message' => $e->getMessage()]);
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Token tidak valid, silakan login ulang.'], 401);
            }
            return redirect('/login')
                ->with('error', 'Sesi Anda telah berakhir atau token tidak valid.')
                ->withoutCookie('jwt_token');
        }

        return $next($request);
    }
}

