<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tb_kegiatan extends Model
{
    protected $table = 'tb_kegiatan';

    protected $fillable = [
        'id_admin',
        'title',
        'file',
        'description',
        'date',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }
}
