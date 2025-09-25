<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_kegiatan;

class RolesPageController extends Controller
{
    public function bimbinganPage(){
        $kegiatan = Tb_kegiatan::all();
        return view('admin.bimbingan', compact('kegiatan'));
    }
}
