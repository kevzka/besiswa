<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbSiswas extends Model
{
    protected $table = 'tb_siswas';
    protected $fillable = ['nis', 'nama', 'kelas', 'jurusan', 'angkatan', 'poin_jiwa'];
}
