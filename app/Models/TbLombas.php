<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbLombas extends Model
{
    protected $table = 'tb_lombas';
    protected $primaryKey = 'id_lomba';
    protected $fillable = [
        'id_lomba',
        'id_evidence',
        'tingkat_lomba',
        'tingkat_juara',
        'poin_lomba'
    ];

    
}
