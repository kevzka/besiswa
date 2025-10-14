<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbEvidence extends Model
{
    protected $table = 'tb_evidence';

    protected $fillable = [
        'id_admin',
        'type',
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
