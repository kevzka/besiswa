<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbSiswaLomba extends Model
{
    protected $table = 'tb_siswa_lomba';
    protected $fillable = ['nis_siswa', 'id_lomba'];
}
