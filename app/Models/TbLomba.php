<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbLomba extends Model
{
    protected $table = 'tb_lomba';
    protected $fillable = ['id_evidence', 'tingkat_lomba', 'tingkat_juara', 'poin_lomba'];
}
