<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class UserViewController extends Controller
{
    public $posArrStart = [210,100,"400px"];
    public $posArrIdle = [20,50,"80px"];

    public function bimbingan($deg){
        $response = Http::post('http://' . Config::get('app.API') . '/api/user', [
            'function' => 'dataIndex',
            'type' => 1,
        ])->json();
        $response = array_merge($response, ['logoRotation' => 45, 'startLogoRotation' => ($deg == 0) ? 0 : (($deg-1)*90)+45, 'posArrStart' => $deg == 0 ? $this->posArrStart : $this->posArrIdle]);
        return view('user.bimbingan', compact('response'));
    }
    public function prestasi($deg){
        $response = Http::post('http://' . Config::get('app.API') . '/api/user', [
            'function' => 'dataIndex',
            'type' => 2,
        ])->json();
        $response = array_merge($response, ['logoRotation' => 135, 'startLogoRotation' => ($deg == 0) ? 0 : (($deg-1)*90)+45, 'posArrStart' => $deg == 0 ? $this->posArrStart : $this->posArrIdle]);
        return view('user.prestasi', compact('response'));
    }
    public function ekskul($deg){
        $response = Http::post('http://' . Config::get('app.API') . '/api/user', [
            'function' => 'dataIndex',
            'type' => 3,
        ])->json();
        

        $response = array_merge($response, ['logoRotation' => 225, 'startLogoRotation' => ($deg == 0) ? 0 : (($deg-1)*90)+45, 'posArrStart' => $deg == 0 ? $this->posArrStart : $this->posArrIdle]);
        return view('user.ekskul', compact('response'));
    }
}
