<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class UserViewController extends Controller
{
    public function bimbingan(){
        $response = Http::post('http://' . Config::get('app.API') . '/api/user', [
            'function' => 'bimbingan',
        ])->json();
        return view('user.bimbingan', compact('response'));
    }
    public function prestasi(){
        return view('user.prestasi');
    }
    public function ekskul(){
        return view('user.ekskul');
    }
}
