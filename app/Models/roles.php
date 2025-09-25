<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'tb_roles';
    protected $fillable = ['role'];

    // Relationship dengan model User
    public function users()
    {
        return $this->hasMany(User::class, 'id_roles', 'id');
    }
}