<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbSiswasLombas extends Model
{
    protected $table = 'tb_siswas_lombas';
    protected $primaryKey = 'id_siswa_lomba';
    protected $fillable = ['nis_siswa', 'id_lomba'];
}
