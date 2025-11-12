<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class UserViewController extends Controller
{
    public function bimbingan(){
        $response = Http::post('http://' . Config::get('app.API') . '/api/user', [
            'function' => 'dataIndex',
            'type' => 1,
        ])->json();
        return view('user.bimbingan', compact('response'));
    }
    public function prestasi(){
        $response = Http::post('http://' . Config::get('app.API') . '/api/user', [
            'function' => 'dataIndex',
            'type' => 2,
        ])->json();
        return view('user.prestasi', compact('response'));
    }
    public function ekskul(){
        $response = Http::post('http://' . Config::get('app.API') . '/api/user', [
            'function' => 'dataIndex',
            'type' => 3,
        ])->json();
        return view('user.ekskul', compact('response'));
    }
}
